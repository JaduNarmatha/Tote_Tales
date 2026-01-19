<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::with('category')->get()
        );
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'color' => $request->color,
            'category_id' => $request->category_id,
        ]);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource(
            $product->load('category')
        );
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
