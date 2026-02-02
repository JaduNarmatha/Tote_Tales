@vite(['resources/css/app.css', 'resources/js/app.js'])
<a href="{{ route('admin.products') }}" class="block group">
    <div class="bg-pink-100 text-center p-6 rounded-xl hover:scale-105 transition-transform duration-300 relative shadow-lg">
        
        <!-- Icon -->
        <div class="text-pink-600 text-4xl mb-2">
            <i class="fas fa-box"></i> <!-- Font Awesome icon -->
        </div>

        <!-- Product Count -->
        <p class="text-3xl font-bold text-pink-600">{{ $totalProducts ?? 0 }}</p>
        <p class="text-gray-700">Products</p>

        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-pink-200 opacity-0 group-hover:opacity-25 rounded-xl transition-opacity"></div>
    </div>
</a>
