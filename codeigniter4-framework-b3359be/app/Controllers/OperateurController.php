<?php

namespace App\Controllers;

use App\Models\PrefixesModele;
use App\Models\FraisBaremesModele;
use App\Models\TransactionsModele;
use App\Models\ComptesModele;


class OperateurController extends BaseController
{
    protected $prefixeModel;
    protected $fraisModel;
    protected $transactionModel;
    protected $compteModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixesModele();
        $this->fraisModel = new FraisBaremesModele();
        $this->transactionModel = new TransactionsModele();
        $this->compteModel= new ComptesModele();
    }

    public function index()
    {
        try {

            $baremes = $this->fraisModel->findAll();
            
            $data = [
                'prefixes' => $this->prefixeModel->findAll(),
                'baremes'  => $baremes
            ];
        } catch (\Throwable $e) {
            $data = ['prefixes' => [], 'baremes' => [], 'error' => $e->getMessage()];
        }

        return view('Operateur/index', $data);
    }

    public function show($id)
    {
        try {
            $data = [
                'prefixe' => $this->prefixeModel->find($id),
                'baremes' => $this->fraisModel->getByOperationType($id)
            ];
        } catch (\Throwable $e) {
            $data = ['prefixe' => null, 'baremes' => [], 'error' => $e->getMessage()];
        }

        return view('Operateur/index', $data);
    }

    public function createPrefixe()
    {
        return view('Operateur/add');
    }

    public function storePrefixe()
    {
        try {
            $this->prefixeModel->save([
                'prefix'      => $this->request->getPost('prefix'),
                'description' => $this->request->getPost('description'),
                'actif'       => 1
            ]);
        } catch (\Throwable $e) {
            return redirect()->to('/operateur')->with('error', 'Impossible d’ajouter le préfixe : ' . $e->getMessage());
        }

        return redirect()->to('/operateur')->with('success', 'Préfixe ajouté avec succès');
    }

    public function editBareme($id)
    {
        $data = [
            'bareme' => $this->fraisModel->find($id)
        ];

        return view('Operateur/edit', $data);
    }

    public function updateBareme($id)
    {
        try {
            $this->fraisModel->update($id, [
                'min_montant'       => $this->request->getPost('min_montant'),
                'max_montant'       => $this->request->getPost('max_montant'),
                'frais'             => $this->request->getPost('frais'),
                'operation_type_id' => $this->request->getPost('operation_type_id')
            ]);
        } catch (\Throwable $e) {
            return redirect()->to('/operateur')->with('error', 'Impossible de mettre à jour le barème : ' . $e->getMessage());
        }

        return redirect()->to('/operateur')->with('success', 'Barème mis à jour');
    }


    public function desactiverPrefixe($id)
    {
        try {
            $this->prefixeModel->update($id, ['actif' => 0]);
        } catch (\Throwable $e) {
            return redirect()->to('/operateur')->with('error', 'Impossible de désactiver le préfixe : ' . $e->getMessage());
        }

        return redirect()->to('/operateur');
    }

    
    public function deleteBareme($id)
    {
        try {
            $this->fraisModel->delete($id);
        } catch (\Throwable $e) {
            return redirect()->to('/operateur')->with('error', 'Impossible de supprimer le barème : ' . $e->getMessage());
        }

        return redirect()->to('/operateur');
    }


    public function tableauGains()
    {
        $gainsData = $this->transactionModel->getGainsParType();

        $nomOperations = [
            1 => 'Dépôt',
            2 => 'Retrait',
            3 => 'Transfert'
        ];

        $tableauBord = [];
        foreach ($gainsData as $row) {
            $idType = $row['operation_type_id'];
            $tableauBord[] = [
                'reference_id' => $idType,
                'type_nom'     => $nomOperations[$idType] ?? 'Opération Inconnue',
                'total_gains'  => (float)$row['total_gains']
            ];
        }

        return view('Operateur/tableau_gain', ['fraisOperations' => $tableauBord]);
    }

    public function listeClients()
    {
        $data['clients'] = $this->compteModel->orderBy('id', 'ASC')->findAll();
        return view('Operateur/liste_clients', $data);
    }
    
    public function showClientTransactions($clientId)
    {
        $client = $this->compteModel->find($clientId);
        if (!$client) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }

        $transactions = $this->transactionModel->getTransactionsByClient($clientId); //

        $data = [
            'client'       => $client,
            'transactions' => $transactions
        ];

        return view('Operateur/situation', $data); //
    }

    public function ajaxListPrefixes()
    {
        $request = service('request');
        $search  = $request->getGet('search');
        $actif   = $request->getGet('actif');

        $builder = $this->prefixeModel;

        if ($actif !== null && $actif !== '') {
            $builder = $builder->where('actif', $actif);
        }

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('prefix', $search)
                               ->orLike('description', $search)
                               ->groupEnd();
        }

        $prefixes = $builder->findAll();

        return $this->response->setJSON($prefixes);
    }
}