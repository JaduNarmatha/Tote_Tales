<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Role protection
        if ($user->role !== 'customer') {
            abort(403, 'Unauthorized');
        }

        // Recent orders
        $customerOrders = Order::with('items.product')
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Stats
        $totalOrders = Order::where('customer_id', $user->id)->count();

        $totalSpent = Order::where('customer_id', $user->id)
            ->sum('total_amount');

        return view('customer.dashboard', compact(
            'user',
            'customerOrders',
            'totalOrders',
            'totalSpent'
        ));
    }
}
