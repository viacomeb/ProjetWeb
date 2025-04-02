<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    protected $page;

    public function __construct()
    {
        $this->page = 'companies';
    }

    public function list()
    {
        // Récupérer toutes les entreprises
        $companies = Company::all();
        return view('companies.list', ['companies' => $companies, 'page' => $this->page]);
    }

    public function show($id)
    {
        // Récupérer une entreprise spécifique
        $company = Company::findOrFail($id);
        return view('companies.show', ['company' => $company, 'page' => $this->page]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:100',
            'sector' => 'required|string|max:100',
            'street_number' => 'required|integer',
            'street' => 'required|string|max:100',
            'city_name' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country_name' => 'required|string|max:100',
            'department_name' => 'required|string|max:100',
        ]);

        \Log::info('Validated data:', $validatedData);

        // Create or find the country
        $country = \App\Models\Country::firstOrCreate(['country_name' => $validatedData['country_name']]);
        \Log::info('Country created or found:', ['country' => $country]);

        // Create or find the department
        $department = \App\Models\Department::firstOrCreate([
            'department_name' => $validatedData['department_name'],
            'country_id' => $country->id,
        ]);
        \Log::info('Department created or found:', ['department' => $department]);

        // Create or find the city
        $city = \App\Models\City::firstOrCreate([
            'city_name' => $validatedData['city_name'],
            'department_id' => $department->id,
        ]);
        \Log::info('City created or found:', ['city' => $city]);

        // Create the company
        $company = \App\Models\Company::create([
            'company_name' => $validatedData['company_name'],
            'sector' => $validatedData['sector'],
            'street_number' => $validatedData['street_number'],
            'street' => $validatedData['street'],
            'city_id' => $city->id,
            'postal_code' => $validatedData['postal_code'],
        ]);
        \Log::info('Company created:', ['company' => $company]);

        return redirect()->route('admin.companies')->with('success', 'Entreprise créée avec succès.');
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des entreprises
}
