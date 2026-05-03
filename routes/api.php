<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BidController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\OfferController;

// Public routes (tanpa auth)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

// Public data (read only)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/freelancers', [FreelancerController::class, 'index']);
Route::get('/freelancers/{id}', [FreelancerController::class, 'show']);

// Protected routes (dengan auth token)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // User Profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);

    // Projects (write operations)
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::get('/my-projects', [ProjectController::class, 'myProjects']);

    // Apply to project
    Route::post('/projects/{id}/apply', [ProjectController::class, 'apply']);

    // My bids (freelancer)
    Route::get('/my-bids', [BidController::class, 'myBids']);

    // Chat
    Route::get('/chats/{projectId}', [ChatController::class, 'index']);
    Route::post('/chats/{projectId}', [ChatController::class, 'send']);

    // Offers Management
    Route::get('/projects/{projectId}/offers', [OfferController::class, 'index']);
    Route::put('/offers/{id}/accept', [OfferController::class, 'accept']);
    Route::put('/offers/{id}/reject', [OfferController::class, 'reject']);
    Route::get('/my-offers', [OfferController::class, 'myOffers']);
});
