<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckPage
{
    protected $validPages = [
        'home',
        'about',
        'blog',
        'contact',
        'carrieres',
        'auth.connexion',
        'auth.inscription',
        'entreprises.liste',
        'entreprises.show',
        'offres.liste',
        'offres.show',
        'etudiants.dashboard',
    ];

    /**
     * Vérifier la validité de la page avant de la rendre accessible.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérer le nom de la route actuelle
        $routeName = $request->route()->getName();

        dd($routeName);  // Affiche le nom de la route pour déboguer


        // Vérifier si la route existe dans $validPages
        if (!in_array($routeName, $this->validPages)) {
            // Si la page n'est pas valide, retourner une erreur 403
            abort(403, 'Access forbidden');
        }

        // Si tout est valide, continuer le traitement
        return $next($request);
    }
}
