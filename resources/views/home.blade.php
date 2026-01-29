@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <!-- Welcome -->
    <h1 class="text-2xl font-bold mb-4">
        Welcome, {{ $customer->name }} 👋
    </h1>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-500">Total Orders</h3>
            <p class="text-2xl font-semibold">{{ $totalOrders }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-500">Total Spent</h3>
            <p class="text-2xl font-semibold">₹ {{ number_format($totalSpent, 2) }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-500">Last Order</h3>
            <p class="text-2xl font-semibold">
                {{ $customerOrders->first()->created_at->format('d M Y') ?? '—' }}
            </p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>

        @if($customerOrders->count())
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Order #</th>
                        <th class="p-2 text-left">Items</th>
                        <th class="p-2 text-left">Total</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerOrders as $order)
                        <tr class="border-t">
                            <td class="p-2">#{{ $order->id }}</td>

                            <td class="p-2">
                                @foreach($order->items as $item)
                                    <div>
                                        {{ $item->product->name }} × {{ $item->quantity }}
                                    </div>
                                @endforeach
                            </td>

                            <td class="p-2">₹ {{ number_format($order->total_amount, 2) }}</td>

                            <td class="p-2">
                                <span class="px-2 py-1 rounded text-sm
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status == 'completed') bg-green-100 text-green-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="p-2">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">You have no orders yet.</p>
        @endif
    </div>

</div>
@endsection
