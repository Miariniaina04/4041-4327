<?php

namespace App\Controllers;

use App\Models\CreneauModel;
use App\Models\User;
use App\Models\ReservationModel;

class Home extends BaseController
{
public function index()
    {
        return view('auth/login');
    }

}

