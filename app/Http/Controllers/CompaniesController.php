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
        $companies = Company::all();
        return response()->json($companies);
    }

    public function show($id)
    {
        try {
            $company = Company::with(['city.department.country'])->findOrFail($id);

            // Vérifiez si les relations existent
            if (!$company->city || !$company->city->department || !$company->city->department->country) {
                throw new \Exception('Relations manquantes pour l\'entreprise.');
            }

            // Check if the request is an AJAX request
            if (request()->ajax()) {
                return response()->json($company);
            }

            return view('companies.show', ['company' => $company, 'page' => $this->page]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching company data: ' . $e->getMessage());

            if (request()->ajax()) {
                return response()->json(['error' => 'Failed to fetch company data.'], 500);
            }

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la récupération des données de l\'entreprise.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:50',
            'street' => 'nullable|string|max:50',
            'street_number' => 'nullable|integer',
            'city_name' => 'required|string|max:50',
            'postal_code' => 'required|integer',
            'department_name' => 'required|string|max:50',
            'country_name' => 'required|string|max:50',
        ]);

        // Create or find the country
        $country = \App\Models\Country::firstOrCreate([
            'country_name' => $validatedData['country_name']
        ]);

        // Create or find the department
        $department = \App\Models\Department::firstOrCreate([
            'department_name' => $validatedData['department_name'],
            'country_id' => $country->country_id,
        ]);

        // Create or find the city
        $city = \App\Models\City::firstOrCreate([
            'city_name' => $validatedData['city_name'],
            'postal_code' => $validatedData['postal_code'],
            'department_id' => $department->department_id,
        ]);

        // Create the company
        $company = \App\Models\Company::create([
            'company_name' => $validatedData['company_name'],
            'description' => $validatedData['description'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'street' => $validatedData['street'],
            'street_number' => $validatedData['street_number'],
            'city_id' => $city->city_id,
        ]);

        return redirect()->route('admin.companies')->with('success', 'Entreprise créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:50',
            'street' => 'nullable|string|max:50',
            'street_number' => 'nullable|integer',
            'city_name' => 'required|string|max:50',
            'postal_code' => 'required|integer',
            'department_name' => 'required|string|max:50',
            'country_name' => 'required|string|max:50',
        ]);

        $company = Company::findOrFail($id);

        // Update or find the country
        $country = \App\Models\Country::firstOrCreate([
            'country_name' => $validatedData['country_name']
        ]);

        // Update or find the department
        $department = \App\Models\Department::firstOrCreate([
            'department_name' => $validatedData['department_name'],
            'country_id' => $country->country_id,
        ]);

        // Update or find the city
        $city = \App\Models\City::firstOrCreate([
            'city_name' => $validatedData['city_name'],
            'postal_code' => $validatedData['postal_code'],
            'department_id' => $department->department_id,
        ]);

        // Update the company
        $company->update([
            'company_name' => $validatedData['company_name'],
            'description' => $validatedData['description'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'street' => $validatedData['street'],
            'street_number' => $validatedData['street_number'],
            'city_id' => $city->city_id,
        ]);

        return redirect()->route('admin.companies')->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies')->with('success', 'Entreprise supprimée avec succès.');
    }

    // Autres méthodes pour créer, mettre à jour, supprimer des entreprises
}
