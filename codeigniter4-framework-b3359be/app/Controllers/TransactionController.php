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
        $transactions = $this->transaction->getTransactionsById($id);
        return $this->response->setJSON($transactions);
    }

    public function save()
    {
        $data = [
            'prefix' => $this->request->getPost('prefix'),
            'montant' => $this->request->getPost('montant'),
            'frais' => $this->request->getPost('frais'),
            'compte_id' => $this->request->getPost('compte_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->transaction->insert($data)) {
            return redirect()->to('/transaction')->with('success', 'Transaction enregistrée avec succès');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'enregistrement de la transaction');
        }
    }
}