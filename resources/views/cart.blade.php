{{-- resources/views/cart.blade.php --}}
@extends('layouts.app')

@section('title', 'Your Cart - Tote_Tales')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <p class="text-gray-600">Your cart is empty. 
            <a href="{{ route('category') }}" class="text-green-600 hover:underline">Continue shopping</a>.
        </p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white rounded shadow overflow-hidden">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-center">Price</th>
                        <th class="px-4 py-2 text-center">Quantity</th>
                        <th class="px-4 py-2 text-center">Subtotal</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($cartItems as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 flex items-center gap-4">
                            <span>{{ $item->product->name }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">LKR {{ number_format($item->product->price, 2) }}</td>
                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex justify-center items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border rounded">
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Update</button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center font-semibold">LKR {{ number_format($item->quantity * $item->product->price, 2) }}</td>
                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Remove this item?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="text-xl font-bold">Total: LKR {{ number_format($totalPrice, 2) }}</span>
            <a href="{{ route('checkout') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection
