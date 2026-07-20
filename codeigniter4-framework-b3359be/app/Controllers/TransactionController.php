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

    <?php

namespace App\Controllers;

use App\Models\TransactionsModele;
use App\Models\ComptesModele;
use App\Models\FraisBaremesModele; // Ajout du modèle de barèmes

class TransactionController extends BaseController
{ 
    protected $transactionModel;
    protected $comptesModel;
    protected $fraisModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionsModele(); // Nom standardisé
        $this->comptesModel     = new ComptesModele();       // Initialisé pour conversionTelephoneToId
        $this->fraisModel       = new FraisBaremesModele();  // Initialisé pour getFraisByMontant[cite: 19, 20]
    }

    public function index()
    {
        $transactions = $this->transactionModel->findAll();
        return view('transaction/index', ['transactions' => $transactions]);
    }

    public function save()
    {
        $sessionPhone = session()->get('user_phone') ?: "0337208662"; 
        $compte = $this->comptesModel->getCompteByTelephone($sessionPhone);[cite: 18]

        if (!$compte) {
            return redirect()->back()->with('error', 'Compte expéditeur introuvable.');
        }

        $compteId = $compte['id']; 
        $typeId   = $this->request->getPost('type_id');[cite: 19]
        $montant  = (float) $this->request->getPost('montant');[cite: 19]

        $idDestinataire = null;
        if ($typeId == 3) {
            $telephoneDest = $this->request->getPost('telephone_destination');[cite: 19]
            $idDestinataire = $this->comptesModel->conversionTelephoneToId($telephoneDest);[cite: 18, 19]
            
            if (!$idDestinataire) {[cite: 19]
                return redirect()->back()->with('error', 'Le numéro de téléphone du destinataire est invalide.');[cite: 19]
            }
            if ($idDestinataire == $compteId) {
                return redirect()->back()->with('error', 'Impossible de faire un transfert vers soi-même.');
            }
        }

        $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);[cite: 19, 20]
        if (!$bareme) {[cite: 19]
            return redirect()->back()->with('error', 'Le montant saisi ne correspond à aucun barème valide.');[cite: 19]
        }

        $frais = (float) $bareme['frais'];[cite: 19]

        if ($typeId == 1) {[cite: 19]
            $nouveauSolde = $compte['solde'] + $montant - $frais;[cite: 19]
        } else {[cite: 19]
            $montantTotal = $montant + $frais;[cite: 19]

            if ($compte['solde'] < $montantTotal) {[cite: 19]
                return redirect()->back()->with('error', 'Solde insuffisant pour effectuer cette opération.');[cite: 19]
            }
            $nouveauSolde = $compte['solde'] - $montantTotal;[cite: 19]
            
            // Créditer le destinataire si c'est un transfert
            if ($typeId == 3) {
                $compteDest = $this->comptesModel->find($idDestinataire);
                $this->comptesModel->updateSolde($idDestinataire, $compteDest['solde'] + $montant);
            }
        }

        $this->comptesModel->updateSolde($compteId, $nouveauSolde);[cite: 19]

        // Enregistrement final avec la liaison correcte
        $transactionData = [
            'compte_id_from'    => $compteId,
            'compte_id_to'      => $idDestinataire, // ID lié dynamiquement !
            'operation_type_id' => $typeId,[cite: 19]
            'montant'           => $montant,[cite: 19]
            'frais'             => $frais,[cite: 19]
            'montant_total'     => ($typeId == 1) ? ($montant - $frais) : ($montant + $frais),[cite: 19]
            'statut'            => 'succes'[cite: 19]
        ];

        if ($this->transactionModel->insert($transactionData)) {[cite: 19]
            return redirect()->to('/transaction')->with('success', 'Opération validée et enregistrée !');[cite: 19]
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement.');[cite: 19]
        }
    }
}
}