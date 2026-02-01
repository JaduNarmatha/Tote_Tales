<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;


// Auth
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // 👑 Admin API
    Route::middleware('api.admin')->get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome Admin Dashboard'
        ]);
    });

    // 👤 Customer API
    Route::middleware('api.customer')->get('/customer/home', function () {
        return response()->json([
            'message' => 'Welcome Customer Home'
        ]);
    });
});


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider and are prefixed
| with /api. They are intended for the Tote_Tales application.
|
*/

// Test route to check API status
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});
Route::post('/register', [AuthController::class, 'register']);


// Authentication routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Product CRUD (Tote_Tales products)
    Route::apiResource('products', ProductController::class);

});
