<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show cart items
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Check if product is out of stock
        if ($product->is_out_of_stock) {
            return redirect()->back()->with('error', 'Cannot add product to cart. Out of stock!');
        }

        $cart = session()->get('cart', []);
        $quantityToAdd = $request->input('quantity', 1);

        // Check if requested quantity exceeds stock
        if ($quantityToAdd > $product->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available!');
        }

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id]['quantity'] + $quantityToAdd;
            if ($newQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'Not enough stock available!');
            }
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantityToAdd,
                'image'    => $product->image_path // make sure Product has image_path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart');
    }

    /**
     * Update the quantity of a product in the cart
     */
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return redirect()->back()->with('error', 'Product not found in cart');
        }

        $newQuantity = max(1, $request->input('quantity', 1));

        // Prevent exceeding stock
        if ($newQuantity > $product->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available!');
        }

        $cart[$product->id]['quantity'] = $newQuantity;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated');
    }

    /**
     * Remove a product from the cart
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product removed from cart');
        }

        return redirect()->back()->with('error', 'Product not found in cart');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'Cart cleared');
    }
}
