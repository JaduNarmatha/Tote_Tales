<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
{
    
    $totalProducts  = Product::count();
    $totalCustomers = User::where('role', 'customer')->count();
    $recentOrders   = Order::latest()->take(5)->get();
    $products       = Product::with('category')->get();
    $lowStock       = Product::where('quantity', '<=', 5)->get();
    $categories     = Category::all(); // if you use this in view

    return view('admin.dashboard', compact(
         'totalProducts', 'totalCustomers',
        'recentOrders', 'products', 'categories', 'lowStock'
    ));
}


    // Products page
    public function productsPage()
    {
        $products = Product::with('category')->get(); 
        $categories = Category::all();                
        return view('admin.products', compact('products', 'categories'));
    }

    // Add product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
        ]);

        Product::create($request->only(['name', 'category_id', 'price']));

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    // Edit product
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-product', compact('product', 'categories'));
    }

    // Update product
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'category_id', 'price']));

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }
    
}
