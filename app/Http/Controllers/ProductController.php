<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // ================= CUSTOMER =================

    // Show all products
    public function index()
    {
        $products = Product::latest()->get(); // Show all products
        $categories = Category::orderBy('name')->get();
        return view('customer.category', compact('products', 'categories'));
    }

    // Show single product detail
    public function show(Product $product)
    {
        return view('customer.productdetail', compact('product'));
    }

    // Add product to cart
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;

        if ($quantity > $product->quantity) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        // Get current cart from session or empty array
        $cart = Session::get('cart', []);

        // If product already in cart, increase quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        // Save cart back to session
        Session::put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }
}
