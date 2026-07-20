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