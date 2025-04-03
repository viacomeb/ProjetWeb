<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilot;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\City;
use App\Models\Student;

class PilotsController extends Controller
{
    public function dashboard()
    {
        // Logique pour récupérer les données spécifiques au tableau de bord des pilotes
        return view('pilots.dashboard', [
            'page' => 'dashboard',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function companies()
    {
        $companies = Company::with('city')->paginate(10); // Utiliser la pagination Laravel

        return view('pilots.companies', [
            'page' => 'companies',
            'companies' => $companies, // Passer les entreprises avec les villes à la vue
        ]);
    }

    public function internships(Request $request)
    {
        $status = $request->query('status'); // Récupérer le statut depuis la requête

        $query = \App\Models\Offer::with('company');

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $offers = $query->paginate(10);

        return view('pilots.internships', [
            'page' => 'internships',
            'offers' => $offers,
        ]);
    }

    public function students()
    {
        $students = Student::join('Users', 'Students.user_id', '=', 'Users.user_id')
            ->select('Users.first_name', 'Users.last_name', 'Users.email', 'Students.*')
            ->paginate(10); // Removed get() before paginate()

        $cities = City::all();

        return view('pilots.students', [
            'page' => 'students',
            'students' => $students,
            'cities' => $cities,
        ]);
    }

    public function applications()
    {
        // Logique pour récupérer les données des candidatures
        return view('pilots.applications', [
            'page' => 'applications',
            // Ajoutez ici les données nécessaires pour les candidatures
        ]);
    }

    public function settings()
    {
        // Logique pour gérer les paramètres
        return view('pilots.settings', [
            'page' => 'settings',
            // Ajoutez ici les données nécessaires pour les paramètres
        ]);
    }
}
