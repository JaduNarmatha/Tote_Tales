<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tote_Tales - Collection</title>

    {{-- Tailwind --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .fade-in-up { animation: fadeInUp 0.7s ease-in-out; }
        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(20px); }
            to { opacity:1; transform:translateY(0); }
        }
        .bounce-hover:hover { transform: translateY(-3px); transition: 0.2s; }
    </style>
</head>

<body class="bg-gray-50 font-sans">

<!-- ================= Navbar ================= -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm fade-in-up sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>

        <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <a href="{{ route('welcome') }}" class="hover:text-orange-600">Home</a>
            <a href="{{ route('about') }}" class="hover:text-orange-600">About</a>
<a href="{{ route('categories.index') }}" class="hover:text-orange-600">Collection</a>

            <a href="{{ route('contact') }}" class="hover:text-orange-600">Contact</a>
        </nav>

        <div class="flex items-center space-x-4">
            <span class="text-gray-700 font-medium hidden sm:inline">
                Hi, {{ Auth::user()->name }}
            </span>

            <a href="{{ route('logout') }}" class="text-red-500 hover:underline">Logout</a>

            {{-- Cart --}}
            <a href="{{ route('cart') }}"
               class="relative bg-orange-500 text-white px-4 py-1 rounded-full text-sm bounce-hover">
                🛒 Cart
            </a>

            {{-- Wishlist --}}
            <a href="#"
               class="relative bg-pink-500 text-white px-4 py-1 rounded-full text-sm bounce-hover">
                ❤️
                <span id="wishlist-count"
                      class="absolute -top-2 -right-2 bg-white text-pink-500 text-xs font-bold px-2 py-1 rounded-full">
                    {{ $wishlistCount ?? 0 }}
                </span>
            </a>
        </div>
    </div>
</header>

<!-- ================= Category Tabs ================= -->
<div class="bg-white shadow-md py-3 px-6 sticky top-[64px] z-40 fade-in-up">
    <div class="max-w-7xl mx-auto flex flex-wrap gap-3 justify-center">
        @foreach($categories as $cat)
            <button
                class="category-tab px-4 py-2 rounded-full text-sm font-medium
                       bg-orange-100 text-orange-700 hover:bg-orange-200 transition"
                data-category="{{ $cat->id }}">
                {{ $cat->name }}
            </button>
        @endforeach
    </div>
</div>

<!-- ================= Main Content ================= -->
<div class="max-w-7xl mx-auto px-6 py-10 fade-in-up">

    @foreach($categories as $category)
        @if($category->products->count())

        <section class="category-section mb-12" id="category-{{ $category->id }}">
            <h3 class="text-2xl font-bold text-green-700 mb-4">
                {{ $category->name }} Collection
            </h3>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($category->products as $product)

                <div class="bg-white rounded-xl shadow p-6 text-center relative hover:shadow-lg transition">

                    {{-- Wishlist --}}
                    <button
                        class="wishlist-btn absolute top-4 right-4 text-xl hover:scale-110 transition"
                        data-product-id="{{ $product->id }}">
                        {{ $product->in_wishlist ? '❤️' : '🤍' }}
                    </button>

                    {{-- Low Stock --}}
                    @if($product->quantity <= 5)
                        <span class="absolute top-4 left-4 bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-semibold">
                            Low Stock
                        </span>
                    @endif

                    {{-- Image --}}
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->name }}"
                             class="mx-auto h-40 mb-4 object-cover rounded">
                    @else
                        <div class="text-6xl mb-4">👜</div>
                    @endif

                    {{-- Info --}}
                    <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                    <p class="text-orange-600 font-bold mt-2 text-lg">
                        Rs. {{ number_format($product->price, 2) }}
                    </p>

                    {{-- Add to Cart --}}
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-4 flex justify-center gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1"
                               class="w-16 text-center border rounded">
                        <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
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

<!-- ================= Footer ================= -->
<footer class="bg-gray-900 text-gray-300 mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
        <div>
            <h2 class="text-orange-500 font-bold text-lg mb-2">Tote_Tales</h2>
            <p>Carrying stories, caring for the planet. One tote at a time.</p>
        </div>

        <div>
            <h3 class="font-semibold text-white mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="{{ route('welcome') }}" class="hover:text-orange-500">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-orange-500">About</a></li>
                <li><a href="{{ route('categories.index') }}" class="hover:text-orange-500">Collection</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-orange-500">Contact</a></li>
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
        © {{ date('Y') }} Tote_Tales. All rights reserved.
    </div>
</footer>

<!-- ================= Scripts ================= -->
<script>
document.querySelectorAll('.category-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        const id = tab.dataset.category;
        document.querySelectorAll('.category-section').forEach(sec => {
            sec.style.display = (sec.id === 'category-' + id) ? 'block' : 'none';
        });
    });
});
</script>

</body>
</html>
