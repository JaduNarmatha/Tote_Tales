<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class AdminProducts extends Component
{
    use WithFileUploads;

    public $products;
    public $categories;

    // Add Product
    public $name, $price, $quantity, $category_id, $image;

    // Edit Product
    public $edit_product_id, $edit_name, $edit_price, $edit_quantity, $edit_category_id, $edit_image;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->products = Product::with('category')->get();
        $this->categories = Category::all();
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id,
            'image' => $imagePath
        ]);

        $this->reset(['name', 'price', 'quantity', 'category_id', 'image']);
        $this->loadData();
        session()->flash('flash', 'Product added successfully!');
    }

    public function openEditModal($id)
    {
        $product = Product::findOrFail($id);

        $this->edit_product_id = $product->id;
        $this->edit_name = $product->name;
        $this->edit_price = $product->price;
        $this->edit_quantity = $product->quantity;
        $this->edit_category_id = $product->category_id;

        $this->dispatchBrowserEvent('openEditModal');
    }

    public function updateProduct()
    {
        $this->validate([
            'edit_name' => 'required|string|max:255',
            'edit_price' => 'required|numeric',
            'edit_quantity' => 'required|integer',
            'edit_category_id' => 'required|exists:categories,id',
            'edit_image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($this->edit_product_id);
        $imagePath = $this->edit_image ? $this->edit_image->store('products', 'public') : $product->image;

        $product->update([
            'name' => $this->edit_name,
            'price' => $this->edit_price,
            'quantity' => $this->edit_quantity,
            'category_id' => $this->edit_category_id,
            'image' => $imagePath
        ]);

        $this->loadData();
        $this->dispatchBrowserEvent('closeEditModal');
        session()->flash('flash', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        $this->loadData();
        session()->flash('flash', 'Product deleted successfully!');
    }

    public function render()
    {
        return view('livewire.adminproducts');
    }
}
