@extends('layouts.app')

@section('title','Products')

@section('content')
<h1>All Products</h1>

@if($products->count())
    <ul>
        @foreach($products as $product)
            <li>
                <strong>{{ $product->name }}</strong> - ${{ $product->price }} 
                | Quantity: {{ $product->quantity }}
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="50">
                @endif
            </li>
        @endforeach
    </ul>
@else
    <p>No products available.</p>
@endif

<h2>Low Stock Products (≤ 5)</h2>
@if($lowStock->count())
    <ul>
        @foreach($lowStock as $product)
            <li>{{ $product->name }} - Quantity: {{ $product->quantity }}</li>
        @endforeach
    </ul>
@else
    <p>No low stock products.</p>
@endif
@endsection
