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

    public function toggleWishlist($offerId, $studentId)
    {
        try {
            \Log::info('toggleWishlist called', ['offer_id' => $offerId, 'student_id' => $studentId]);

            // Validate input
            if (!$offerId || !$studentId) {
                \Log::error('Missing offer_id or student_id', ['offer_id' => $offerId, 'student_id' => $studentId]);
                return response()->json(['error' => 'Missing offer_id or student_id.'], 400);
            }

            // Check if the student exists
            $student = \App\Models\Student::find($studentId);
            if (!$student) {
                \Log::error('Student not found', ['student_id' => $studentId]);
                return response()->json(['error' => 'Student not found.'], 404);
            }

            // Check if the offer exists
            $offer = \App\Models\Offer::find($offerId);
            if (!$offer) {
                \Log::error('Offer not found', ['offer_id' => $offerId]);
                return response()->json(['error' => 'Offer not found.'], 404);
            }

            // Check if the offer is already in the wishlist
            $wishlistItem = $student->wishlist()->where('offer_id', $offerId)->first();
            \Log::info('Wishlist item check', ['offer_id' => $offerId, 'exists' => $wishlistItem ? true : false]);

            if ($wishlistItem) {
                // Remove from wishlist
                $wishlistItem->delete();
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
                'student_id' => $studentId ?? null,
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
    // Autres méthodes pour créer, mettre à jour, supprimer des offres
}
