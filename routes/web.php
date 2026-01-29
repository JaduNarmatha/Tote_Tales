<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Welcome page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Visitor mode
Route::get('/visitor', [WelcomeController::class, 'visitor'])->name('visitor');

// Contact page
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

// About page
Route::get('/about', [CustomerController::class, 'about'])->name('about');

// Auth pages
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Forgot Password (custom)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'update'])
    ->name('password.update.custom');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Customer & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Customer Dashboard / Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Customer dashboard alternative route
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');

    // Categories & Cart
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/cart/add', [CategoryController::class, 'addToCart'])->name('cart.add');

   
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/product/add', [AdminController::class, 'addProductPage'])
        ->name('admin.add.form');
    Route::post('/admin/product/add', [AdminController::class, 'addProduct'])->name('admin.add');

});

/*
|--------------------------------------------------------------------------
| Admin Dashboard Blade (optional static view)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Jetstream / Sanctum Dashboard (Optional)
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Product Management (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
