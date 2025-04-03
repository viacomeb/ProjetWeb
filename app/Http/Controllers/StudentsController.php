<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ajoutez cette ligne


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
        return view('students.internships', [
            'page' => 'internships',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
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
        return view('students.wishlist', [
            'page' => 'wishlist',
            // Ajoutez ici les données nécessaires pour le tableau de bord
        ]);
    }
}
