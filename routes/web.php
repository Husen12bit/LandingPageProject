<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/fitur', [LandingController::class, 'fitur'])->name('fitur');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');

//auth routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TransactionController;

// Route untuk CRUD Freelancer
Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard (utama)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [AdminDashboardController::class, 'index']); // redirect root admin ke dashboard

    Route::resource('freelancer', FreelancerController::class);
    Route::resource('client', ClientController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('bid', BidController::class);
    // User Management
    Route::resource('user', UserController::class);
    // Transaction (only index & show)
    Route::resource('transaction', TransactionController::class)->only(['index', 'show']);
    // Offer Management with approve/reject
    Route::resource('offer', OfferController::class);
    Route::get('offer/{id}/approve', [OfferController::class, 'approve'])->name('offer.approve');
    Route::get('offer/{id}/reject', [OfferController::class, 'reject'])->name('offer.reject');
    Route::get('bid/approve/{id}', [BidController::class, 'approve'])->name('bid.approve');
    Route::get('bid/reject/{id}', [BidController::class, 'reject'])->name('bid.reject');
});
