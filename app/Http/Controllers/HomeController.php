<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     * Apply auth middleware to ensure only logged-in users can access.
     */
   

    /**
     * Show the customer dashboard / home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get authenticated customer
        $customer = Auth::user();

        // Fetch last 5 orders with their products
        // Assuming Order model has 'items' relationship with 'product'
        $customerOrders = Order::with('items.product')
            ->where('user_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        // Total number of orders
        $totalOrders = Order::where('user_id', $customer->id)->count();

        // Total amount spent
        $totalSpent = Order::where('user_id', $customer->id)->sum('total_price');

        // Pass all data to Blade view
        return view('customer.index', compact(
            'customer',
            'customerOrders',
            'totalOrders',
            'totalSpent'
        ));
    }
}
