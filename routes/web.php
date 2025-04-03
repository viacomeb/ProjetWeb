<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PilotsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');
Route::get('/guide', [HomeController::class, 'guide'])->name('guide');
Route::get('/support', [HomeController::class, 'support'])->name('support');
Route::get('/legal', [HomeController::class, 'legal'])->name('legal');
Route::get('/cgu', [HomeController::class, 'cgu'])->name('cgu');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware(ThrottleRequests::class . ':5,1')->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Password reset routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Authenticated routes
Route::get('/companies', [CompaniesController::class, 'list'])->name('companies.list');
Route::get('/companies', [CompaniesController::class, 'publiclist'])->name('companies.publiclist');
Route::get('/companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');
Route::put('/companies/{id}', [CompaniesController::class, 'update'])->name('companies.update');

Route::get('/offers', [OffersController::class, 'list'])->name('offers.list');
Route::get('/offers/{id}', [OffersController::class, 'show'])->name('offers.show');
Route::put('/offers/{id}', [OffersController::class, 'update'])->name('offers.update');

Route::middleware(['auth'])->group(function () {
    // Admin-specific routes
    Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
        Route::get('/internships', [AdminController::class, 'internships'])->name('internships');
        Route::get('/pilots', [AdminController::class, 'pilots'])->name('pilots');
        Route::get('/students', [AdminController::class, 'students'])->name('students');
        Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/internships/store', [OffersController::class, 'store'])->name('internships.store');
        Route::post('/pilots/store', [AdminController::class, 'storePilot'])->name('pilots.store');
        Route::post('/companies/store', [CompaniesController::class, 'store'])->name('companies.store');
        Route::delete('/companies/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
    });

    Route::middleware([RoleMiddleware::class . ':pilot'])->prefix('pilots')->name('pilots.')->group(function () {
        Route::get('/dashboard', [PilotsController::class, 'dashboard'])->name('dashboard');
        Route::get('/companies', [PilotsController::class, 'companies'])->name('companies');
        Route::get('/internships', [PilotsController::class, 'internships'])->name('internships');
        Route::get('/students', [PilotsController::class, 'students'])->name('students');
        Route::get('/applications', [PilotsController::class, 'applications'])->name('applications');
        Route::get('/settings', [PilotsController::class, 'settings'])->name('settings');
        Route::post('/internships/store', [OffersController::class, 'store'])->name('internships.store');
        Route::post('/companies/store', [CompaniesController::class, 'store'])->name('companies.store');
        Route::delete('/companies/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
    });

    // Pilot-specific routes
    Route::middleware([RoleMiddleware::class . ':pilot'])->group(function () {
        Route::get('/pilot/create-student', [AuthController::class, 'showRegisterForm'])->name('pilot.create.student');
        Route::post('/pilot/create-student', [AuthController::class, 'register'])->name('pilot.store.student');
        Route::resource('companies', CompaniesController::class)->only(['create', 'store']);
        Route::resource('offers', OffersController::class)->only(['create', 'store']);
    });

    // Student-specific routes
    Route::middleware([RoleMiddleware::class . ':student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentsController::class, 'dashboard'])->name('dashboard');
        Route::get('/internships', [StudentsController::class, 'internships'])->name('internships');
        Route::get('/wishlist', [StudentsController::class, 'wishlist'])->name('wishlist');
        Route::get('/challenges', [StudentsController::class, 'challenges'])->name('challenges');
        Route::get('/community', [StudentsController::class, 'community'])->name('community');
        Route::get('/messages', [StudentsController::class, 'messages'])->name('messages');
        Route::get('/settings', [StudentsController::class, 'settings'])->name('settings');
    });
});

// General routes
Route::get('/students', [StudentsController::class, 'list']);
Route::get('/pilots', [PilotsController::class, 'list']);
Route::get('/skills', [SkillsController::class, 'list']);
