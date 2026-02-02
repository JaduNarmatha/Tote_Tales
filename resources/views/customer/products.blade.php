@extends('layouts.app') <!-- or your layout -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
<h1>Available Products</h1>

@if($products->count())
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card">
                <h3>{{ $product->name }}</h3>
                <p>Price: {{ $product->price }}</p>
                <p>Stock: {{ $product->quantity }}</p>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="150">
                @endif
                <form action="{{ route('products.addToCart', $product->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <p>No products available.</p>
@endif
@endsection
