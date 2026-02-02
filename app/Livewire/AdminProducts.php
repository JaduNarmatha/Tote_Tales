<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    // Return Blade page
    public function productsPage()
    {
        $categories = Category::all();
        return view('admin.products', compact('categories'));
    }

    // Return all products as JSON
    public function getProducts()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    // Store new product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::create($request->all());

        return response()->json(['message' => 'Product added!', 'product' => $product]);
    }

    // Update product
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json(['message' => 'Product updated!', 'product' => $product]);
    }

    // Delete product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted!']);
    }
}
