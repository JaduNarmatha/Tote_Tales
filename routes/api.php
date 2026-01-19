<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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
