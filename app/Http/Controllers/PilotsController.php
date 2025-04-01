<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PilotsController extends Controller
{
    public function dashboard()
    {
        // Logique pour récupérer les données spécifiques au tableau de bord des pilotes
        return view('pilots.dashboard', [
            'page' => 'dashboard',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }
}
