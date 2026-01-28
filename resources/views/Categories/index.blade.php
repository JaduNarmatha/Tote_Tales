@extends('layouts.app')

@section('content')

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>

    <div class="flex items-center space-x-4">
      <span class="hidden sm:inline">Hi, {{ Auth::user()->name }}</span>

      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
         class="text-red-500">Logout</a>

      <a href="{{ route('cart.index') }}" class="relative bg-orange-500 text-white px-4 py-1 rounded-full">
        🛒 Cart
        @if(session('cart'))
          <span class="absolute -top-2 -right-2 bg-red-500 text-xs px-2 rounded-full">
            {{ array_sum(session('cart')) }}
          </span>
        @endif
      </a>

      <a href="{{ route('wishlist.index') }}" class="relative bg-pink-500 text-white px-4 py-1 rounded-full">
        ❤️
        <span id="wishlist-count"
              class="absolute -top-2 -right-2 bg-white text-pink-500 text-xs px-2 rounded-full">
          {{ $wishlistCount }}
        </span>
      </a>
    </div>
  </div>
</header>

<!-- Flash Message -->
@if(session('success'))
  <div class="bg-green-100 text-green-700 text-center py-2">
    {{ session('success') }}
  </div>
@endif

<!-- Categories -->
<div class="max-w-7xl mx-auto px-6 py-10">

@foreach($categoriesWithProducts as $item)
  @if($item['products']->count())
    <section class="mb-12 category-section" id="category-{{ $item['category']->id }}">
      <h3 class="text-2xl font-bold text-green-700 mb-4">
        {{ $item['category']->name }} Collection
      </h3>

      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($item['products'] as $product)
          <div class="bg-white rounded-xl shadow p-6 text-center relative">

            <!-- Wishlist -->
            <button class="wishlist-btn absolute top-4 right-4 text-xl"
                    data-id="{{ $product->id }}">
              {{ $product->in_wishlist ? '❤️' : '🤍' }}
            </button>

            <!-- Low Stock -->
            @if($product->quantity <= 5)
              <span class="absolute top-4 left-4 bg-red-100 text-red-600 px-2 py-1 text-xs rounded">
                Low Stock
              </span>
            @endif

            <!-- Image -->
            @if($product->image)
              <img src="{{ asset('storage/'.$product->image) }}"
                   class="mx-auto h-40 mb-4 rounded">
            @else
              <div class="text-6xl mb-4">👜</div>
            @endif

            <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
            <p class="text-orange-600 font-bold mt-2">
              Rs. {{ number_format($product->price, 2) }}
            </p>

            <!-- Add to Cart -->
            <form method="POST" action="{{ route('cart.add') }}" class="mt-4 flex justify-center gap-2">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="number" name="quantity" value="1" min="1"
                     class="w-16 border rounded text-center">
              <button class="bg-green-600 text-white px-4 py-2 rounded">
                Add
              </button>
            </form>
          </div>
        @endforeach

      </div>
    </section>
  @endif
@endforeach

</div>

@endsection
