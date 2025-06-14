<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log In - SanurBoat</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="/images/logo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Animasi slide background dari kiri ke kanan (login) */
        .bg-slide-left {
            animation: slideBackgroundLeft 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideBackgroundLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        /* Hover effect untuk navigasi */
        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(2px);
        }

        /* Toast Notification Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: linear-gradient(135deg, #28a745, #26ff4e);
        }

        .toast.error {
            background: linear-gradient(135deg, #e41b1b, #dc2626);
        }

        .toast.warning {
            background: linear-gradient(135deg, #f5d60b, #d97706);
        }

        /* Loading Button */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form validation styles */
        .input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* Success notification above form */
        .form-notification {
            position: absolute;
            top: -60px;
            left: 0;
            right: 0;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 500;
            text-center;
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .form-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .form-notification.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .form-notification.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        /* Google Button Styles */
        .google-btn {
            transition: all 0.2s ease;
            border: 1px solid #dadce0;
            background: white;
            text-decoration: none !important;
        }

        .google-btn:hover {
            box-shadow: 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
            border-color: #dadce0;
            text-decoration: none !important;
        }

        .google-btn:active {
            background-color: #f8f9fa;
        }

        /* Divider styles */
        .divider {
            position: relative;
            text-align: center;
            margin: 24px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #6b7280;
            font-size: 14px;
            position: relative;
            z-index: 2;
            display: inline-block;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="flex items-center">
            <div id="toast-icon" class="mr-3">
                <!-- Icon will be inserted here -->
            </div>
            <div>
                <div id="toast-title" class="font-semibold"></div>
                <div id="toast-message" class="text-sm opacity-90"></div>
            </div>
            <button onclick="hideToast()" class="ml-auto text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Mobile logo (only visible on mobile) -->
        <div class="flex lg:hidden items-center p-6 bg-blue-50">
            <img src="{{ asset('images/logo-trans.png') }}" alt="SanurFerryPass Logo" class="h-8 w-auto">
            <a href="/" class="ml-3 text-blue-500 font-bold text-xl tracking-tight">SanurBoat</a>
        </div>

        <!-- Left side - Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-12">
            <div class="w-full max-w-md relative">
                <!-- Form Notification -->
                <div id="form-notification" class="form-notification">
                    <span id="notification-message"></span>
                </div>

                <!-- User icon and title -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-12 h-12 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-center">Log In</h1>
                </div>

                <!-- Google Login Button - Moved to top -->
                <div class="mb-6">
                    <a href="{{ route('auth.google') }}" id="google-login-btn"
                        class="google-btn w-full py-3 px-4 rounded-md font-medium text-gray-700 flex items-center justify-center space-x-3 hover:shadow-md transition-all duration-200">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span>Continue with Google</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="divider">
                    <span>or</span>
                </div>

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-4">
                        <input type="email" name="email" id="email" placeholder="Email" required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 @error('email') input-error @enderror">
                        @error('email')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                        <div id="email-error" class="error-message"></div>
                    </div>

                    <div class="relative mb-4">
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 @error('password') input-error @enderror">

                        <button type="button" onclick="togglePasswordVisibility()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="w-5 h-5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        @error('password')
                            <div class="error-message show">{{ $message }}</div>
                        @enderror
                        <div id="password-error" class="error-message"></div>
                    </div>

                    <div class="flex items-center space-x-2 mb-6">
                        <input type="checkbox" id="remember" name="remember" class="text-blue-600 focus:ring-blue-500" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-sm text-gray-700">Remember me</label>
                    </div>

                    <div class="mb-4">
                        <button type="submit" id="login-btn"
                            class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200 flex items-center justify-center">
                            <span id="btn-text">Login</span>
                        </button>
                    </div>
                </form>

                <!-- Links -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline nav-link">Register</a>
                    </p>
                    <p class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline text-sm nav-link">Forgot password?</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Image dengan animasi slide -->
        <div class="hidden lg:block lg:w-1/2 relative bg-slide-left">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <img src="{{ asset('images/header-bg.jpg') }}" alt="Beach view" class="w-full h-full object-cover">

            <!-- Logo on image side - positioned at top left like on register page -->
            <div class="absolute top-10 left-10 z-30">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="SanurFerryPass Logo" class="h-9 w-auto">
                    <a href="/"
                        class="ml-3 text-blue-400 font-bold text-xl tracking-tight hover:text-white/80 transition-colors drop-shadow-md">SanurBoat</a>
                </div>
            </div>

            <!-- Text overlay - perfectly centered -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl max-w-md mx-auto">
                    <h2 class="text-4xl font-bold text-white mb-4">PRACTICAL<br>ACCESS TO<br>DREAM ISLANDS</h2>
                    <p class="text-white/80">
                        Our boat ticket booking system is specifically designed to meet the needs of boat operators and
                        travel businesses.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        // Toast notification functions
        function showToast(type, title, message) {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toast-icon');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');

            let icon = '';
            if (type === 'success') {
                icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            } else if (type === 'error') {
                icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            } else if (type === 'warning') {
                icon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>';
            }

            toastIcon.innerHTML = icon;
            toastTitle.textContent = title;
            toastMessage.textContent = message;

            toast.className = 'toast ' + type;
            setTimeout(function() {
                toast.classList.add('show');
            }, 100);

            setTimeout(function() {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('show');
        }

        // Form notification
        function showFormNotification(type, message) {
            const notification = document.getElementById('form-notification');
            const messageEl = document.getElementById('notification-message');

            messageEl.textContent = message;
            notification.className = 'form-notification ' + type;
            setTimeout(function() {
                notification.classList.add('show');
            }, 100);

            setTimeout(function() {
                notification.classList.remove('show');
            }, 4000);
        }

        // Handle Laravel session messages
        window.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showFormNotification('success', '{{ session('success') }}');
            @endif

            @if(session('error'))
                showFormNotification('error', '{{ session('error') }}');
            @endif

            @if($errors->any())
                showFormNotification('error', 'Terdapat kesalahan pada form. Silakan periksa kembali.');
            @endif
        });

        // Form submission handling
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('login-btn');
            const btnText = document.getElementById('btn-text');

            submitBtn.classList.add('btn-loading');
            btnText.textContent = 'Logging in...';
            submitBtn.disabled = true;
        });

        // Google login button click handling
        document.getElementById('google-login-btn').addEventListener('click', function(e) {
            this.style.opacity = '0.7';
            this.style.pointerEvents = 'none';

            const span = this.querySelector('span');
            span.textContent = 'Connecting to Google...';
        });
    </script>
</body>

</html>
