<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Tote_Tales</title>
 {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/output.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-green-50 via-white to-yellow-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white/90 p-8 rounded-3xl shadow-2xl w-96 backdrop-blur-md border border-gray-100">

        <!-- Logo and Welcome -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('img/logo.png') }}" alt="Tote_Tales Logo" class="w-16 h-16 mb-3">
            <h1 class="text-3xl font-extrabold text-green-700">Tote_Tales</h1>
            <p class="text-gray-600 text-sm mt-2">
                Welcome back! Please log in to continue.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <p class="text-green-500 text-center mb-4">
                {{ session('success') }}
            </p>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <p class="text-red-500 text-center mb-4">
                {{ session('error') }}
            </p>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="text-red-500 text-center mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none transition">

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none transition">

            <button
                type="submit"
                class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <!-- Links -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <a href="{{ route('register') }}" class="text-green-700 font-medium hover:underline">
                Create Account
            </a>
            •
            <a href="{{ route('password.request') }}" class="text-green-700 font-medium hover:underline">
                Forgot Password?
            </a>
        </div>

    </div>

</body>
</html>
