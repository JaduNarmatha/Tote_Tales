<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ProductController,
    WelcomeController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ForgotPasswordController,
    CustomerDashboardController,
    HomeController,
    CustomerController,
    CategoryController,
    CartController
};
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/product/add', [AdminController::class, 'addProductPage'])->name('admin.add.form');
    Route::post('/product/add', [AdminController::class, 'addProduct'])->name('admin.add.submit');
    Route::resource('products', ProductController::class)->except(['show']);
});

// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/visitor', [WelcomeController::class, 'visitor'])->name('visitor');
Route::get('/contact', fn () => view('contact.index'))->name('contact');
Route::get('/about', [CustomerController::class, 'about'])->name('about');

// Authentication Routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'update'])->name('password.update.custom');

// Public Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    // Products for non-admin users (view only)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});
