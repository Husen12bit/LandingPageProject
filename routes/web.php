<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/fitur', [LandingController::class, 'fitur'])->name('fitur');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\ClientController;

// Route untuk CRUD Freelancer
Route::prefix('admin')->group(function () {
    Route::resource('freelancer', FreelancerController::class);
    Route::resource('client', ClientController::class);
});
