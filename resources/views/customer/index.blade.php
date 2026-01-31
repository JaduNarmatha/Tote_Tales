{{-- resources/views/customer/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tote_Tales - Carry Your Story')

@section('content')
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm fade-in-up">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>
    <nav class="flex space-x-6 text-gray-700 font-medium">
      <a href="{{ route('welcome') }}" class="hover:text-orange-600 transition-colors">Home</a>
      <a href="{{ route('about') }}" class="hover:text-orange-600 transition-colors">About</a>
 <a href="{{ route('categories.index') }}" class="hover:text-orange-500">Collection</a>


 <a href="{{ route('contact') }}" class="hover:text-orange-600 transition-colors">Contact</a>
    </nav>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">Hi, {{ Auth::user()->name ?? 'Guest' }}</span>
      @auth
      <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-red-500 hover:underline">Logout</button>
      </form>
      <a href="{{ route('cart') }}" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm bounce-hover">Cart 👜</a>
      @else
      <a href="{{ route('login') }}" class="text-green-600 font-semibold">Login</a>
      @endauth
    </div>
  </div>
</header>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-50 to-yellow-50 py-16 fade-in-up">
  <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center px-6 gap-10">
    <div>
      <h2 class="text-4xl font-extrabold text-orange-600 mb-4">Carry Your Story</h2>
      <p class="text-gray-700 mb-6">Discover our collection of beautifully handcrafted, eco-friendly tote bags. Each bag tells a story and helps protect our planet, one carry at a time.</p>
      <div class="flex space-x-4">
        <a href="{{ route('about') }}" class="border border-green-600 text-green-600 px-6 py-3 rounded-lg hover:bg-green-100 scale-hover">Learn More</a>
      </div>
    </div>
    <div class="flex justify-center">
      <div class="bg-white rounded-2xl shadow-lg p-6 scale-hover">
        <img src="{{ asset('img/logo.png') }}" alt="Tote Bag" class="w-40 mx-auto">
        <p class="text-center mt-3 font-medium text-gray-700">Carry Your Story</p>
      </div>
    </div>
  </div>
</section>

<!-- Customer Stats -->
@if(Auth::check())
<section class="max-w-7xl mx-auto px-6 py-10 fade-in-up delay-200">
  <h3 class="text-2xl font-bold text-gray-800 text-center mb-10">Your Profile</h3>
  <div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-xl shadow text-center scale-hover">
      <h4 class="text-xl font-semibold text-gray-700">Total Orders</h4>
      <p class="text-3xl font-bold text-green-600">{{ $totalOrders ?? 0 }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow text-center scale-hover">
      <h4 class="text-xl font-semibold text-gray-700">Total Spent</h4>
      <p class="text-3xl font-bold text-orange-600">LKR {{ number_format($totalSpent ?? 0, 2) }}</p>
    </div>
  </div>
</section>

<!-- Recent Orders -->
<section class="max-w-7xl mx-auto px-6 py-10 fade-in-up delay-400">
  <h3 class="text-2xl font-bold text-gray-800 text-center mb-6">Recent Orders</h3>
  <div class="overflow-x-auto">
    <table class="w-full border-collapse rounded-lg overflow-hidden shadow">
      <thead class="bg-orange-500 text-white">
        <tr>
          <th class="px-6 py-3 text-left">Order ID</th>
          <th class="px-6 py-3 text-left">Products</th>
          <th class="px-6 py-3 text-left">Amount</th>
          <th class="px-6 py-3 text-left">Status</th>
          <th class="px-6 py-3 text-left">Date</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y">
        @forelse($customerOrders ?? [] as $o)
        <tr>
          <td class="px-6 py-4">#{{ $o->id }}</td>
          <td class="px-6 py-4">{{ implode(', ', $o->items->pluck('product.name')->toArray()) }}</td>
          <td class="px-6 py-4">LKR {{ number_format($o->total_amount,2) }}</td>
          <td class="px-6 py-4">
            @php
              $statusColor = $o->status=='Completed' ? 'bg-green-100 text-green-600' : ($o->status=='Processing' ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600');
            @endphp
            <span class="{{ $statusColor }} px-3 py-1 rounded-full text-sm">{{ $o->status }}</span>
          </td>
          <td class="px-6 py-4">{{ $o->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-6 py-4 text-center">No orders found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
@endif

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 mt-12 fade-in-up delay-600">
  <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
    <div>
      <h2 class="text-orange-500 font-bold text-lg mb-2">Tote_Tales</h2>
      <p>Carrying stories, caring for the planet. One tote at a time.</p>
    </div>
    <div>
      <h3 class="font-semibold text-white mb-2">Quick Links</h3>
      <ul class="space-y-1">
        <li><a href="{{ route('welcome') }}" class="hover:text-orange-500 transition-colors">Home</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-orange-500 transition-colors">About Us</a></li>
        <li><a href="{{ route('categories.index') }}" class="hover:text
