<?php

namespace App\Controllers;

use App\Models\PrefixesModele;
use App\Models\FraisBaremesModele;

class OperateurController extends BaseController
{
    protected $prefixeModel;
    protected $fraisModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixesModele();
        $this->fraisModel = new FraisBaremesModele();
    }

    public function index()
    {
        $data = [
            'prefixes' => $this->prefixeModel->findAll(),
            'baremes'  => $this->fraisModel->findAll()
        ];

        return view('Operateur/index', $data);
    }

    public function show($id)
    {
        $data = [
            'prefixe' => $this->prefixeModel->find($id),
            'baremes' => $this->fraisModel->getByOperationType($id) 
        ];

        return view('Operateur/index', $data);
    }

    public function createPrefixe()
    {
        return view('Operateur/create');
    }

    public function storePrefixe()
    {
        $this->prefixeModel->save([
            'prefix'      => $this->request->getPost('prefix'),
            'description' => $this->request->getPost('description'),
            'actif'       => 1
        ]);

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
        $this->fraisModel->update($id, [
            'min_montant'       => $this->request->getPost('min_montant'),
            'max_montant'       => $this->request->getPost('max_montant'),
            'frais'             => $this->request->getPost('frais'),
            'operation_type_id' => $this->request->getPost('operation_type_id')
        ]);

        return redirect()->to('/operateur')->with('success', 'Barème mis à jour');
    }


    public function desactiverPrefixe($id)
    {
        $this->prefixeModel->update($id, ['actif' => 0]);
        return redirect()->to('/operateur');
    }

    
    public function deleteBareme($id)
    {
        $this->fraisModel->delete($id);
        return redirect()->to('/operateur');
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