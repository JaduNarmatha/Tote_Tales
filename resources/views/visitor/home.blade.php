{{-- resources/views/visitor/home.blade.php --}}
@extends('layouts.app') {{-- Optional if you have a master layout --}}

@section('title', 'Welcome to Tote_Tales')

@section('content')
<body class="bg-gradient-to-r from-yellow-50 to-green-50 font-sans">

<!-- Navbar -->
<header class="bg-gradient-to-r from-orange-100 to-yellow-200 shadow-md fade-in-up">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-2xl font-extrabold text-orange-600 tracking-wide">Tote_Tales</h1>
    <nav class="flex space-x-6 text-gray-700 font-medium">
      <a href="{{ route('visitor.home') }}" class="hover:text-orange-600 transition-colors">Home</a>
      <a href="{{ route('category') }}" class="hover:text-orange-600 transition-colors">Collection</a>
      <a href="{{ route('contact') }}" class="hover:text-orange-600 transition-colors">Contact</a>
    </nav>
    <div class="flex items-center space-x-4">
      <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-colors">Create Account</a>
      <a href="{{ route('login') }}" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition-colors">Login</a>
    </div>
  </div>
</header>

<!-- Hero Section -->
<section class="py-20 fade-in-up">
  <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center px-6 gap-10">
    <div>
      <h2 class="text-5xl font-extrabold text-orange-600 mb-6">Welcome, {{ Auth::user()->name ?? 'USER' }}!</h2>
      <p class="text-gray-700 mb-6 text-lg">Discover our handcrafted eco-friendly tote bags. Each bag carries a story — make it yours today!</p>
      <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 scale-hover text-lg font-semibold">Create Your Account</a>
    </div>
  </div>
</section>

<!-- Our Story Section -->
<section class="max-w-7xl mx-auto px-6 py-16 fade-in-up">
  <h3 class="text-3xl font-bold text-gray-800 text-center mb-10">Our Story</h3>
  <div class="grid md:grid-cols-2 gap-8 items-center">
    <p class="text-gray-600 leading-relaxed">
      Tote_Tales was born from a passion for sustainable fashion and creative expression. Each tote bag is meticulously handmade by skilled artisans using eco-friendly materials, blending style, durability, and functionality. Our designs are not just accessories—they are stories you carry, reflecting individuality and conscious living. We believe fashion can be beautiful without harming the planet, and every purchase supports ethical craftsmanship and sustainable practices. From everyday comfort to elegant charm, our collections are crafted to inspire confidence and creativity. Join us on this journey toward mindful living, where each tote carries your story and helps protect our planet.
    </p>
    <div class="flex justify-center">
      <img src="{{ asset('img/1.jpg') }}" alt="Our Story" class="rounded-2xl shadow-lg w-full max-w-md hover:scale-105 transition-transform duration-300">
    </div>
  </div>
</section>

<!-- Flash Sale Section -->
<section class="max-w-7xl mx-auto px-6 py-16 bg-gradient-to-r from-yellow-50 via-orange-50 to-pink-50 rounded-3xl shadow-lg fade-in-up">
  <div class="grid md:grid-cols-3 items-center gap-6">
    <div class="flex justify-center md:justify-start">
      <img src="{{ asset('img/12.jpg') }}" alt="Flash Bag 1" class="w-32 h-32 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
    </div>
    <div class="flex flex-col justify-center text-center space-y-6">
      <h3 class="text-4xl font-extrabold text-orange-600">Flash Sale!</h3>
      <p class="text-gray-700 text-lg">Get 25% off - Limited Time Offer!</p>
      <div id="flashCountdown" class="flex justify-center space-x-4 text-center text-gray-800 font-semibold text-lg">
        <div>
          <div id="days" class="text-3xl font-bold">00</div>
          <span>Days</span>
        </div>
        <div>
          <div id="hours" class="text-3xl font-bold">00</div>
          <span>Hours</span>
        </div>
        <div>
          <div id="minutes" class="text-3xl font-bold">00</div>
          <span>Minutes</span>
        </div>
        <div>
          <div id="seconds" class="text-3xl font-bold">00</div>
          <span>Seconds</span>
        </div>
      </div>
      <a href="{{ route('category') }}" class="bg-green-600 text-white px-8 py-3 rounded-full shadow-lg hover:bg-green-700 hover:scale-105 transition transform text-lg font-semibold mt-4 inline-block">
        Shop Now
      </a>
    </div>
    <div class="flex justify-center md:justify-end">
      <img src="{{ asset('img/9.jpg') }}" alt="Flash Bag 2" class="w-32 h-32 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
    </div>
  </div>
</section>

<!-- Countdown Script -->
<script>
  const countDownDate = new Date();
  countDownDate.setDate(countDownDate.getDate() + 5);

  const countdown = setInterval(function() {
    const now = new Date().getTime();
    const distance = countDownDate - now;
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerText = String(days).padStart(2,'0');
    document.getElementById("hours").innerText = String(hours).padStart(2,'0');
    document.getElementById("minutes").innerText = String(minutes).padStart(2,'0');
    document.getElementById("seconds").innerText = String(seconds).padStart(2,'0');

    if(distance < 0){
      clearInterval(countdown);
      document.getElementById("flashCountdown").innerHTML = "<span class='text-red-600 font-bold'>Sale Ended</span>";
    }
  }, 1000);
</script>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 mt-12 fade-in-up">
  <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
    <div>
      <h2 class="text-orange-500 font-bold text-lg mb-2">Tote_Tales</h2>
      <p>Carrying stories, caring for the planet. One tote at a time.</p>
    </div>
    <div>
      <h3 class="font-semibold text-white mb-2">Quick Links</h3>
      <ul class="space-y-1">
        <li><a href="{{ route('visitor.home') }}" class="hover:text-orange-500 transition-colors">Home</a></li>
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
@endsection
