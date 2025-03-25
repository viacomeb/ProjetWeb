<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;

class OffreController extends Controller
{
    protected $page;

    public function __construct()
    {
        $this->page = 'offres';
    }

    public function liste()
    {
        // Récupérer toutes les offres
        $offres = Offre::all();
        return view('offres.liste', compact('offres', 'page'));
    }

    public function show($id)
    {
        // Récupérer une offre spécifique
        $offre = Offre::findOrFail($id);
        return view('offres.show', compact('offre', 'page'));
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
