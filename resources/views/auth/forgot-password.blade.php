<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
        <!-- logo -->
    <link rel="icon" type="image/png" href="/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Animasi slide background dari atas ke bawah (forgot password) */
        .bg-slide-down {
            animation: slideBackgroundDown 0.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideBackgroundDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        /* Hover effect untuk navigasi */
        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(-2px);
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Mobile logo (only visible on mobile) -->
        <div class="flex lg:hidden items-center p-6 bg-blue-50">
            <img src="{{ asset('images/logo.png') }}" alt="SanurFerryPass Logo" class="h-8 w-auto">
            <a href="/" class="ml-3 text-blue-500 font-bold text-xl tracking-tight">SanurBoat</a>
        </div>

        <!-- Left side - Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-12">
            <div class="w-full max-w-md">
                <!-- Title -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-12 h-12 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                            <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
                            <polyline points="3 7 12 13 21 7"></polyline>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-center">Forgot Password</h1>
                    <p class="mt-2 text-gray-600 text-center">Enter your email address and we'll send you a link to reset your password.</p>
                </div>

                <!-- Form -->
                <form action="" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <!-- Links -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Remember your password?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline nav-link">Back to login</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Image dengan animasi slide -->
        <div class="hidden lg:block lg:w-1/2 relative bg-slide-down">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <img src="{{ asset('images/header-bg.jpg') }}"
                 alt="Beach view" class="w-full h-full object-cover">

            <!-- Logo on image side - positioned at top left like on register page -->
            <div class="absolute top-10 left-10 z-30">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="SanurFerryPass Logo" class="h-9 w-auto">
                    <a href="/" class="ml-3 text-blue-400 font-bold text-xl tracking-tight hover:text-white/80 transition-colors drop-shadow-md">SanurFerryPass</a>
                </div>
            </div>

            <!-- Text overlay - perfectly centered -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl max-w-md mx-auto">
                    <h2 class="text-4xl font-bold text-white mb-4">PRACTICAL<br>ACCESS TO<br>DREAM ISLANDS</h2>
                    <p class="text-white/80">
                        Our boat ticket booking system is specifically designed to meet the needs of boat operators and travel businesses.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
