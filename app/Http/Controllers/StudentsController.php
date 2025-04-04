<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ajoutez cette ligne
use App\Models\Student;
use App\Models\Offer;


class StudentsController extends Controller
{
    public function dashboard()
    {
        return view('students.dashboard', [
            'page' => 'dashboard',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function challenges()
    {
        return view('students.challenges', [
            'page' => 'challenges',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function community()
    {
        return view('students.community', [
            'page' => 'community',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function internships()
    {
        // Fetch offers with pagination (10 per page)
        $offers = Offer::with(['company', 'company.city'])->paginate(10);

        // Pass the paginated offers to the view
        return view('students.internships', compact('offers'));
    }

    public function messages()
    {
        return view('students.messages', [
            'page' => 'messages',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function settings()
    {
        return view('students.settings', [
            'page' => 'settings',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function wishlist()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }

            $student = $user->student;
            if (!$student) {
                return redirect()->route('student.dashboard')->with('error', 'Profil étudiant non trouvé.');
            }

            $wishlist = $student->wishlist()->with(['offer.company.city'])->paginate(10); // Add pagination

            return view('students.wishlist', [
                'wishlist' => $wishlist,
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

    public function count()
    {
        $count = Student::count();
        return response()->json(['count' => $count]);
    }
}
