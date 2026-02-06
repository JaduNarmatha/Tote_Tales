@extends('layouts.app')

@section('title','Add Product')

@section('content')
<body class="min-h-screen flex flex-col">

  <!-- Navbar -->
  <header class="bg-gradient-to-r from-orange-200 to-yellow-200 shadow-md fade-in">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
      <h1 class="text-2xl font-bold text-orange-600">Tote_Tales</h1>
      <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a>
        <a href="{{ route('about') }}" class="hover:text-orange-500 transition-colors">About</a>
        <a href="{{ route('category') }}" class="hover:text-orange-500 transition-colors">Collection</a>
        <a href="{{ route('contact') }}" class="hover:text-orange-500 transition-colors">Contact</a>
      </nav>
      <div class="flex items-center space-x-4">
        <a href="{{ route('logout') }}" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm hover:bg-orange-600 transition-colors">Logout</a>
      </div>
    </div>
  </header>

  <!-- Main Form Section -->
  <main class="flex-grow flex items-center justify-center fade-in-delay my-10">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
          class="overlay shadow-2xl rounded-3xl p-8 w-full max-w-md animate-fadeIn">
      @csrf
      <h1 class="text-3xl font-bold text-orange-600 mb-6 text-center">Add Product</h1>

      <input type="text" name="name" placeholder="Product Name" required 
             class="border border-gray-300 p-3 w-full mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 transition transform hover:scale-105">

      <select name="category_id" required 
              class="border border-gray-300 p-3 w-full mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 transition transform hover:scale-105">
        <option value="">Select Category</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>

      <input type="number" name="price" placeholder="Price" required 
             class="border border-gray-300 p-3 w-full mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 transition transform hover:scale-105">

      <input type="number" name="quantity" placeholder="Quantity" required 
             class="border border-gray-300 p-3 w-full mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 transition transform hover:scale-105">

      <input type="file" name="image" class="border border-gray-300 p-3 w-full mb-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 transition transform hover:scale-105">

      <button type="submit" class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-3 rounded-full w-full font-semibold hover:scale-105 transform transition duration-300 shadow-lg">
        Add Product
      </button>
    </form>
  </main>

  <!-- Back Button -->
  <div class="mt-8 max-w-7xl mx-auto px-6 slide-up-delay">
    <a href="{{ route('admin.dashboard') }}" 
       class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow transform hover:scale-105 transition duration-300">
      ⬅ Back to Dashboard
    </a>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 mt-12 fade-in">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
      <div>
        <h2 class="text-orange-500 font-bold text-lg mb-2">Tote_Tales</h2>
        <p>Carrying stories, caring for the planet. One tote at a time.</p>
      </div>
      <div>
        <h3 class="font-semibold text-white mb-2">Quick Links</h3>
        <ul class="space-y-1">
          <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a></li>
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
      © {{ date('Y') }} Tote_Tales. All rights reserved.
    </div>
  </footer>

</body>
@endsection
