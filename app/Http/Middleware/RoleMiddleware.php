<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || !in_array($role, ['student', 'pilot', 'admin']) || !$user->$role) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
