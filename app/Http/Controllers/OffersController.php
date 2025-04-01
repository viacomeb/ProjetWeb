<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

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

    public function apply($id)
    {
        $offer = Offer::findOrFail($id);

        // Logic to mark the offer as applied by the authenticated student
        $user = Auth::user();
        if ($user->role !== 'student') {
            abort(403, 'Only students can apply to offers.');
        }

        // Check if the application already exists
        if ($user->applications()->where('offer_id', $offer->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied to this offer.');
        }

        $user->applications()->create(['offer_id' => $offer->id]);
        return redirect()->back()->with('success', 'You have successfully applied to the offer.');
    }

    public function addToWishlist($id)
    {
        $offer = Offer::findOrFail($id);

        // Logic to add the offer to the student's wishlist
        $user = Auth::user();
        if ($user->role !== 'student') {
            abort(403, 'Only students can add offers to their wishlist.');
        }

        // Check if the offer is already in the wishlist
        if ($user->wishlist()->where('offer_id', $offer->id)->exists()) {
            return redirect()->back()->with('error', 'This offer is already in your wishlist.');
        }

        $user->wishlist()->create(['offer_id' => $offer->id]);
        return redirect()->back()->with('success', 'Offer added to your wishlist.');
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
