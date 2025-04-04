<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || !in_array($role, ['student', 'pilot', 'admin'])) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier si l'utilisateur a le rôle spécifié en utilisant les relations
        if ($role === 'student' && !$user->student) {
            abort(403, 'Accès non autorisé. Vous devez être un étudiant.');
        } elseif ($role === 'pilot' && !$user->pilot) {
            abort(403, 'Accès non autorisé. Vous devez être un pilote.');
        } elseif ($role === 'admin' && !$user->admin) {
            abort(403, 'Accès non autorisé. Vous devez être un administrateur.');
        }

        return $next($request);
    }
}
