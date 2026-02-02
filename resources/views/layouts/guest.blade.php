<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Tote Tales'))</title>
<!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-jQnXlP+dnSvMifbsIh6gQhX7qQ0Jjq8kgQzpLq4eFVlMPG/6ClFQH5h4+clM0qPnhPR5fW8pGtvwzocSU+J+Ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <!-- Navbar (minimal for guest pages) -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="font-bold text-xl">Tote Tales</a>
        <div class="flex gap-4">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mx-auto px-4 mt-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif
    </div>

    <!-- Main Guest Content -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded shadow">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
