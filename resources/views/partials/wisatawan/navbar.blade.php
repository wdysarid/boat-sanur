<!-- Navbar Wisatawan -->
<nav class="bg-white shadow-lg fixed w-full z-50 transition-all duration-300" x-data="{ mobileMenuOpen: false, profileDropdownOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="SanurBoat Logo" class="h-10 w-auto mr-3">
                    <a href="{{ route('wisatawan.dashboard') }}" class="text-blue-600 font-bold text-xl hover:text-blue-700 transition-colors">
                        SanurBoat
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('wisatawan.dashboard') }}"
                   class="{{ request()->routeIs('wisatawan.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('wisatawan.pemesanan') }}"
                   class="{{ request()->routeIs('wisatawan.pemesanan') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600' }} px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Pesan Tiket
                </a>

                <!-- Notification Bell -->
                @include('partials.wisatawan.notification-bell')

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="profileDropdownOpen = !profileDropdownOpen"
                            class="flex items-center text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <!-- Avatar di navbar button - PERBAIKAN -->
                        <div class="relative inline-block mr-2">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-200 flex-shrink-0 bg-gray-100">
                                @if(Auth::user()->foto_user && file_exists(public_path('storage/' . Auth::user()->foto_user)))
                                    <img src="{{ asset('storage/' . Auth::user()->foto_user) }}"
                                         alt="{{ Auth::user()->nama }}"
                                         class="w-full h-full object-cover">
                                @elseif(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}"
                                         alt="{{ Auth::user()->nama }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">
                                            {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Status Indicator - PERBAIKAN -->
                            @if(Auth::user()->email_verified_at)
                                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full z-20"></div>
                            @else
                                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-yellow-500 border-2 border-white rounded-full z-20"></div>
                            @endif
                        </div>

                        <span class="max-w-32 truncate">{{ Auth::user()->nama ?? 'User' }}</span>
                        <svg class="ml-2 h-4 w-4 transition-transform" :class="profileDropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="profileDropdownOpen"
                         @click.away="profileDropdownOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 border border-gray-100">

                        <!-- Profile Header di Dropdown - PERBAIKAN -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <!-- Avatar Container -->
                                <div class="flex-shrink-0">
                                    <div class="relative inline-block">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-100">
                                            @if(Auth::user()->foto_user && file_exists(public_path('storage/' . Auth::user()->foto_user)))
                                                <img src="{{ asset('storage/' . Auth::user()->foto_user) }}"
                                                     alt="{{ Auth::user()->nama }}"
                                                     class="w-full h-full object-cover">
                                            @elseif(Auth::user()->avatar)
                                                <img src="{{ Auth::user()->avatar }}"
                                                     alt="{{ Auth::user()->nama }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                                    <span class="text-white font-semibold text-sm">
                                                        {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Status indicator dengan icon -->
                                        @if(Auth::user()->email_verified_at)
                                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full flex items-center justify-center z-20">
                                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-yellow-500 border-2 border-white rounded-full flex items-center justify-center z-20">
                                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- User Info Container -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">
                                            {{ Auth::user()->nama ?? 'User' }}
                                        </h3>
                                        <p class="text-xs text-gray-500 truncate">
                                            {{ Auth::user()->email }}
                                        </p>
                                        @if(Auth::user()->email_verified_at)
                                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 w-fit">
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 w-fit">
                                                Belum Verifikasi
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <a href="{{ route('wisatawan.dashboard') }}"
                           class="{{ request()->routeIs('wisatawan.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-4 py-2 text-sm transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('wisatawan.profile') }}"
                           class="{{ request()->routeIs('wisatawan.profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-4 py-2 text-sm transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Saya
                        </a>

                        <a href="{{ route('wisatawan.tiket') }}"
                           class="{{ request()->routeIs('wisatawan.tiket') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-4 py-2 text-sm transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            Tiket Saya
                        </a>

                        <a href="{{ route('wisatawan.pembayaran') }}"
                           class="{{ request()->routeIs('wisatawan.pembayaran') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-4 py-2 text-sm transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Pembayaran
                        </a>

                        <a href="{{ route('wisatawan.feedback') }}"
                           class="{{ request()->routeIs('wisatawan.feedback') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }} flex items-center px-4 py-2 text-sm transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Feedback Saya
                        </a>

                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                    <svg class="h-6 w-6" :class="mobileMenuOpen ? 'hidden' : 'block'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="mobileMenuOpen ? 'block' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="md:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-3 py-2 text-base font-medium rounded-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>

            <a href="{{ route('wisatawan.dashboard') }}"
               class="{{ request()->routeIs('wisatawan.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-3 py-2 text-base font-medium rounded-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('wisatawan.pemesanan') }}"
               class="{{ request()->routeIs('wisatawan.pemesanan') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-3 py-2 text-base font-medium rounded-md transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                Pesan Tiket
            </a>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-5 space-x-3">
                <!-- Mobile Avatar - PERBAIKAN -->
                <div class="flex-shrink-0">
                    <div class="relative inline-block">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-100">
                            @if(Auth::user()->foto_user && file_exists(public_path('storage/' . Auth::user()->foto_user)))
                                <img src="{{ asset('storage/' . Auth::user()->foto_user) }}"
                                     alt="{{ Auth::user()->nama }}"
                                     class="w-full h-full object-cover">
                            @elseif(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}"
                                     alt="{{ Auth::user()->nama }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">
                                        {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Status indicator -->
                        @if(Auth::user()->email_verified_at)
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full z-20"></div>
                        @else
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-yellow-500 border-2 border-white rounded-full z-20"></div>
                        @endif
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="text-base font-medium text-gray-800 truncate">{{ Auth::user()->nama ?? 'User' }}</div>
                    <div class="text-sm font-medium text-gray-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('wisatawan.profile') }}"
                   class="{{ request()->routeIs('wisatawan.profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-4 py-2 text-base font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Saya
                </a>

                <a href="{{ route('wisatawan.tiket') }}"
                   class="{{ request()->routeIs('wisatawan.tiket') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-4 py-2 text-base font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Tiket Saya
                </a>

                <a href="{{ route('wisatawan.pembayaran') }}"
                   class="{{ request()->routeIs('wisatawan.pembayaran') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-4 py-2 text-base font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Pembayaran
                </a>

                <a href="{{ route('wisatawan.feedback') }}"
                   class="{{ request()->routeIs('wisatawan.feedback') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50' }} flex items-center px-4 py-2 text-base font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Feedback Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-base font-medium text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function timeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);

        const intervals = {
            tahun: 31536000,
            bulan: 2592000,
            minggu: 604800,
            hari: 86400,
            jam: 3600,
            menit: 60,
            detik: 1
        };

        for (const [unit, secondsInUnit] of Object.entries(intervals)) {
            const interval = Math.floor(seconds / secondsInUnit);
            if (interval >= 1) {
                return interval === 1 ? `1 ${unit} yang lalu` : `${interval} ${unit} yang lalu`;
            }
        }

        return 'Baru saja';
    }
</script>
