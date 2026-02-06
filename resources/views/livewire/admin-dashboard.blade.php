@extends('layouts.admin') <!-- Use a layout if you have one -->

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Dashboard Stats -->
<section class="max-w-7xl mx-auto px-6 mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Admin Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Total Orders -->
      
            <div class="bg-green-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300 relative shadow-lg">
                
                <p class="text-gray-700">Total Orders</p>
                <div class="absolute inset-0 bg-green-200 opacity-0 group-hover:opacity-25 rounded-xl transition-opacity"></div>
            </div>
        </a>

        <!-- Total Revenue -->
        <div class="bg-orange-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300 relative shadow-lg">
                
                <p class="text-gray-700">Total Revenue</p>
                <div class="absolute inset-0 bg-orange-200 opacity-0 group-hover:opacity-25 rounded-xl transition-opacity"></div>
            </div>
        </a>

        <!-- Total Products -->
        <div class="bg-pink-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300 relative shadow-lg">
               <p class="text-gray-700">Products</p>
                <div class="absolute inset-0 bg-pink-200 opacity-0 group-hover:opacity-25 rounded-xl transition-opacity"></div>
            </div>
        </a>

        <!-- Total Customers -->
        <div class="bg-blue-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300 relative shadow-lg">
           <p class="text-gray-700">Customers</p>
                <div class="absolute inset-0 bg-blue-200 opacity-0 group-hover:opacity-25 rounded-xl transition-opacity"></div>
            </div>
        </a>
    </div>
</section>

<!-- Low Stock Alerts -->
<section class="max-w-7xl mx-auto px-6 mt-10">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Low Stock Alerts</h3>
    <ul class="space-y-2">
        @forelse($lowStock as $product)
            <li class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg">
                ⚠ {{ $product->name }} is low in stock ({{ $product->quantity }} left)
            </li>
        @empty
            <li class="text-gray-500">No low stock products.</li>
        @endforelse
    </ul>
</section>

<!-- Recent Orders -->
<section class="max-w-7xl mx-auto px-6 mt-10">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h3>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden shadow">
            <thead class="bg-orange-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Order ID</th>
                    <th class="px-6 py-3 text-left">Customer</th>
                    <th class="px-6 py-3 text-left">Amount</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($recentOrders as $order)
                    @php
                        $statusColor = $order->status == 'Completed' ? 'bg-green-100 text-green-600' : ($order->status == 'Processing' ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600');
                    @endphp
                    <tr>
                        <td class="px-6 py-4">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ $order->customer->name }}</td>
                        <td class="px-6 py-4">Rs.{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="{{ $statusColor }} px-3 py-1 rounded-full text-sm">{{ $order->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center">No recent orders.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<!-- Product Management -->
<section class="max-w-7xl mx-auto px-6 mt-10">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Product Management</h3>
        <a href="{{ route('admin.products') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-600">Manage Products</a>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Qty</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($products as $product)
                    <tr>
                        <td class="px-4 py-2">{{ $product->id }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name }}</td>
                        <td class="px-4 py-2">Rs.{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-2">{{ $product->quantity }}</td>
                        <td class="px-4 py-2">
                            @if($product->quantity <= 0)
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm">Out of Stock</span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm">In Stock</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this product?')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-2 text-center">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
