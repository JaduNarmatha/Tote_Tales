<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    // Add a product
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
        ]);

        return response()->json($product, 201);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update($request->only('name', 'price', 'category_id', 'image'));

        return response()->json($product);
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) Storage::disk('public')->delete($product->image);

        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
