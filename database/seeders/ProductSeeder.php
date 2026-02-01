<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::all()->each(function ($product) {
            $product->update([
                'quantity' => rand(5, 50)
            ]);
        });
    }
}
