<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Support\Carbon;

use function Laravel\Prompts\error;

class ApplyController extends Controller
{
    /**
     * Show the application modal content.
     *
     * @param int $offerId
     * @return \Illuminate\Http\Response
     */
    public function show($offerId)
    {
        // For now, return a placeholder response
        return response()->json([
            'html' => "<h2>Postuler à l'offre $offerId</h2><p>Formulaire à venir...</p>"
        ]);
    }


    public function modal($id)
    {
        $offer = Offer::with(['company', 'company.city'])->find($id);

        if (!$offer) {
            return response()->json(['error' => 'Offer not found'], 404);
        }

        // Return a partial view for the modal content
        return view('students.partials.apply_modal', compact('offer'));
    }

    public function submitApplication(Request $request, $offerId)
    {
        $request->validate([
            'lettre_de_motivation' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Vérifier si l'offre existe
        $offer = Offer::find($offerId);
        if (!$offer) {
            return response()->json(['error' => 'Offre non trouvée.'], 404);
        }

        // Vérifier si l'utilisateur est authentifié et est un étudiant
        $student = Auth::user()->student;
        if (!$student) {
            return response()->json(['error' => 'Utilisateur non autorisé.'], 403);
        }

        // Vérifier si une candidature existe déjà pour cet étudiant et cette offre
        $existingApplication = Application::where('student_id', $student->student_id)
            ->where('offer_id', $offerId)
            ->first();

        if ($existingApplication) {
            return response()->json(['error' => 'Vous avez déjà postulé à cette offre.'], 400);
        }

        // Gérer le téléchargement du fichier
        $filePath = $request->file('lettre_de_motivation')->store('motivational_letters', 'public');

        // Créer une nouvelle candidature
        Application::create([
            'cover_letter_path' => $filePath,
            'application_date' => Carbon::now(),
            'offer_id' => $offerId,
            'student_id' => $student->student_id,
            'status_id' => 1, // Statut par défaut (par exemple, "En attente")
        ]);
    }
}
