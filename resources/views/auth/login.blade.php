<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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

                <!-- Login Form -->
                <form id="loginForm" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                        <div id="email-error" class="error-message"></div>
                    </div>

                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">

                        <button type="button" onclick="togglePasswordVisibility()"
                            class="absolute right-3 top-1/2 transform -translate-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="w-5 h-5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        <div id="password-error" class="error-message"></div>
                    </div>

                    <div class="flex items-center space-x-2 mb-4">
                        <input type="checkbox" id="remember" name="remember" class="text-blue-600 focus:ring-blue-500">
                        <label for="remember" class="text-sm text-gray-700">Remember me</label>
                    </div>

                    <div>
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
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline text-sm nav-link">Forgot
                            password?</a>
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
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }

        // Toast notification functions
        function showToast(type, title, message) {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toast-icon');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');

            // Set icon based on type
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

            toast.className = `toast ${type}`;
            setTimeout(() => toast.classList.add('show'), 100);

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('show');
        }

        // Form notification (above form)
        function showFormNotification(type, message) {
            const notification = document.getElementById('form-notification');
            const messageEl = document.getElementById('notification-message');

            messageEl.textContent = message;
            notification.className = `form-notification ${type}`;
            setTimeout(() => notification.classList.add('show'), 100);

            // Auto hide after 4 seconds
            setTimeout(() => {
                notification.classList.remove('show');
            }, 4000);
        }

        // Form validation
        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            const inputElements = document.querySelectorAll('input[type="email"], input[type="password"]');

            errorElements.forEach(el => {
                el.classList.remove('show');
                el.textContent = '';
            });

            inputElements.forEach(el => {
                el.classList.remove('input-error');
            });
        }

        function showFieldError(fieldName, message) {
            const input = document.getElementById(fieldName);
            const errorDiv = document.getElementById(fieldName + '-error');

            if (input && errorDiv) {
                input.classList.add('input-error');
                errorDiv.textContent = message;
                errorDiv.classList.add('show');
            }
        }

        // Loading state
        function setLoading(isLoading) {
            const btn = document.getElementById('login-btn');
            const btnText = document.getElementById('btn-text');

            if (isLoading) {
                btn.classList.add('btn-loading');
                btn.disabled = true;
                btnText.textContent = 'Processing...';
            } else {
                btn.classList.remove('btn-loading');
                btn.disabled = false;
                btnText.textContent = 'Login';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            clearErrors();
            setLoading(true);

            const formData = new FormData(this);
            const payload = {
                email: formData.get('email'),
                password: formData.get('password'),
                remember: formData.get('remember') ? true : false
            };

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        // Show field-specific errors
                        Object.keys(data.errors).forEach(field => {
                            showFieldError(field, data.errors[field][0]);
                        });
                        showFormNotification('error', 'Periksa kembali email dan password Anda');
                    } else {
                        showFormNotification('error', data.message || 'Login gagal, periksa kembali kredensial Anda');
                    }
                    return;
                }

                // Simpan token di localStorage
                localStorage.setItem('auth_token', data.token);

                // Show success notification
                showFormNotification('success', 'Login berhasil! Mengalihkan...');

                // Redirect after short delay
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);

            } catch (error) {
                console.error('Login Error:', error);
                showToast('error', 'Kesalahan Sistem', 'Terjadi kesalahan koneksi. Silakan coba lagi.');
            } finally {
                setLoading(false);
            }
        });
    </script>
</body>

</html>
