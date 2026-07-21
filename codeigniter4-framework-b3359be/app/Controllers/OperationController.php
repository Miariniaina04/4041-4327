<?php

namespace App\Controllers;

use App\Models\PrefixesModele;
use App\Models\FraisBaremesModele;
use App\Models\ComptesModele;

class OperationController extends BaseController
{ 
    protected $prefixeModel;
    protected $fraisModel;
    protected $comptesModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixesModele();
        $this->fraisModel = new FraisBaremesModele();
        $this->comptesModel = new ComptesModele();
    }

    public function index()
    {
        // Détecte le type d'opération demandé dans l'URL (ex: /client/operation?type=depot)
        $type = $this->request->getGet('type');

        switch ($type) {
            case 'depot':
                return view('client/operation/depot', ['type_id' => 1]);
            case 'retrait':
                return view('client/operation/retrait', ['type_id' => 2]);
            case 'transfert':
                return view('client/operation/transfert', ['type_id' => 3]);
            default:
                return redirect()->to('/client/dashboard')->with('error', 'Type d\'opération invalide.');
        }
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

    public function obtenirCalculFraisAjax()
    {
        // Vérification que c'est bien une requête AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Requête non autorisée'
            ]);
        }

        $typeId   = $this->request->getGet('type_id');
        $montant  = (float) $this->request->getGet('montant');

        if (empty($typeId) || $montant <= 0) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Données manquantes ou montant invalide'
            ]);
        }

        // Appel de ta méthode de calcul
        $resultat = $this->calcul_montant_frais($typeId, $montant);

        if ($resultat === null) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Montant en dehors des tranches disponibles.'
            ]);
        }

    // On récupère aussi juste la valeur des frais pour l'afficher
    $bareme = $this->fraisModel->getFraisByMontant($typeId, $montant);
    $frais = $bareme ? (float)$bareme['frais'] : 0;
        return $this->response->setJSON([
            'status' => 'success',
            'frais'  => $frais,
            'total'  => $resultat   // montantTotal retourné par ta fonction
        ]);
    }

}