<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    
    WelcomeController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ForgotPasswordController,
    CustomerDashboardController,
    HomeController,
    CustomerController,
    CategoryController,
    CartController,
    

};
use App\Http\Controllers\AdminProductController;

use App\Http\Controllers\Api\ProductController;




// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', App\Http\Controllers\AdminProductController::class);
});

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Product CRUD
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/products/add', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    // Low stock products
    Route::get('/products-low-stock', function () {
        return view('livewire.adminproducts');
    })->name('admin.products.lowstock');


/*
|--------------------------------------------------------------------------
| Admin Routes (AUTH + ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Products (load Livewire view directly)
    Route::get('/products', function () {
        return view('livewire.adminproducts'); // ✅ Correct folder & file
    })->name('admin.products');

    Route::get('/product/add', function () {
        return view('livewire.adminproducts');
    })->name('admin.add.form');

    Route::get('/products-low-stock', function () {
        return view('livewire.adminproducts');
    })->name('admin.products.lowstock');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.store');

    // Register
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.store');

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/visitor', [WelcomeController::class, 'visitor'])->name('visitor');

Route::get('/contact', fn() => view('contact.index'))->name('contact');
Route::get('/about', [CustomerController::class, 'about'])->name('about');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Products (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Authenticated Users (CUSTOMER + ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboards
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});
// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration POST
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Products
    Route::get('/admin/products', [AdminController::class, 'productsPage'])->name('admin.products');
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});

Route::get('/categories', [ProductController::class, 'index'])->name('categories');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/cart/add/{product}', [ProductController::class, 'addToCart'])->name('cart.add');

