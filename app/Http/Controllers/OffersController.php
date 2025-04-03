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
        $offers = Offer::query()->paginate(10); // Utiliser la pagination Laravel
        return view('offers.list', ['offers' => $offers, 'page' => $this->page]);
    }

    public function show($id)
    {
        $offer = Offer::with('company')->findOrFail($id);

        // Check if the request expects JSON (e.g., from AJAX)
        if (request()->wantsJson()) {
            return response()->json($offer);
        }

        return view('offers.show', ['offer' => $offer, 'page' => $this->page]);
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

    public function toggleWishlist($offerId)
    {
        try {
            \Log::info('toggleWishlist called', ['offer_id' => $offerId]);

            // Get the authenticated user
            $user = Auth::user();
            if (!$user) {
                \Log::error('User not authenticated');
                return response()->json(['error' => 'Unauthorized.'], 403);
            }

            // Check if the user is a student
            if (!$user->student) {
                \Log::error('User is not a student', ['user_id' => $user->id]);
                return response()->json(['error' => 'Only students can manage their wishlist.'], 403);
            }

            $student = $user->student;

            // Check if the offer exists
            $offer = Offer::find($offerId);
            if (!$offer) {
                \Log::error('Offer not found', ['offer_id' => $offerId]);
                return response()->json(['error' => 'Offer not found.'], 404);
            }

            // Check if the offer is already in the wishlist
            $exists = $student->wishlist()->where('offer_id', $offerId)->exists();
            \Log::info('Wishlist item check', ['offer_id' => $offerId, 'exists' => $exists]);

            if ($exists) {
                // Remove from wishlist using the composite key
                $student->wishlist()->where('offer_id', $offerId)->delete();
                \Log::info('Wishlist item removed', ['offer_id' => $offerId]);
                return response()->json(['action' => 'removed']);
            } else {
                // Add to wishlist
                $student->wishlist()->create(['offer_id' => $offerId]);
                \Log::info('Wishlist item added', ['offer_id' => $offerId]);
                return response()->json(['action' => 'added']);
            }
        } catch (\Exception $e) {
            \Log::error('Error toggling wishlist', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'offer_id' => $offerId ?? null,
            ]);
            return response()->json(['error' => 'An error occurred while toggling the wishlist.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'company_id' => 'required|exists:Companies,company_id',
        ]);

        // Set default values for view_count and is_active
        $validatedData['view_count'] = 0;
        $validatedData['is_active'] = true;

        Offer::create($validatedData);

        return redirect()->route('admin.internships')->with('success', 'Offre créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'company_id' => 'required|exists:Companies,company_id',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($validatedData);

        return redirect()->route('offers.list')->with('success', 'Offre mise à jour avec succès.');
    }

    public function count()
    {
        $count = Offer::count();
        return response()->json(['count' => $count]);
    }

    public function modal($id)
    {
        $offer = Offer::with(['company', 'company.city'])->find($id);

        if (!$offer) {
            return response()->json(['error' => 'Offer not found'], 404);
        }

        // Return a partial view for the modal content
        return view('students.partials.offer_modal', compact('offer'));
    }

    public function edit($id)
    {
        try {
            $offer = Offer::with(['company'])->findOrFail($id);

            return response()->json($offer);
        } catch (\Exception $e) {
            \Log::error('Error fetching offer data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch offer data.'], 500);
        }
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return redirect()->route('admin.internships')->with('success', 'Offre supprimée avec succès.');
    }

    public function wishlist()
    {
        try {
            \Log::info('Accessing wishlist method');

            $user = Auth::user();
            if (!$user) {
                \Log::error('No authenticated user found');
                return redirect()->route('login');
            }

            \Log::info('User found', ['user_id' => $user->id]);

            $student = $user->student;
            if (!$student) {
                \Log::error('No student profile found for user', ['user_id' => $user->id]);
                return redirect()->route('student.dashboard')->with('error', 'Profil étudiant non trouvé.');
            }

            \Log::info('Student profile found', ['student_id' => $student->student_id]);

            $wishlist = $student->wishlist()->with(['offer.company.city'])->get();
            \Log::info('Wishlist retrieved', ['count' => $wishlist->count()]);

            return view('students.wishlist', [
                'wishlist' => $wishlist,
                'student' => $student,
                'page' => 'wishlist'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in wishlist method', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
            return redirect()->route('student.dashboard')->with('error', 'Une erreur est survenue lors du chargement de vos favoris.');
        }
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
