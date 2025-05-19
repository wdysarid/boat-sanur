<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Mobile logo (only visible on mobile) -->
        <div class="flex md:hidden items-center p-6 bg-blue-50">
            <img src="{{ asset('images/logo.png') }}" alt="SanurFerryPass Logo" class="h-8 w-auto">
            <a href="/" class="ml-3 text-blue-500 font-bold text-xl tracking-tight">SanurFerryPass</a>
        </div>

        <!-- Left side - Image (hidden on mobile) -->
        <div class="hidden md:block md:w-1/2 relative">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <img src="{{ asset('images/header-bg.jpg') }}"
                 alt="Beach view" class="w-full h-full object-cover">

            <!-- Logo - positioned at top left with proper z-index -->
            <div class="absolute top-10 left-10 z-30">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="SanurFerryPass Logo" class="h-9 w-auto">
                    <a href="/" class="ml-3 text-blue-400 font-bold text-xl tracking-tight hover:text-white/80 transition-colors drop-shadow-md">SanurFerryPass</a>
                </div>
            </div>

            <!-- Text overlay with card styling - perfectly centered -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl max-w-md mx-auto">
                    <h2 class="text-4xl font-bold text-white mb-4">PRACTICAL<br>ACCESS TO<br>DREAM ISLANDS</h2>
                    <p class="text-white/80">
                        Our boat ticket booking system is specifically designed to meet the needs of boat operators and travel businesses.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Form (full width on mobile) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-6 md:p-12">
            <div class="w-full max-w-md px-4">
                <!-- User icon and title -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-12 h-12 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-center">Register</h1>
                </div>

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <input type="text" name="name" id="name" placeholder="Nama" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Links -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html>
