{{-- resources/views/customer/wishlist.blade.php --}}
@extends('layouts.app') {{-- Optional: if you have a layout --}}

@section('title', 'My Wishlist - Tote_Tales')

@section('content')
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm fade-in-up">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>
    <nav class="flex space-x-6 text-gray-700 font-medium">
      <a href="{{ route('welcome') }}" class="hover:text-orange-600 transition-colors">Home</a>
      <a href="{{ route('about') }}" class="hover:text-orange-600 transition-colors">About</a>
      <a href="{{ route('category') }}" class="hover:text-orange-600 transition-colors">Collection</a>
      <a href="{{ route('contact') }}" class="hover:text-orange-600 transition-colors">Contact</a>
    </nav>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">Hi, {{ Auth::user()->name ?? 'Guest' }}</span>
      @auth
      <a href="{{ route('logout') }}" class="text-red-500 hover:underline">Logout</a>
      <a href="{{ route('cart') }}" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm bounce-hover">Cart 👜</a>
      @else
      <a href="{{ route('customer.login') }}" class="text-green-600 font-semibold">Login</a>
      @endauth
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">My Wishlist</h2>

    @if($items->isEmpty())
        <p class="text-gray-500 text-center">Your wishlist is empty.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($items as $product)
                <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center hover:shadow-xl transition duration-300">
                    <!-- Product Image -->
                    <img src="{{ asset('uploads/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="h-40 object-contain mb-4 rounded-lg">

                    <!-- Product Info -->
                    <h3 class="text-lg font-semibold text-gray-800 text-center">{{ $product->name }}</h3>
                    <p class="text-orange-600 font-bold mb-4">LKR {{ number_format($product->price, 2) }}</p>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <!-- Add to Cart Form -->
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                Add 
                            </button>
                        </form>

                        <form method="POST" action="{{ route('wishlist.remove', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                               Remove
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

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
        <li><a href="{{ route('category') }}" class="hover:text-orange-500 transition-colors">Our Collection</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-orange-500 transition-colors">Contact</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-semibold text-white mb-2">Our Promise</h3>
      <ul class="space-y-1">
        <li>✔ Eco-friendly materials</li>
        <li>✔ Ethical production</li>
        <li>✔ Handcrafted quality</li>
        <li>✔ Unique designs</li>
      </ul>
    </div>
  </div>
  <div class="text-center border-t border-gray-700 py-4 text-sm">
    © {{ date('Y') }} Tote_Tales. All rights reserved. Made with ❤️.
  </div>
</footer>
</body>
@endsection
