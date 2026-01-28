<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tote_Tales | Welcome</title>

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/output.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="min-h-screen font-sans relative bg-gradient-to-b from-green-50 to-orange-50">

    <!-- Main Container -->
    <div class="relative z-10 w-11/12 sm:w-96 mx-auto mt-12 bg-white/90 p-8 rounded-3xl shadow-2xl text-center">

        <!-- Welcome Message -->
        <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-yellow-400 to-pink-500 animate-gradient-x">
            Welcome to Tote_Tales
        </h2>

        <p class="text-lg sm:text-xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-purple-400 to-pink-500 animate-gradient-x mb-6">
            Carry Your Story
        </p>

        <!-- Logo -->
        <div class="mb-4">
            <img src="{{ asset('img/logo.png') }}" alt="Tote_Tales Logo" class="mx-auto w-20 h-20">
        </div>
    </div>

    <!-- Story Section -->
    <section class="relative z-10 mt-20 px-6 sm:px-20 text-center max-w-4xl mx-auto pb-20">
        <h2 class="text-2xl font-bold text-green-800 mb-6">Our Story</h2>

        <p class="text-gray-700 text-lg leading-relaxed mb-6">
            Tote_Tales was born with the dream of making the world more sustainable, one bag at a time.
            Each tote bag carries not just your essentials, but also a story of eco-conscious living.
            By choosing Tote_Tales, you’re not just buying a bag – you’re joining a movement. 🌱
        </p>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Eco Mission</h3>
                <p class="text-gray-600">
                    We are committed to reducing single-use plastics and promoting reusable, durable tote bags.
                </p>
            </div>

            <div class="bg-white/80 p-6 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Creativity</h3>
                <p class="text-gray-600">
                    Each design tells a story, reflecting culture, creativity, and a love for the planet.
                </p>
            </div>
        </div>
    </section>

    <!-- Buttons -->
    <div class="flex flex-col items-center gap-8 mt-12 p-6 bg-white/90 rounded-2xl shadow-2xl w-80 mx-auto">

        <a href="{{ route('login') }}"
           class="w-full text-center bg-green-600 text-white py-3 text-lg font-medium rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transition transform hover:-translate-y-1">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="w-full text-center bg-orange-500 text-white py-3 text-lg font-medium rounded-lg shadow-md hover:bg-orange-600 hover:shadow-lg transition transform hover:-translate-y-1">
            Register
        </a>

        <a href="{{ route('visitor') }}"
           class="w-full text-center border border-green-500 text-green-600 py-3 text-lg font-medium rounded-lg shadow-md hover:bg-green-50 hover:shadow-lg transition transform hover:-translate-y-1">
            View As Visitor
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
            <div>
                <h2 class="text-orange-500 font-bold text-lg mb-2">Tote_Tales</h2>
                <p>Carrying stories, caring for the planet. One tote at a time.</p>
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
            © {{ date('Y') }} Tote_Tales. All rights reserved. Made with ❤️
        </div>
    </footer>

</body>
</html>
