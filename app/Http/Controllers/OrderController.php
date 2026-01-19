<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(
            Order::with('user', 'items.product')->get()
        );
    }

    public function show(Order $order)
    {
        return new OrderResource(
            $order->load('user', 'items.product')
        );
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        return new OrderResource($order);
    }
}
