@if($product->quantity > 0)
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button class="btn btn-primary">
            Add to Cart
        </button>
    </form>
@else
    <button class="btn btn-secondary" disabled>
        Out of Stock
    </button>
@endif
