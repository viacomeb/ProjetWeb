<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function connexion()
    {
        // Logique pour la page de connexion
        $page = 'connexion';
        return view('auth.connexion', compact('page'));
    }

    public function inscription()
    {
        // Logique pour la page d'inscription
        $page = 'inscription';
        return view('auth.inscription', compact('page'));
    }

    // Autres méthodes pour gérer l'authentification
}