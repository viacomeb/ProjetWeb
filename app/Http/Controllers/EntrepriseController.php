<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    protected $page;

    public function __construct()
    {
        $this->page = 'entreprises';
    }

    public function liste()
    {
        // Récupérer toutes les entreprises
        $entreprises = Entreprise::all();
        return view('entreprises.liste', ['entreprises' => $entreprises, 'page' => $this->page]);
    }

    public function show($id)
    {
        // Récupérer une entreprise spécifique
        $entreprise = Entreprise::findOrFail($id);
        return view('entreprises.show', ['entreprises' => $entreprise, 'page' => $this->page]);
    }

    public function dashboard()
    {
        // Logique pour la page de dashboard
        return view('entreprises.dashboard', compact('page'));
    }
    // Autres méthodes pour créer, mettre à jour, supprimer des entreprises
}
