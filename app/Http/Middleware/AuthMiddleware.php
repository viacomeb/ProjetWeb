<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Liste des routes publiques (à adapter selon ton projet)
        $publicRoutes = ['home', 'login', 'register', 'password.request', 'password.reset'];

        // Si la route actuelle est publique, on laisse passer
        if ($request->route() && in_array($request->route()->getName(), $publicRoutes)) {
            return $next($request);
        }

        // Si l'utilisateur n'est pas authentifié, redirection vers login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        return $next($request);
    }
}
