<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $customerId = Auth::id();

        // Get all categories
        $categories = Category::orderBy('name')->get();

        // Get all product IDs in user's wishlist at once
        $wishlistProductIds = Wishlist::where('user_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        // Attach products + wishlist info
        foreach ($categories as $category) {
            $category->products = Product::where('category_id', $category->id)
                ->latest()
                ->get()
                ->map(function ($product) use ($wishlistProductIds) {
                    $product->in_wishlist = in_array($product->id, $wishlistProductIds);
                    return $product;
                });
        }

        return view('customer.category', compact('categories'));
    }
}
