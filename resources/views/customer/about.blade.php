{{-- resources/views/customer/about.blade.php --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('layouts.app') {{-- Optional: if you have a layout --}}

@section('title', 'Tote_Tales | Our Story')

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-white text-gray-800 font-sans overflow-x-hidden">

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-100 shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-xl font-bold text-orange-600">Tote_Tales</h1>
    <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
      <a href="{{ route('welcome') }}" class="hover:text-orange-600 transition-colors">Home</a>
      <a href="{{ route('about') }}" class="hover:text-orange-600 transition-colors">About</a>
      <a href="{{ route('category') }}" class="hover:text-orange-600 transition-colors">Collection</a>
      <a href="{{ route('contact') }}" class="hover:text-orange-600 transition-colors">Contact</a>
    </nav>
    <div class="flex items-center space-x-4">
      @auth
      <a href="{{ route('logout') }}" class="text-red-500 hover:underline">Logout</a>
      <a href="{{ route('cart') }}" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm">Cart 👜</a>
      @else
      <a href="{{ route('customer.login') }}" class="text-green-600 font-semibold">Login</a>
      @endauth
    </div>
  </div>
</header>

<!-- Hero Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold mb-8 hero-heading">Our Story</h2>
    <p class="max-w-3xl mx-auto text-gray-700 leading-relaxed story-text mb-4">
      Born from a passion for sustainable fashion and artistic expression, Tote_Tales creates more than just bags – we craft stories you can carry.
    </p>
    <p class="max-w-3xl mx-auto text-gray-700 leading-relaxed story-text mb-4">
      Each tote bag is lovingly hand-designed by local artists and crafted from eco-friendly materials. Every bag reflects personality while making a positive impact on our planet.
    </p>
    <p class="max-w-3xl mx-auto text-gray-700 leading-relaxed story-text mb-8">
      From sketches in a small studio to a vibrant collection loved by thousands, our totes travel with stories waiting to unfold.
    </p>

    <!-- Eco Mission Boxes -->
    <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full text-center">
      <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition duration-500 eco-box">
        <img src="https://cdn-icons-png.flaticon.com/512/728/728093.png" alt="Leaf Icon" class="w-12 mx-auto mb-3">
        <h3 class="text-green-600 font-bold text-lg mb-2">Eco-Friendly Mission</h3>
        <p class="text-gray-600 text-sm">
          Sustainable materials, ethical production, and a commitment to reducing environmental impact with every bag we create.
        </p>
      </div>
      <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition duration-500 eco-box">
        <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Recycle Icon" class="w-12 mx-auto mb-3">
        <h3 class="text-green-600 font-bold text-lg mb-2">Recycling Commitment</h3>
        <p class="text-gray-600 text-sm">
          We prioritize recycling and upcycling to minimize waste and make every tote count.
        </p>
      </div>
      <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition duration-500 eco-box">
        <img src="https://cdn-icons-png.flaticon.com/512/2913/2913469.png" alt="Community Icon" class="w-12 mx-auto mb-3">
        <h3 class="text-green-600 font-bold text-lg mb-2">Community Impact</h3>
        <p class="text-gray-600 text-sm">
          Supporting local artists and communities ensures every purchase has a positive social and environmental effect.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-16 fade-in-up">
 <div class="grid md:grid-cols-2 gap-8 items-center">
    <p class="text-gray-600 leading-relaxed">
      Tote_Tales was born from a passion for sustainable fashion and creative expression. Each tote bag is meticulously handmade by skilled artisans using eco-friendly materials, blending style, durability, and functionality. Our designs are not just accessories—they are stories you carry, reflecting individuality and conscious living. We believe fashion can be beautiful without harming the planet, and every purchase supports ethical craftsmanship and sustainable practices. From everyday comfort to elegant charm, our collections are crafted to inspire confidence and creativity. Join us on this journey toward mindful living, where each tote carries your story and helps protect our planet.
    </p>
    <div class="flex justify-center">
      <img src="{{ asset('img/1.jpg') }}" alt="Our Story" class="rounded-2xl shadow-lg w-full max-w-md hover:scale-105 transition-transform duration-300">
    </div>
  </div>
</section>

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

<!-- GSAP Animations -->
<script>
  gsap.registerPlugin(ScrollTrigger);

  gsap.from(".hero-heading", {
    y: -60,
    opacity: 0,
    duration: 1.2,
    ease: "power3.out"
  });

  gsap.from(".story-text", {
    y: 40,
    opacity: 0,
    duration: 1,
    ease: "power2.out",
    stagger: 0.4,
    scrollTrigger: {
      trigger: ".story-text",
      start: "top 80%"
    }
  });
</script>
</body>
@endsection
