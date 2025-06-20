<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - SanurBoat</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-blue-100">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Verifikasi Email Anda
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Tiket Boat Sanur
                </p>
            </div>

            <!-- Main Card -->
            <div class="bg-white py-8 px-6 shadow-lg rounded-lg">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Warning Message -->
                @if (session('warning'))
                    <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ session('warning') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Content -->
                <div class="text-center">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            Cek Email Anda
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Kami telah mengirim link verifikasi ke:
                        </p>
                        <p class="font-semibold text-blue-600 mb-4 break-all">
                            {{ Auth::user()->email }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Klik link di email tersebut untuk mengaktifkan akun Anda.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-4">
                        <!-- Resend Email Button -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <!-- Navigation Links -->
                        <div class="flex items-center justify-center space-x-4 text-sm">
                            <a href="{{ route('wisatawan.dashboard') }}" class="text-blue-600 hover:text-blue-700 hover:underline transition-colors">
                                Ke Dashboard
                            </a>
                            <span class="text-gray-300">|</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-900 hover:underline transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
