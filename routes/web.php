<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/fitur', [LandingController::class, 'fitur'])->name('fitur');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AdminDashboardController;

// Route untuk CRUD Freelancer
Route::prefix('admin')->group(function () {
    // Dashboard (utama)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [AdminDashboardController::class, 'index']); // redirect root admin ke dashboard

    Route::resource('freelancer', FreelancerController::class);
    Route::resource('client', ClientController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('bid', BidController::class);
    Route::get('bid/approve/{id}', [BidController::class, 'approve'])->name('bid.approve');
    Route::get('bid/reject/{id}', [BidController::class, 'reject'])->name('bid.reject');
});
