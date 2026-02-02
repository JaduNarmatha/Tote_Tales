<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['auth', 'admin']); // Protect all admin routes
    }

    // ================= INDEX =================
    public function index()
    {
        // Get all products with their category
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        return view('livewire.adminproducts', compact('products', 'categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Create product
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath
        ]);

        Session::flash('flash', 'Product added successfully!');
        return redirect()->route('admin.products');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('livewire.adminproductform', compact('product', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $product->image
        ]);

        Session::flash('flash', 'Product updated successfully!');
        return redirect()->route('admin.products');
    }

    // ================= DESTROY =================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        Session::flash('flash', 'Product deleted successfully!');
        return redirect()->route('admin.products');
    }
}
