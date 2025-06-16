<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Wisatawan') - {{ config('app.name', 'SanurBoat') }}</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="/images/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Enhanced Toast Styles -->
    <style>
        /* Modern Toast Styles */
        .toast-container {
            position: fixed;
            top: 5rem;
            right: 1rem;
            z-index: 9999;
            max-width: 420px;
            width: 100%;
        }

        .toast-item {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 0.75rem;
            overflow: hidden;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .toast-item.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-item.hide {
            transform: translateX(100%);
            opacity: 0;
        }

        .toast-item:hover {
            transform: translateX(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.08);
        }

        /* Toast Types */
        .toast-success {
            border-left: 4px solid #10b981;
        }

        .toast-success .toast-icon {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .toast-error {
            border-left: 4px solid #ef4444;
        }

        .toast-error .toast-icon {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .toast-warning {
            border-left: 4px solid #f59e0b;
        }

        .toast-warning .toast-icon {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .toast-info {
            border-left: 4px solid #3b82f6;
        }

        .toast-info .toast-icon {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .toast-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast-close {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: rgba(0, 0, 0, 0.05);
            border: none;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #6b7280;
        }

        .toast-close:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #374151;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .toast-progress-bar {
            height: 100%;
            width: 100%;
            transition: width linear;
        }

        .toast-success .toast-progress-bar {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .toast-error .toast-progress-bar {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        .toast-warning .toast-progress-bar {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .toast-info .toast-progress-bar {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }

        /* Mobile Responsive */
        @media (max-width: 640px) {
            .toast-container {
                top: 4rem;
                left: 1rem;
                right: 1rem;
                max-width: none;
            }
        }

        /* Animation for multiple toasts */
        .toast-item:nth-child(2) {
            transform: translateX(100%) scale(0.95);
        }

        .toast-item:nth-child(3) {
            transform: translateX(100%) scale(0.9);
        }

        .toast-item.show:nth-child(2) {
            transform: translateX(0) scale(0.95);
        }

        .toast-item.show:nth-child(3) {
            transform: translateX(0) scale(0.9);
        }
    </style>

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('partials.wisatawan.navbar')

        <!-- Page Content -->
        <main class="pt-16">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.user.footer')
    </div>

    <!-- Enhanced Toast Container -->
    <div id="toast-container" class="toast-container">
        <!-- Toast messages will be inserted here -->
    </div>

    <!-- Scripts -->
    @stack('scripts')

    <!-- Enhanced Toast JavaScript -->
    <script>
        class ModernToast {
            constructor() {
                this.container = document.getElementById('toast-container');
                this.toasts = [];
                this.counter = 0;
            }

            show(message, type = 'success', title = null, duration = 5000) {
                const toastId = ++this.counter;
                const toast = this.createToast(toastId, message, type, title, duration);

                this.container.appendChild(toast);
                this.toasts.push({ id: toastId, element: toast });

                // Animate in
                requestAnimationFrame(() => {
                    toast.classList.add('show');
                });

                // Auto remove
                if (duration > 0) {
                    setTimeout(() => {
                        this.hide(toastId);
                    }, duration);
                }

                return toastId;
            }

            createToast(id, message, type, title, duration) {
                const toast = document.createElement('div');
                toast.className = `toast-item toast-${type}`;
                toast.setAttribute('data-toast-id', id);

                const titleHtml = title ? `<p class="text-sm font-semibold text-gray-900 mb-1">${title}</p>` : '';

                toast.innerHTML = `
                    <div class="p-4 pr-12">
                        <div class="flex items-start">
                            <div class="toast-icon mr-3">
                                ${this.getIcon(type)}
                            </div>
                            <div class="flex-1 min-w-0">
                                ${titleHtml}
                                <p class="text-sm text-gray-700 leading-relaxed">${message}</p>
                            </div>
                        </div>
                    </div>
                    <button class="toast-close" onclick="modernToast.hide(${id})">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    ${duration > 0 ? `
                    <div class="toast-progress">
                        <div class="toast-progress-bar" style="transition-duration: ${duration}ms;"></div>
                    </div>` : ''}
                `;

                // Start progress bar animation
                if (duration > 0) {
                    setTimeout(() => {
                        const progressBar = toast.querySelector('.toast-progress-bar');
                        if (progressBar) {
                            progressBar.style.width = '0%';
                        }
                    }, 100);
                }

                // Pause on hover
                toast.addEventListener('mouseenter', () => {
                    const progressBar = toast.querySelector('.toast-progress-bar');
                    if (progressBar) {
                        progressBar.style.animationPlayState = 'paused';
                    }
                });

                toast.addEventListener('mouseleave', () => {
                    const progressBar = toast.querySelector('.toast-progress-bar');
                    if (progressBar) {
                        progressBar.style.animationPlayState = 'running';
                    }
                });

                return toast;
            }

            hide(toastId) {
                const toastIndex = this.toasts.findIndex(t => t.id === toastId);
                if (toastIndex === -1) return;

                const toast = this.toasts[toastIndex].element;
                toast.classList.remove('show');
                toast.classList.add('hide');

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                    this.toasts.splice(toastIndex, 1);
                }, 400);
            }

            getIcon(type) {
                const icons = {
                    success: `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>`,
                    error: `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>`,
                    warning: `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>`,
                    info: `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>`
                };
                return icons[type] || icons.info;
            }

            // Utility methods
            success(message, title = 'Berhasil!', duration = 3000) {
                return this.show(message, 'success', title, duration);
            }

            error(message, title = 'Error!', duration = 6000) {
                return this.show(message, 'error', title, duration);
            }

            warning(message, title = 'Peringatan!', duration = 5500) {
                return this.show(message, 'warning', title, duration);
            }

            info(message, title = 'Informasi', duration = 5000) {
                return this.show(message, 'info', title, duration);
            }

            clear() {
                this.toasts.forEach(toast => {
                    this.hide(toast.id);
                });
            }
        }

        // Initialize modern toast
        const modernToast = new ModernToast();

        // Backward compatibility
        function showToast(message, type = 'success', title = null) {
            return modernToast.show(message, type, title);
        }

        // Show Laravel flash messages as enhanced toasts
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                modernToast.success('{{ session('success') }}');
            @endif

            @if(session('error'))
                modernToast.error('{{ session('error') }}');
            @endif

            @if(session('warning'))
                modernToast.warning('{{ session('warning') }}');
            @endif

            @if(session('info'))
                modernToast.info('{{ session('info') }}');
            @endif

            // Welcome toast for authenticated users
            @auth
                @if(!session('toast_shown'))
                    setTimeout(() => {
                        modernToast.success(
                            'Selamat datang kembali di SanurBoat! Kelola perjalanan Anda dengan mudah.',
                            'Halo, {{ Auth::user()->name }}! 👋'
                        );
                    }, 1000);
                    @php session(['toast_shown' => true]); @endphp
                @endif
            @endauth
        });

        // Global toast access
        window.toast = modernToast;
    </script>
</body>
</html>
