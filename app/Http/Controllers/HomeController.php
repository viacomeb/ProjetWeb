<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Logique pour la page d'accueil
        $page = 'home';
        return view('pages.home', compact('page'));
    }

    public function about()
    {
        // Logique pour la page "À propos"
        $page = 'about';
        return view('about.about', compact('page'));
    }

    public function contact()
    {
        // Logique pour la page de contact
        $page = 'contact';
        return view('pages.contact', compact('page'));
    }

    public function careers()
    {
        // Logique pour la page de carrières
        $page = 'careers';
        return view('about.careers', compact('page'));
    }

    public function guide()
    {
        $page = 'guide';
        return view('about.guide', compact('page'));
    }

    public function support()
    {
        $page = 'support';
        return view('about.support', compact('page'));
    }

    public function legal()
    {
        $page = 'legal';
        return view('about.legal', compact('page'));
    }

    public function cgu()
    {
        $page = 'cgu';
        return view('about.cgu', compact('page'));
    }

    public function privacy()
    {
        $page = 'privacy';
        return view('about.privacy', compact('page'));
    }
}
