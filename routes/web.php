<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ErrorController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/carrieres', [HomeController::class, 'carrieres'])->name('carrieres');

Route::get('/connexion', [AuthController::class, 'connexion'])->name('auth.connexion');
Route::get('/inscription', [AuthController::class, 'inscription'])->name('auth.inscription');

Route::get('/entreprises', [EntrepriseController::class, 'liste'])->name('entreprises.liste');
Route::get('/entreprises/{id}', [EntrepriseController::class, 'show'])->name('entreprises.show');

Route::get('/offres', [OffreController::class, 'liste'])->name('offres.liste');
Route::get('/offres/{id}', [OffreController::class, 'show'])->name('offres.show');

Route::get('/etudiants', [EtudiantController::class, 'dashboard'])->name('etudiants.dashboard');
