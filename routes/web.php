<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    
    WelcomeController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ForgotPasswordController,
    AuthController,
    CustomerDashboardController,
    HomeController,
    CustomerController,
    CategoryController,
    CartController,
    OrderController,
};
use App\Http\Controllers\AdminProductController;

use App\Http\Controllers\Api\ProductController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


/* Home page (Customer) */
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

/* Admin dashboard */
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

//admin route 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/forgot-password', fn () => view('auth.forgot-password'))->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'updatePassword'])->name('password.update');

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
// Authenticated Home route for customers
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


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

// role base login routes with middleware
Route::middleware(['auth'])->get('/home', function () {
    return view('home');
});

Route::middleware(['auth', 'admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

//Middleware is used for authorization and route protection
// A customer types /admin/dashboard manually
//A customer is logged in
// They are BLOCKED.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

//Guest	/admin/dashboard	Redirect to login
//Customer	/admin/dashboard	403 Forbidden
//Admin	/admin/dashboard	Access granted
return redirect('/home')->with('error', 'Access denied');
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'updatePassword'])->name('password.update');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware('auth','admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', ProductController::class, ['as' => 'admin']);
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('revenue', [OrderController::class, 'revenue'])->name('admin.revenue');
    Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers');
});
