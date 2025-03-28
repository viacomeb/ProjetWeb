<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Logique pour la page de connexion
        $page = 'login';

        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                return redirect()->route('students.dashboard');
            }
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        return view('auth.login', compact('page'));
    }

    public function sign_in(Request $request)
    {
        // Logique pour la page d'inscription
        $page = 'sign_in';

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $data['password'] = bcrypt($data['password']);
            User::create($data);

            return redirect()->route('login');
        }

        return view('auth.sign_in', compact('page'));
    }

    // Autres méthodes pour gérer l'authentification
}
