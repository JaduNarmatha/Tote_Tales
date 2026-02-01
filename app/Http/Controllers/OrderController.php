<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Place order
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'Please login first');

        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) return redirect()->back()->with('error', 'Your cart is empty');

        DB::beginTransaction();

        try {
            $totalAmount = 0;

            foreach ($cartItems as $item) {
                if (!$item->product) return redirect()->back()->with('error', 'Product not found');
                if ($item->product->quantity < $item->quantity) {
                    return redirect()->back()->with('error', 'Not enough stock for ' . $item->product->name);
                }
                $totalAmount += $item->product->price * $item->quantity;
            }

            $order = Order::create([
                'customer_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'completed'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity,
                    'price' => $item->product->price
                ]);

                $item->product->decrement('quantity', $item->quantity);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Order failed. Please try again.');
        }
    }
}
