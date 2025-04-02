<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.dashboard', [
            'student' => $user->student,
            'page' => 'dashboard',
        ]);
    }

    public function internships()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.internships', [
            'student' => $user->student,
            'page' => 'internships',
        ]);
    }

    public function wishlist()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.wishlist', [
            'student' => $user->student,
            'page' => 'wishlist',
        ]);
    }

    public function challenges()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.challenges', [
            'student' => $user->student,
            'page' => 'challenges',
        ]);
    }

    public function community()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.community', [
            'student' => $user->student,
            'page' => 'communauté',
        ]);
    }

    public function messages()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.messages', [
            'student' => $user->student,
            'page' => 'messagerie',
        ]);
    }

    public function settings()
    {
        $user = auth()->user();
        if (!$user || !$user->student) {
            return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
        }

        return view('students.settings', [
            'student' => $user->student,
            'page' => 'profil',
        ]);
    }
}
