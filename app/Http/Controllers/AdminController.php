<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilot;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\City;
use App\Models\Student;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Logique pour récupérer les données spécifiques au tableau de bord des administrateurs
        return view('admin.dashboard', [
            'page' => 'dashboard',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }

    public function companies()
    {
        $companies = Company::with('city')->paginate(10); // Utiliser la pagination Laravel

        return view('admin.companies', [
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

        $companies = Company::select('company_id', 'company_name')->orderBy('company_name', 'asc')->get(); // Sort companies alphabetically

        return view('admin.internships', [
            'page' => 'internships',
            'offers' => $offers,
            'companies'=> $companies,
        ]);
    }

    public function pilots()
    {
        $pilots = Pilot::join('Users', 'Pilots.user_id', '=', 'Users.user_id')
            ->select('Users.first_name', 'Users.last_name', 'Users.email', 'Pilots.*')
            ->paginate(10);

        $cities = City::select('city_id', 'city_name')->orderBy('city_name', 'asc')->get(); // Sort cities alphabetically

        return view('admin.pilots', [
            'page' => 'pilots',
            'pilots' => $pilots,
            'cities' => $cities,
        ]);
    }

    public function storePilot(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email|max:50|unique:users,email',
                'password' => 'required|string|min:8',
                'street' => 'nullable|string|max:50',
                'street_number' => 'nullable|integer',
                'city_id' => 'required|exists:cities,city_id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->street = $request->input('street');
            $user->street_number = $request->input('street_number');
            $user->city_id = $request->input('city_id');
            $user->save();

            $pilot = new Pilot();
            $pilot->user_id = $user->user_id;
            $pilot->save();

            return response()->json(['message' => 'Pilote créé avec succès'], 201);
        } catch (\Exception $e) {
            \Log::error('Erreur dans storePilot : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur interne'], 500);
        }
    }

    public function students()
    {
        $students = Student::join('Users', 'Students.user_id', '=', 'Users.user_id')
            ->select('Users.first_name', 'Users.last_name', 'Users.email', 'Students.*')
            ->paginate(10); // Removed get() before paginate()

        $cities = City::all();

        return view('admin.students', [
            'page' => 'students',
            'students' => $students,
            'cities' => $cities,
        ]);
    }

    public function applications()
    {
        // Logique pour récupérer les données des candidatures
        return view('admin.applications', [
            'page' => 'applications',
            // Ajoutez ici les données nécessaires pour les candidatures
        ]);
    }

    public function settings()
    {
        // Logique pour gérer les paramètres
        return view('admin.settings', [
            'page' => 'settings',
            // Ajoutez ici les données nécessaires pour les paramètres
        ]);
    }
}
