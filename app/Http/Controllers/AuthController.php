<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function showLoginForm()
    {
        return view('auth.login', ['page' => 'login']);
    }

    // Gérer l'authentification
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email ou mot de passe incorrect.',
            'email.email' => 'Email ou mot de passe incorrect.',
            'password.required' => 'Email ou mot de passe incorrect.',
            'password.min' => 'Email ou mot de passe incorrect.',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirection en fonction du rôle
            $redirectUrl = match (true) {
                Auth::user()->student !== null => route('students.overview'),
                Auth::user()->pilot !== null => route('pilots.dashboard'),
                Auth::user()->admin !== null => route('admin.dashboard'),
                default => route('home'),
            };

            // Si la requête est AJAX, une réponse JSON est renvoyée
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => $redirectUrl,
                ]);
            }

            // Redirection classique
            return redirect()->intended($redirectUrl);
        }

        // Gestion des erreurs
        $errorMessage = 'Email ou mot de passe incorrect.';
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $errorMessage,
            ], 401);
        }

        return back()->withErrors([
            'email' => $errorMessage,
            'password' => $errorMessage,
        ])->withInput();
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // Afficher la page d'inscription
    public function showRegisterForm()
    {
        return view('auth.register', ['page' => 'register']);
    }

    // Gérer l'inscription
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:pilot,student' // Only pilots and students can be created
        ]);

        // Restrict role assignment based on the current user's role
        if (Auth::user()->pilot && $data['role'] !== 'student') {
            return back()->withErrors(['role' => 'Pilots can only create student accounts.']);
        }

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return redirect()->route('home')->with('success', 'Account created successfully.');
    }
}
