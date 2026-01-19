<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        $item = OrderItem::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return new OrderItemResource($item);
    }
}

