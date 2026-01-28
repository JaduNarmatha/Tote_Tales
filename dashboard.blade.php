{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Tote_Tales Admin Dashboard')

@section('content')
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>
    <nav class="flex space-x-6 text-gray-700 font-medium">
      <a href="{{ route('admin.dashboard') }}">Admin Page</a>
      <a href="{{ route('about') }}">About</a>
      <a href="{{ route('category') }}">Collection</a>
      <a href="{{ route('contact') }}">Contact</a>
    </nav>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700">Hello Admin, {{ Auth::user()->name ?? 'Admin' }}</span>
      <a href="{{ route('logout') }}" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm hover:bg-orange-600">Logout</a>
    </div>
  </div>
</header>

<!-- Dashboard Stats -->
<section class="max-w-7xl mx-auto px-6 mt-8 fade-in">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Admin Dashboard</h2>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <a href="{{ route('admin.orders') }}" class="block">
      <div class="bg-green-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300">
        <p class="text-3xl font-bold text-green-700">{{ $totalOrders }}</p>
        <p class="text-gray-700">Total Orders</p>
      </div>
    </a>
    <a href="{{ route('admin.revenue') }}" class="block">
      <div class="bg-orange-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300">
        <p class="text-3xl font-bold text-orange-600">Rs. {{ number_format($totalRevenue,2) }}</p>
        <p class="text-gray-700">Total Revenue</p>
      </div>
    </a>
    <a href="{{ route('admin.products') }}" class="block">
      <div class="bg-pink-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300">
        <p class="text-3xl font-bold text-pink-600">{{ $totalProducts }}</p>
        <p class="text-gray-700">Products</p>
      </div>
    </a>
    <a href="{{ route('admin.customers') }}" class="block">
      <div class="bg-green-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300">
        <p class="text-3xl font-bold text-green-700">{{ $totalCustomers }}</p>
        <p class="text-gray-700">Customers</p>
      </div>
    </a>
  </div>
</section>

<!-- Low Stock Alerts -->
<section class="max-w-7xl mx-auto px-6 mt-10 fade-in">
  <h3 class="text-xl font-semibold text-gray-800 mb-4">Low Stock Alerts</h3>
  <ul class="space-y-2">
    @if(count($lowStock) > 0)
      @foreach($lowStock as $ls)
        <li class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg">
          ⚠ {{ $ls->name }} is low in stock ({{ $ls->quantity }} left)
        </li>
      @endforeach
    @else
      <li class="text-gray-500">No low stock products.</li>
    @endif
  </ul>
</section>

<!-- Recent Orders -->
<section class="max-w-7xl mx-auto px-6 mt-10 slide-up">
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
        @forelse($recentOrders as $o)
          <tr>
            <td class="px-6 py-4">#{{ $o->id }}</td>
            <td class="px-6 py-4">{{ $o->customer_name }}</td>
            <td class="px-6 py-4">Rs. {{ number_format($o->total_amount,2) }}</td>
            <td class="px-6 py-4">
              @php
                $color = $o->status == 'Completed' ? 'bg-green-100 text-green-600' : ($o->status=='Processing' ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600');
              @endphp
              <span class="{{ $color }} px-3 py-1 rounded-full text-sm">{{ $o->status }}</span>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-center">No recent orders.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

<!-- Product Management -->
<section class="max-w-7xl mx-auto px-6 mt-10 fade-in">
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
        @forelse($products as $p)
          <tr>
            <td class="px-4 py-2">{{ $p->id }}</td>
            <td class="px-4 py-2">{{ $p->name }}</td>
            <td class="px-4 py-2">{{ $p->category_name }}</td>
            <td class="px-4 py-2">Rs.{{ number_format($p->price,2) }}</td>
            <td class="px-4 py-2">{{ $p->quantity }}</td>
            <td class="px-4 py-2">
              @if($p->quantity <= 0)
                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm">Out of Stock</span>
              @else
                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm">In Stock</span>
              @endif
            </td>
            <td class="px-4 py-2 space-x-2">
              <a href="{{ route('admin.products.edit', $p->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</a>
              <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="inline">
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
