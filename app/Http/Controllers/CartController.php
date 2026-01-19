<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
            'image' => $product->image
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart');
    }

    public function view()
    {
        return view('cart.index');
    }
}
