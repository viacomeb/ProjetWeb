<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OffersController extends Controller
{
    protected $page;

    public function __construct()
    {
        $this->page = 'offers';
    }

    public function liste()
    {
        // Récupérer toutes les offres
        $offers = Offer::all();
        return view('offers.list', compact('offers', 'page'));
    }

    public function show($id)
    {
        // Récupérer une offre spécifique
        $offer = Offer::findOrFail($id);
        return view('offers.show', compact('offer', 'page'));
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
