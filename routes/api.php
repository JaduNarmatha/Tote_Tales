<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication)
|--------------------------------------------------------------------------
|
| Accessible without authentication: health check, product listing, register/login.
|
*/

// API health check
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Tote_Tales API is running'
    ]);
});

// Authentication
Route::post('/register', [AuthController::class, 'register']); // Customer registration
Route::post('/login', [AuthController::class, 'login']);       // Admin & Customer login

// Public product access (Customer / Category page)
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);


/*
|--------------------------------------------------------------------------
| Protected API Routes (Laravel Sanctum)
|--------------------------------------------------------------------------
|
| Requires authentication via Sanctum.
|
*/
Route::middleware('auth:sanctum')->group(function () {

    // Logout (Admin & Customer)
    Route::post('/logout', [AuthController::class, 'logout']);

// Authenticated Home route for customers
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

    /*
    |--------------------------------------------------------------------------
    | Admin API Routes (Admin Only)
    |--------------------------------------------------------------------------
    | Prefix: /admin
    | Middleware: auth:sanctum + api.admin
    */
    Route::middleware('api.admin')->prefix('admin')->group(function () {

        // Admin dashboard stats
        Route::get('/dashboard', [ProductController::class, 'dashboard']);

        // Product CRUD
        Route::post('/products', [ProductController::class, 'store']);           // CREATE
        Route::put('/products/{product}', [ProductController::class, 'update']); // UPDATE
        Route::delete('/products/{product}', [ProductController::class, 'destroy']); // DELETE

        // Low stock products
        Route::get('/products-low-stock', [ProductController::class, 'lowStock']);
    });


    /*
    |--------------------------------------------------------------------------
    | Customer API Routes (Customer Only)
    |--------------------------------------------------------------------------
    | Prefix: /customer
    | Middleware: auth:sanctum + api.customer
    */
    Route::middleware('api.customer')->prefix('customer')->group(function () {

        // Customer home
        Route::get('/home', function () {
            return response()->json([
                'status' => 'success',
                'message' => 'Welcome Customer Home'
            ]);
        });

        // Cart routes
        Route::post('/cart/add/{product}', [ProductController::class, 'addToCart']);
        Route::post('/cart/update/{product}', [ProductController::class, 'updateCart']);
        Route::post('/cart/remove/{product}', [ProductController::class, 'removeFromCart']);
        Route::post('/cart/clear', [ProductController::class, 'clearCart']);
    });
    


    
});

Route::get('/admin/products', [ProductController::class, 'index']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);
Route::post('/admin/products/{id}/purchase', [ProductController::class, 'purchase']);