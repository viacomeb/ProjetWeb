<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
    public function dashboard()
    {
        $page = 'dashboard';
        $student = auth()->user()->student; // Récupérer l'étudiant associé à l'utilisateur connecté
        return view('students.dashboard', compact('page', 'student'));
    }
}
