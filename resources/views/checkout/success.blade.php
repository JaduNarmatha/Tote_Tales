@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-12 text-center bg-white shadow rounded">
  <h1 class="text-3xl font-bold text-green-600 mb-4">
    Thank you for your purchase, {{ $order->name }}!
  </h1>

  <p>Order ID: <strong>#{{ $order->id }}</strong></p>
  <p>Phone: {{ $order->phone }}</p>
  <p>Address: {{ $order->address }}</p>

  <p class="mt-4 font-bold text-lg">
    Total Paid: LKR {{ number_format($order->total_amount,2) }}
  </p>

  <a href="{{ route('categories.index') }}"
     class="inline-block mt-6 bg-green-600 text-white px-6 py-2 rounded">
    Continue Shopping
  </a>
</div>

@endsection
