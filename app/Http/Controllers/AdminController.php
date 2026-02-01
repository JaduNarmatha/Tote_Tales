<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $products = Product::with('category')->get();
        $totalProducts = $products->count();

        $customers = User::where('role', 'customer')->get();
        $totalCustomers = $customers->count();

        $orders = Order::with('customer')->get();
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_amount');

        $lowStock = Product::where('quantity', '<=', 5)->get();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'products', 'totalProducts',
            'customers', 'totalCustomers',
            'orders', 'totalOrders', 'totalRevenue',
            'lowStock', 'recentOrders'
        ));
    }

    // Show add product page
    public function addProductPage()
    {
        $categories = Category::all();
        return view('admin.add', compact('categories'));
    }

    // Handle add product
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        Session::flash('message', 'Product added successfully!');
        return redirect()->route('admin.add.form');
    }
}
