<?php

namespace App\Controllers;

use App\Models\TransactionsModele;

class TransactionController extends BaseController
{ 
    protected $fraisModel;

    public function __construct()
    {
        $this->transaction = new TransactionsModel();
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
        $compteId = $this->request->getPost('compte_id'); // Compte du client actuel[cite: 9]
        $typeId   = $this->request->getPost('type_id');   // 1=Depot, 2=Retrait, 3=Transfert[cite: 6, 13]
        $montant  = (float) $this->request->getPost('montant'); //[cite: 9]

        $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);
        if (!$bareme) {
            return redirect()->back()->with('error', 'Le montant saisi ne correspond à aucun barème valide.');
        }

        $frais = (float) $bareme['frais'];
        $compte = $this->compteModel->find($compteId);

        if (!$compte) {
            return redirect()->back()->with('error', 'Compte introuvable.');
        }

        if ($typeId == 1) { 
            $nouveauSolde = $compte['solde'] + $montant - $frais;
        } else { 
            $montantTotal = $montant + $frais;

            if ($compte['solde'] < $montantTotal) {
                return redirect()->back()->with('error', 'Solde insuffisant pour effectuer cette opération.');
            }
            $nouveauSolde = $compte['solde'] - $montantTotal;
        }

        $this->compteModel->updateSolde($compteId, $nouveauSolde);

        $transactionData = [
            'compte_id_from'    => $compteId,
            'compte_id_to'      => ($typeId == 3) ? $this->request->getPost('compte_destination') : null, // Si transfert[cite: 6]
            'operation_type_id' => $typeId,
            'montant'           => $montant,
            'frais'             => $frais,
            'montant_total'     => ($typeId == 1) ? ($montant - $frais) : ($montant + $frais),
            'statut'            => 'succes'
        ];

        // 5. Insertion dans la table transactions[cite: 6, 9, 12]
        if ($this->transactionModel->insert($transactionData)) {
            return redirect()->to('/transaction')->with('success', 'Opération validée et enregistrée !');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement.');
        }
    }
}