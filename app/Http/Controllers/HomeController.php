<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $customer = auth()->user(); // If using Laravel auth

        // Fetch last 5 orders for the customer
        $customerOrders = $customer ? Order::with('items.product')
                                    ->where('customer_id', $customer->id)
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get()
                                    : [];

        // Fetch stats
        $totalOrders = $customer ? Order::where('customer_id', $customer->id)->count() : 0;
        $totalSpent  = $customer ? Order::where('customer_id', $customer->id)->sum('total_amount') : 0;

        return view('home', compact('customer', 'customerOrders', 'totalOrders', 'totalSpent'));
    }
}
