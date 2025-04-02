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
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

// Login routes
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Password reset routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Authenticated routes
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/companies', [CompaniesController::class, 'list'])->name('companies.list');
    Route::get('/companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');

    Route::get('/offers', [OffersController::class, 'list'])->name('offers.list');
    Route::get('/offers/{id}', [OffersController::class, 'show'])->name('offers.show');

    Route::get('/students/dashboard', [StudentsController::class, 'dashboard'])->name('students.dashboard');
    Route::get('/pilots/dashboard', [PilotsController::class, 'dashboard'])->name('pilots.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin-specific routes
    Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
        Route::get('/internships', [AdminController::class, 'internships'])->name('internships');
        Route::get('/pilots', [AdminController::class, 'pilots'])->name('pilots');
        Route::get('/students', [AdminController::class, 'students'])->name('students');
        Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    });

    // Pilot-specific routes
    Route::middleware([RoleMiddleware::class . ':pilot'])->group(function () {
        Route::get('/pilot/create-student', [AuthController::class, 'showRegisterForm'])->name('pilot.create.student');
        Route::post('/pilot/create-student', [AuthController::class, 'register'])->name('pilot.store.student');
        Route::resource('companies', CompaniesController::class)->only(['create', 'store']);
        Route::resource('offers', OffersController::class)->only(['create', 'store']);
    });

    // Student-specific routes
    Route::middleware([RoleMiddleware::class . ':student'])->group(function () {
        Route::post('/offers/{id}/apply', [OffersController::class, 'apply'])->name('offers.apply');
        Route::post('/offers/{id}/wishlist', [OffersController::class, 'addToWishlist'])->name('offers.wishlist');
    });
});
