<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // List all products
    public function index() {
        $products = Product::with('category')->latest()->get();
        $lowStock = Product::where('quantity', '<=', 5)->get();
        return view('admin.products.index', compact('products', 'lowStock'));
    }

    // Show create form
    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        Session::flash('success', 'Product added successfully!');
        return redirect()->route('admin.products.index');
    }

    // Show edit form
    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($request->hasFile('image')) {
            if($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        Session::flash('success', 'Product updated successfully!');
        return redirect()->route('admin.products.index');
    }

    // Delete product
    public function destroy(Product $product) {
        if($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        Session::flash('success', 'Product deleted successfully!');
        return redirect()->route('admin.products.index');
    }
}
