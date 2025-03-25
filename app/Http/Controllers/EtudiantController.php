<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EtudiantController extends Controller
{
    public function dashboard() {
        $page = 'dashboard';
        return view('etudiants.dashboard', compact('page'));
    }
    
}