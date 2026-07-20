<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ComptesModele;
use App\Models\PrefixesModele;
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
            $compte = $compteModel->findAll($newcompte);
        }

        session()->set('user_id',$compte['id']);
        session()->set('user_phone',$compte['telephone']);
        return redirect()->to('client/dashboard');
    }
}
