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

    public function list()
    {
        // Récupérer toutes les offres
        $offers = Offer::all();
        return view('offers.list', ['offers' => $offers, 'page' => $this->page]);
    }

    public function show($id)
    {
        // Récupérer une offre spécifique
        $offer = Offer::findOrFail($id);
        return view('offers.show', ['offer' => $offer, 'page' => $this->page]);
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
