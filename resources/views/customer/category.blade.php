@foreach($products as $product)
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="product-card">
    <h3>{{ $product->name }}</h3>
    <p>Price: Rs. {{ number_format($product->price, 2) }}</p>

    <form method="POST" action="{{ route('cart.add', $product->id) }}">
        @csrf
        <input type="number" name="quantity" value="1" min="1" class="w-16 text-center border rounded">
        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Add to Cart
        </button>
    </form>
</div>
@endforeach
