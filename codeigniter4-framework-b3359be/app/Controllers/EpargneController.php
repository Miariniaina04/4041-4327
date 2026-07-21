<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PrefixesModele;
use App\Models\FraisBaremesModele;
use App\Models\ComptesModele;
use App\Models\EpargneModele;
use App\Models\EpargnePourcentageModele;


class EpargneController extends BaseController
{

    protected $prefixeModel;
    protected $fraisModel;
    protected $comptesModel;
    protected $epargneModele;
    protected $epargnePourcentage;

    public function __construct()
    {
        $this->prefixeModel = new PrefixesModele();
        $this->fraisModel = new FraisBaremesModele();
        $this->comptesModel = new ComptesModele();
        $this->epargneModele = new EpargneModele();
        $this->epargnePourcentage = new EpargnePourcentageModele();
    }

    public function index()
    {
        try {
            $telephoneId = session()->get('user_phone');
            $compte = $compteModel->getCompteByTelephone($telephoneId);
            $baremes = $this->fraisModel->findAll();
            $epargne = $this->epargneModele->getEpargneByID();
            
            $data = [
                'prefixes' => $this->prefixeModel->findAll(),
                'baremes'  => $baremes,
                'soldeActuel' => $compte ? $compte['solde'] : 0.0
            ];
        } catch (\Throwable $e) {
            $data = ['prefixes' => [], 'baremes' => [], 'error' => $e->getMessage()];
        }

        return view('Operateur/index', $data);   
    }
}
