<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::with('products')->get()
        );
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource(
            $category->load('products')
        );
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
        ]);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
