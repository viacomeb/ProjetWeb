<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/sign_in', [AuthController::class, 'sign_in'])->name('sign_in');

Route::get('/students/dashboard', [StudentsController::class, 'dashboard'])->name('students.dashboard');

Route::get('/companies', [CompaniesController::class, 'list'])->name('companies.list');
Route::get('/companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');

Route::get('/offers', [OffersController::class, 'list'])->name('offers.list');
Route::get('/offers/{id}', [OffersController::class, 'show'])->name('offers.show');
