<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Tote_Tales</title>

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/output.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">

        <h2 class="text-2xl font-bold mb-6 text-center text-green-700">
            Reset Password
        </h2>

        {{-- Error Message --}}
        @if (session('error'))
            <p class="text-red-500 mb-4 text-center">
                {{ session('error') }}
            </p>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="text-red-500 mb-4 text-center">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Reset Password Form --}}
        <form action="{{ route('password.update.custom') }}" method="POST" class="space-y-4">
            @csrf

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Your Email"
                required
                class="w-full p-3 border rounded-lg">

            <input
                type="password"
                name="password"
                placeholder="New Password"
                required
                class="w-full p-3 border rounded-lg">

            <button
                type="submit"
                class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">
                Update Password
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-green-700 hover:underline">
                Back to Login
            </a>
        </div>

    </div>

</body>
</html>
