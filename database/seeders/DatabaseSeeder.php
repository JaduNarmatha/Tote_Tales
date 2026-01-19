<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Create Users
        |--------------------------------------------------------------------------
        */

        // Admin user (for Sanctum login testing)
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@totetales.com',
            'password' => Hash::make('password'),
        ]);

        // Other users
        User::factory(4)->create();

        /*
        |--------------------------------------------------------------------------
        | Create Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::factory(4)->create();

        /*
        |--------------------------------------------------------------------------
        | Create Products
        |--------------------------------------------------------------------------
        */

        $products = Product::factory(10)->create();

        /*
        |--------------------------------------------------------------------------
        | Create Orders
        |--------------------------------------------------------------------------
        */

        $orders = Order::factory(5)->create([
            'user_id' => $admin->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Order Items
        |--------------------------------------------------------------------------
        */

        foreach ($orders as $order) {
            OrderItem::factory(2)->create([
                'order_id' => $order->id,
            ]);
        }
    }
}
