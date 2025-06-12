<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MobilController as AdminMobilController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\PelangganController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User Dashboard (Pelanggan)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Rental routes for customers
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental/mobil/{mobil}', [RentalController::class, 'show'])->name('rental.show');
    Route::get('/rental/mobil/{mobil}/sewa', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rental/mobil/{mobil}/sewa', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/my-rentals', [RentalController::class, 'myRentals'])->name('rental.my-rentals');
    Route::patch('/rental/{rental}/cancel', [RentalController::class, 'cancel'])->name('rental.cancel');
});

// Admin Routes
Route::middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Mobil management
        Route::resource('mobil', AdminMobilController::class)->names('mobil');

        // Pelanggan management
        Route::resource('pelanggan', PelangganController::class)->names('pelanggan');

        // Rental management
        Route::get('/rental', [AdminRentalController::class, 'index'])->name('rental.index');
        Route::get('/rental/{rental}', [AdminRentalController::class, 'show'])->name('rental.show');
        Route::patch('/rental/{rental}/status', [AdminRentalController::class, 'updateStatus'])->name('rental.update-status');
        Route::put('/rental/{id}/status', [AdminRentalController::class, 'updateStatus'])->name('rental.updateStatus');
         Route::post('/rental/{rental}/update-status', [AdminRentalController::class, 'updateStatus'])->name('rental.updateStatus');

    });
