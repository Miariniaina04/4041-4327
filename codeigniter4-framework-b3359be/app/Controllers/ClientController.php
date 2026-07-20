<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComptesModele;
use App\Models\PrefixesModele;
use App\Models\TransactionsModele;
use App\Models\FraisBaremesModele;
use App\Models\OperationTypesModele;

class ClientController extends BaseController
{
    public function index()
    {
        //
    }

    public function login(){
        $phone = $this->request->getPost('telephone');
        $prefixModel = new PrefixesModele();
        $prefixId = $prefixModel->isValidPrefix($phone);
        if($prefixId == null){
            return redirect()->back()->with('error','Numero invalide pour cet operateur.') ;
        }
        
        $compteModel = new ComptesModele();
        $compte = $compteModel->where('telephone',$phone)->first();

        if(!$compte){
            $newcompte = $compteModel->insert([
                'telephone' => $phone,
                'prefix_id'=> $prefixId,
                'solde' => 0

            ]);
            $compte = $compteModel->find($newcompte);
        }

        session()->set('user_id',$compte['id']);
        session()->set('user_phone',$compte['telephone']);
        return redirect()->to('/client/dashboard');
    }
   
    /**
     * Déconnexion de l'utilisateur
     */
    public function logout()
    {
        session()->remove(['user_id', 'user_phone']);
        session()->destroy();
        return redirect()->to('/')
                        ->with('success', 'Vous avez été déconnecté avec succès.');
    }
    

    public function dashboard(){
        $telephoneId = session()->get('user_phone');
        $compteModel     = new ComptesModele();
        $compte = $compteModel->getCompteByTelephone($telephoneId);
        
        $data = [
            'soldeActuel' => $compte ? $compte['solde'] : 0.0
        ];
        
        // CORRECTION : Il faut passer $data en deuxième paramètre !
        return view('client/dashboard', $data); 
    }


}
