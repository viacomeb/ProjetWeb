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

    public function blog()
    {
        // Logique pour la page de blog
        $page = 'blog';
        return view('about.blog', compact('page'));
    }

    public function carrieres()
    {
        // Logique pour la page de carrières
        $page = 'carrieres';
        return view('about.carrieres', compact('page'));
    }

}  