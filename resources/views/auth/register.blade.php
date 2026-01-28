<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Tote_Tales</title>

     {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/output.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 flex items-center justify-center min-h-screen">

    <div class="bg-white bg-opacity-90 p-10 rounded-3xl shadow-2xl w-96 transform hover:scale-105 transition duration-500">

        <h2 class="text-3xl font-extrabold mb-6 text-center text-green-600">
            Tote_Tales Register
        </h2>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="mb-4 text-center">
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 font-semibold">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Registration Form --}}
        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Full Name"
                required
                class="w-full p-3 border-2 border-pink-400 rounded-xl focus:border-pink-600 focus:ring-2 focus:ring-pink-300 transition duration-300">

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                placeholder="Phone"
                required
                class="w-full p-3 border-2 border-purple-400 rounded-xl focus:border-purple-600 focus:ring-2 focus:ring-purple-300 transition duration-300">

            <input
                type="text"
                name="address"
                value="{{ old('address') }}"
                placeholder="Address"
                required
                class="w-full p-3 border-2 border-yellow-400 rounded-xl focus:border-yellow-600 focus:ring-2 focus:ring-yellow-300 transition duration-300">

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                class="w-full p-3 border-2 border-blue-400 rounded-xl focus:border-blue-600 focus:ring-2 focus:ring-blue-300 transition duration-300">

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full p-3 border-2 border-green-400 rounded-xl focus:border-green-600 focus:ring-2 focus:ring-green-300 transition duration-300">

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 text-white p-3 rounded-xl font-bold hover:from-green-400 hover:to-yellow-400 transition transform hover:scale-105">
                Register
            </button>
        </form>

        <div class="mt-5 text-center text-green-700 font-medium">
            <a href="{{ route('login') }}"
               class="text-purple-700 hover:text-pink-600 hover:underline transition">
                Already have an account? Login
            </a>
        </div>

    </div>

</body>
</html>
