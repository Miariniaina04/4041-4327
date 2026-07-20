<?php

namespace App\Controllers;

use App\Models\ComptesModele;

class CompteController extends BaseController
{ 
    protected $compteModel;

    public function __construct()
    {
        $this->compteModel = new ComptesModele();
    }

    public function getCompteByTelephone($telephone)
    {
        $compte = $this->compteModel->getCompteByTelephone($telephone);
        if ($compte) {
            return $this->response->setJSON(['status' => 'success', 'compte' => $compte]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Compte non trouvé']);
        }
    }

    public function getSoldeFrais($compteId, $montant, $frais)
    {
        $soldeFrais = $this->compteModel->getSoldeFrais($compteId, $montant, $frais);
        if ($soldeFrais !== null) {
            return $this->response->setJSON(['status' => 'success', 'solde_frais' => $soldeFrais]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Compte non trouvé']);
        }
    }

}