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

    // Autres méthodes pour créer, mettre à jour, supprimer des entreprises
}
