<?php
use App\Models\Category;
use App\Models\Product;

use App\Models\User;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
;
use App\Models\Order;
use App\Livewire\AdminLogin;
use App\Livewire\CustomerLogin;

Route::get('/admin/login', AdminLogin::class)->name('admin.login');
Route::get('/login', CustomerLogin::class)->name('customer.login');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return Order::with('user', 'items.product')->get();
});

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/visitor', [WelcomeController::class, 'visitor'])->name('visitor');








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
