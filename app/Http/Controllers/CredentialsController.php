<?php

namespace App\Http\Controllers;

use App\Models\MovilCredentials;
use App\Models\TransferCredentials;

class CredentialsController extends Controller
{
    public function __construct() {
        $this->middleware('role:Administrador');
    }

    public function index()
    {
        $movil = MovilCredentials::first();
        $transfer = TransferCredentials::first();

        return view('credentials', [
            'movil' => $movil,
            'transfer' => $transfer,
        ]);
    }
}
