<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComptesModele;
use App\Models\PrefixesModele;
use App\Models\TransactionsModele;
use App\Models\FraisBaremesModele;
use App\Models\OperationTypesModele;

class ClientController extends BaseController
{
    public function index()
    {
        //
    }

    public function login(){
        $phone = $this->request->getPost('telephone');
        $prefixModel = new PrefixesModele();
        $prefixId = $prefixModel->isValidPrefix($phone);
        if($prefixId == null){
            return redirect()->back()->with('error','Numero invalide pour cet operateur.') ;
        }
        
        $compteModel = new ComptesModele();
        $compte = $compteModel->where('telephone',$phone)->first();

        if(!$compte){
            $newcompte = $compteModel->insert([
                'telephone' => $phone,
                'prefix_id'=> $prefixId,
                'solde' => 0

            ]);
            $compte = $compteModel->find($newcompte);
        }

        session()->set('user_id',$compte['id']);
        session()->set('user_phone',$compte['telephone']);
        return redirect()->to('/client/dashboard');
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout()
    {
        // Supprimer toutes les données de session
        session()->remove(['user_id', 'user_phone']);
        
        // Ou détruire complètement la session
        session()->destroy();
        
        // Redirection vers la page de login avec message
        return redirect()->to('/login')
                        ->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function dashboard(){
        return view('client/dashboard');
    }

    public function formOperation(){
        return view('view/formOperation');
    }

    public function saveTransaction()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/client/dashboard');
        }

        $montant         = (float) $this->request->getPost('montant');
        $typeOperationId = (int) $this->request->getPost('typeOperation');
        $telephone       = session()->get('telephone');

        // Chargement des modèles
        $compteModel     = new ComptesModele();
        $transactionModel = new TransactionsModele();
        $fraisModel      = new FraisBaremesModele();

        $expediteur = $compteModel->where('telephone', $telephone)->first();

        if (!$expediteur) {
            return redirect()->back()->with('error', 'Compte non trouvé !');
        }

        // Récupérer le nom du type d'opération
        $operationTypeModel = new OperationTypesModele();
        $typeOperation = $operationTypeModel->find($typeOperationId);

        if (!$typeOperation) {
            return redirect()->back()->with('error', 'Type d\'opération invalide !');
        }

        $nomType = strtolower($typeOperation['nom']);

        // ========================
        // DÉPÔT
        // ========================
        if ($nomType === 'depot') {
            if ($montant <= 0) {
                return redirect()->back()->with('error', 'Montant invalide !');
            }

            $nouveauSolde = $expediteur['solde'] + $montant;

            $compteModel->update($expediteur['id'], ['solde' => $nouveauSolde]);

            $transactionModel->save([
                'compte_id_from'   => $expediteur['id'],
                'compte_id_to'     => $expediteur['id'],
                'operation_type_id'=> $typeOperationId,
                'montant'          => $montant,
                'frais'            => 0,
                'montant_total'    => $montant,
                'statut'           => 'succes'
            ]);

            return redirect()->to('/client/dashboard')->with('success', 'Dépôt effectué avec succès !');
        }

        // ========================
        // RETRAIT
        // ========================
        elseif ($nomType === 'retrait') {
            $frais = $fraisModel->calculerFrais('retrait', $montant);
            $montantTotal = $montant + $frais;

            if ($montantTotal > $expediteur['solde']) {
                return redirect()->back()->with('error', 'Solde insuffisant !');
            }

            $nouveauSolde = $expediteur['solde'] - $montantTotal;

            $compteModel->update($expediteur['id'], ['solde' => $nouveauSolde]);

            $transactionModel->save([
                'compte_id_from'   => $expediteur['id'],
                'compte_id_to'     => null,
                'operation_type_id'=> $typeOperationId,
                'montant'          => $montant,
                'frais'            => $frais,
                'montant_total'    => $montantTotal,
                'statut'           => 'succes'
            ]);

            return redirect()->to('/client/dashboard')
                            ->with('success', "Retrait de {$montant} Ar effectué (Frais: {$frais} Ar)");
        }

        // ========================
        // TRANSFERT
        // ========================
        elseif ($nomType === 'transfert') {
            $destinataireTel = $this->request->getPost('telephone_dest');
            
            if (empty($destinataireTel)) {
                return redirect()->back()->with('error', 'Numéro du destinataire requis !');
            }

            $destinataire = $compteModel->where('telephone', $destinataireTel)->first();

            if (!$destinataire) {
                return redirect()->back()->with('error', 'Numéro destinataire invalide ou inexistant !');
            }

            $frais = $fraisModel->calculerFrais('transfert', $montant);
            $montantTotal = $montant + $frais;

            if ($montantTotal > $expediteur['solde']) {
                return redirect()->back()->with('error', 'Solde insuffisant !');
            }

            // Débit expéditeur
            $compteModel->update($expediteur['id'], [
                'solde' => $expediteur['solde'] - $montantTotal
            ]);

            // Crédit destinataire
            $compteModel->update($destinataire['id'], [
                'solde' => $destinataire['solde'] + $montant
            ]);

            // Enregistrer transaction
            $transactionModel->save([
                'compte_id_from'   => $expediteur['id'],
                'compte_id_to'     => $destinataire['id'],
                'operation_type_id'=> $typeOperationId,
                'montant'          => $montant,
                'frais'            => $frais,
                'montant_total'    => $montantTotal,
                'statut'           => 'succes'
            ]);

            return redirect()->to('/client/dashboard')
                            ->with('success', 'Transfert effectué avec succès !');
        }

        return redirect()->back()->with('error', 'Opération non reconnue !');
    }

}
