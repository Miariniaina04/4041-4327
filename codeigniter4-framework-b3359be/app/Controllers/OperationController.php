<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
use App\Models\FraisBaremeModel;

class OperationrController extends BaseController
{ 
     protected $prefixeModel;
    protected $fraisModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixeModel();
        $this->fraisModel = new FraisBaremeModel();
    }

    public function index()
    {
        $data = [
            'prefixes' => $this->prefixeModel->findAll(),
            'baremes'  => $this->fraisModel->findAll()
        ];

        return view('operation/index', $data);
    }

    public function show($id)
    {
        $data = [
            'prefixe' => $this->prefixeModel->find($id),
            'baremes' => $this->fraisModel->getByOperationType($id) 
        ];

        return view('operation/show', $data);
    }

    public function calcul_montant_frais($typeId, $montant)
    {
        $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);
        if (!$bareme) {
                return null; 
            } 
            return $montant + $bareme['frais'];
    }

    public function obtenirCalculFraisAjax()
{
    $typeId = $this->request->getGet('type_id');
    $montant = $this->request->getGet('montant');

    if (empty($typeId) || empty($montant)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Données manquantes']);
    }

    $montantTotal = $this->calcul_montant_frais($typeId, $montant);

    if ($montantTotal === null) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Montant en dehors des tranches disponibles.']);
    }

    // On récupère aussi juste la valeur des frais pour l'afficher
    $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);

    return $this->response->setJSON([
        'status' => 'success',
        'frais' => $bareme['frais'],
        'total' => $montantTotal
    ]);
}

}