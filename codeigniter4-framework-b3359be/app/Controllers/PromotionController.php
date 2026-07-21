<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PromotionController extends BaseController
{
    public function index()
    {
        //
        $data = [];
        return view('client/promotion/transfer', $data);
    }
}
