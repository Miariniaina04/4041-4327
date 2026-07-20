<?php

namespace App\Controllers;

use App\Models\TransactionsModele;
use App\Models\ComptesModele;

class TransactionController extends BaseController
{ 
    protected $transaction;
    protected $fraisModel;

    public function __construct()
    {
        $this->transaction = new TransactionsModele();
    }

    public function index()
    {
        $transactions = $this->transaction->findAll();
        return view('transaction/index', ['transactions' => $transactions]);
    }

    public function TableauGainByIdAJAX($id)
    {
        $transactions = $this->transaction->countTransactionByType($id);
        return $this->response->setJSON($transactions);
    }


    public function save()
    {
        $sessionPhone = session()->get('user_phone') ?: "0337208662"; 
        $compte = $this->comptesModel->getCompteByTelephone($sessionPhone);

        if (!$compte) {
            return redirect()->back()->with('error', 'Compte expéditeur introuvable.');
        }

        $compteId = $compte['id']; 
        $typeId   = $this->request->getPost('type_id');
        $montant  = (float) $this->request->getPost('montant');


        $idDestinataire = null;
        if ($typeId == 3) {
            $telephoneDest = $this->request->getPost('telephone_destination');
            $idDestinataire = $this->comptesModel->conversionTelephoneToId($telephoneDest);
            
            if (!$idDestinataire) {
                return redirect()->back()->with('error', 'Le numéro de téléphone du destinataire est invalide.');
            }
            if ($idDestinataire == $compteId) {
                return redirect()->back()->with('error', 'Impossible de faire un transfert vers soi-même.');
            }
        }

        $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);
        if (!$bareme) {
            return redirect()->back()->with('error', 'Le montant saisi ne correspond à aucun barème valide.');
        }

        $frais = (float) $bareme['frais'];

        if ($typeId == 1) {
            $nouveauSolde = $compte['solde'] + $montant - $frais;
        } else {
            $montantTotal = $montant + $frais;

            if ($compte['solde'] < $montantTotal) {
                return redirect()->back()->with('error', 'Solde insuffisant pour effectuer cette opération.');
            }
            $nouveauSolde = $compte['solde'] - $montantTotal;
            
            // Créditer le destinataire si c'est un transfert
            if ($typeId == 3) {
                $compteDest = $this->comptesModel->find($idDestinataire);
                $this->comptesModel->updateSolde($idDestinataire, $compteDest['solde'] + $montant);
            }
        }

        $this->comptesModel->updateSolde($compteId, $nouveauSolde);

        // Enregistrement final avec la liaison correcte
        $transactionData = [
            'compte_id_from'    => $compteId,
            'compte_id_to'      => $idDestinataire, // ID lié dynamiquement !
            'operation_type_id' => $typeId,
            'montant'           => $montant,
            'frais'             => $frais,
            'montant_total'     => ($typeId == 1) ? ($montant - $frais) : ($montant + $frais),
            'statut'            => 'succes'
        ];

        if ($this->transactionModel->insert($transactionData)) {
            return redirect()->to('/transaction')->with('success', 'Opération validée et enregistrée !');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement.');
        }
    }

    public function validerTransfert()
{
    
    helper('phone');
    $numeroDestinataire = $this->request->getPost('compte_destination');
    $operateurDetecte = $this->prefixesModel->ckeckOperateur($numeroDestinataire);

    if ($operateurDetecte === null) {
        return redirect()->back()->with('error', 'Numéro de téléphone du destinataire invalide ou préfixe non reconnu.');
    }

}
}
