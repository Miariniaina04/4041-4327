<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CommissionModele;
use App\Models\PrefixesModele;
use App\Models\FraisBaremesModele;

class CommissionController extends BaseController
{
    protected $commissionModel;
    protected $prefixesModel;
    protected $fraisBaremes;
    public function __construct()
    {
        $this->commissionModel = new CommissionModele();
        $this->prefixesModel = new PrefixesModele();
        $this->fraisBaremes = new FraisBaremesModele();
    }

    public function index()
    {
        $data['commissions'] = $this->commissionModel->findAll();
        $data['prefixes'] = $this->prefixesModel->findAll();
        $data['frais_baremes'] = $this->fraisBaremes->findAll();

        return view('commission/index', $data);
        
    }

    public function create()
    {
        return view('commission/create');
    }

    public function montantCommission($typeId, $montant)
    {
        $bareme = $this->fraisBaremes->getFraisByMontant($typeId, $montant);
        if (!$bareme) {
            return null; 
        } 
        return $bareme['frais'];
    }


    public function verifierPrefixeCompteDestinataire($telComptes,$telDest)
    {
        $prefixeCompte = substr($telComptes, 0, 3);
        $prefixeDest = substr($telDest, 0, 3);

        $operateurCompte = $this->prefixeModel->getOperateurByPrefixe($prefixeCompte);
        $operateurDest = $this->prefixeModel->getOperateurByPrefixe($prefixeDest);

        if ($operateurCompte = $operateurDest) {
            return true; 
        }
        else {
            return false; 
        }
    }

    public function soumissionTransfert($telComptes, $montant, $telephoneDest, $typeId)
    {
        $prefixe = $this->prefixeModel->verifierPrefixeCompteDestinataire($telComptes, $telephoneDest);
        if ($prefixe == true) {
            $frais = $this->calcul_montant_frais($typeId, $montant);
        } else {
            $frais = $this->fraisModel->commissionTransfert($montant);
        }

        return $frais;
    }
}
