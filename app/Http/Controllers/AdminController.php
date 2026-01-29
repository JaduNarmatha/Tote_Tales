<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    protected $productModel;
    protected $customerModel;
    protected $orderModel;

    public function __construct()
    {
        // Optional: protect all routes
        $this->middleware('auth');

        $this->productModel = new Product();
        $this->customerModel = new Customer();
        $this->orderModel = new Order();
    }

    // ================= DASHBOARD =================
    public function dashboard()
    {
        $products = Product::all();
        $customers = Customer::all();
        $orders = Order::all();

        // Total revenue
        $revenue = $orders->sum('total_price');

        return view('admin.dashboard', compact(
            'products',
            'customers',
            'orders',
            'revenue'
        ));
    }

    // ================= SHOW ADD PRODUCT PAGE =================
    public function addProductPage()
    {
        $categories = Product::getAllCategories(); // or Category::all()
        return view('admin.add', compact('categories'));
    }

    // ================= HANDLE ADD PRODUCT =================
    public function addProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('products', 'public');
        }

        $success = Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'description' => $request->description,
            'image'       => $imagePath
        ]);

        if ($success) {
            Session::flash('message', 'Product added successfully!');
        } else {
            Session::flash('error', 'Failed to add product.');
        }

        return redirect()->route('admin.add.form');
    }
}
