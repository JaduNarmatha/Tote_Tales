<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // protect routes
    }

    // ================= CREATE PRODUCT =================
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'image'       => $imagePath
        ]);

        Session::flash('flash', 'Product added successfully!');

        return redirect()->route('products.index');
    }

    // ================= UPDATE PRODUCT =================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')
                                      ->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'quantity'    => $request->quantity
        ]);

        Session::flash('flash', 'Product updated successfully!');

        return redirect()->route('products.index');
    }

    // ================= DELETE PRODUCT =================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        Session::flash('flash', 'Product deleted successfully!');

        return redirect()->route('products.index');
    }
}
