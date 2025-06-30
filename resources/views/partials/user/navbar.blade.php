<nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center" data-aos="fade-right" data-aos-duration="800">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="DreamIslands Logo" class="h-10 w-auto mr-2">
                    <a href="/" class="text-blue-600 font-bold text-xl">SanurBoat</a>
                </div>
            </div>

            <!-- Navigation Links and Buttons (Right Side) -->
            <div class="flex items-center">
                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 items-center">
                    <a href="#home"
                       class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200"
                       data-section="home"
                       data-aos="fade-down" data-aos-delay="100" data-aos-duration="600">
                        Home
                    </a>
                    <a href="#about-us"
                       class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200"
                       data-section="about-us"
                       data-aos="fade-down" data-aos-delay="200" data-aos-duration="600">
                        About Us
                    </a>
                    <a href="#feedback"
                       class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200"
                       data-section="feedback"
                       data-aos="fade-down" data-aos-delay="300" data-aos-duration="600">
                        Feedback
                    </a>

                    <!-- My Tickets Link - UPDATED: Mengarah ke pemesanan tiket -->
                    @auth
                        <a href="{{ route('wisatawan.tiket') }}"
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200"
                           data-aos="fade-down" data-aos-delay="400" data-aos-duration="600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            My Tickets
                        </a>
                    @else
                        <a href="{{ route('login') }}?intended={{ urlencode(route('wisatawan.tiket')) }}"
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200"
                           data-aos="fade-down" data-aos-delay="400" data-aos-duration="600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            My Tickets
                        </a>
                    @endauth

                    @auth
                        <!-- User is logged in -->
                        <div class="relative ml-3" data-aos="fade-left" data-aos-delay="500" data-aos-duration="800">
                            <div>
                                <button type="button" class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">
                                            {{ substr(auth()->user()->nama, 0, 1) }}
                                        </span>
                                    </div>
                                </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-menu">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                    <div class="font-medium">{{ auth()->user()->nama }}</div>
                                    <div class="text-gray-500">{{ auth()->user()->email }}</div>
                                </div>
                                <a href="{{ route('wisatawan.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('wisatawan.feedback') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    My Feedback
                                </a>
                                <a href="{{ route('wisatawan.pemesanan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                    Book Tickets
                                </a>
                                <a href="{{ route('wisatawan.tiket') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    My Bookings
                                </a>
                                <a href="{{ route('wisatawan.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- User is not logged in -->
                        <a href="{{ route('login') }}"
                           class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out ml-2 shadow-lg"
                           data-aos="fade-left" data-aos-delay="600" data-aos-duration="800">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden" data-aos="fade-left" data-aos-duration="800">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg id="menu-closed-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg id="menu-open-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="#home"
               class="mobile-nav-link border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-200"
               data-section="home"
               data-aos="fade-right" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                Home
            </a>
            <a href="#about-us"
               class="mobile-nav-link border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-200"
               data-section="about-us"
               data-aos="fade-right" data-aos-delay="100" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                About Us
            </a>
            <a href="#feedback"
               class="mobile-nav-link border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-200"
               data-section="feedback"
               data-aos="fade-right" data-aos-delay="200" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                Feedback
            </a>

            <!-- Mobile My Tickets Link - UPDATED: Mengarah ke pemesanan tiket -->
            @auth
                <a href="{{ route('wisatawan.tiket') }}"
                   class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-200"
                   data-aos="fade-right" data-aos-delay="300" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    My Tickets
                </a>
            @else
                <a href="{{ route('login') }}?intended={{ urlencode(route('wisatawan.tiket')) }}"
                   class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-200"
                   data-aos="fade-right" data-aos-delay="300" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    My Tickets
                </a>
            @endauth

            @auth
                <!-- Mobile user menu -->
                <div class="pt-4 pb-2 border-t border-gray-200" data-aos="fade-up" data-aos-delay="400" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                    <div class="px-4 py-2">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->nama }}</div>
                        <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('wisatawan.dashboard') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 2 0 00-2-2H5a2 2 0 00-2-2V7"/>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('wisatawan.feedback') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            My Feedback
                        </a>
                        <a href="{{ route('wisatawan.pemesanan') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            Book Tickets
                        </a>
                        <a href="{{ route('wisatawan.tiket') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            My Bookings
                        </a>
                        <a href="{{ route('wisatawan.profile') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Mobile login button -->
                <div class="pt-4 pb-2 border-t border-gray-200" data-aos="fade-up" data-aos-delay="500" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-md text-base font-medium transition duration-150 ease-in-out mx-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </a>
                    <p class="text-center text-sm text-gray-500 mt-3 px-4">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">Daftar di sini</a>
                    </p>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuClosedIcon = document.getElementById('menu-closed-icon');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    // Mobile menu toggle
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuClosedIcon.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');

            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);

            if (!mobileMenu.classList.contains('hidden')) {
                AOS.refresh();
            }
        });
    }

    // User dropdown menu toggle (desktop)
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }

    // Smooth scroll functionality
    function smoothScrollTo(targetId) {
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            const navbarHeight = document.querySelector('nav').offsetHeight;
            const targetPosition = targetElement.offsetTop - navbarHeight - 20; // 20px extra padding

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Handle navigation clicks
    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Only prevent default for anchor links (starting with #)
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();

                const targetSection = this.getAttribute('data-section');
                if (targetSection) {
                    smoothScrollTo(targetSection);

                    // Close mobile menu if open
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuClosedIcon.classList.remove('hidden');
                        menuOpenIcon.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    }
                }
            }
        });
    });

    // Active section detection on scroll
    function updateActiveNavigation() {
        const sections = ['home', 'about-us', 'feedback'];
        const navbarHeight = document.querySelector('nav').offsetHeight;
        const scrollPosition = window.scrollY + navbarHeight + 100; // 100px offset for better detection

        let activeSection = 'home'; // default

        // Check which section is currently in view
        sections.forEach(sectionId => {
            const element = document.getElementById(sectionId);
            if (element) {
                const sectionTop = element.offsetTop;
                const sectionBottom = sectionTop + element.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    activeSection = sectionId;
                }
            }
        });

        // Update desktop navigation
        const desktopNavLinks = document.querySelectorAll('.nav-link');
        desktopNavLinks.forEach(link => {
            const linkSection = link.getAttribute('data-section');
            if (linkSection === activeSection) {
                link.classList.remove('border-transparent', 'text-gray-500');
                link.classList.add('border-blue-500', 'text-blue-600');
            } else {
                link.classList.remove('border-blue-500', 'text-blue-600');
                link.classList.add('border-transparent', 'text-gray-500');
            }
        });

        // Update mobile navigation
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            const linkSection = link.getAttribute('data-section');
            if (linkSection === activeSection) {
                link.classList.remove('border-transparent', 'text-gray-500');
                link.classList.add('bg-blue-50', 'border-blue-500', 'text-blue-700');
            } else {
                link.classList.remove('bg-blue-50', 'border-blue-500', 'text-blue-700');
                link.classList.add('border-transparent', 'text-gray-500');
            }
        });
    }

    // Scroll event listener with throttling for better performance
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        // Navbar shadow effect
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-md');
            navbar.classList.remove('shadow-sm');
        } else {
            navbar.classList.remove('shadow-md');
            navbar.classList.add('shadow-sm');
        }

        // Throttle the active navigation update
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(updateActiveNavigation, 10);
    });

    // Initial call to set active navigation
    updateActiveNavigation();

    // Handle special case for home section (top of page)
    if (window.scrollY === 0) {
        const homeLinks = document.querySelectorAll('[data-section="home"]');
        homeLinks.forEach(link => {
            if (link.classList.contains('nav-link')) {
                link.classList.remove('border-transparent', 'text-gray-500');
                link.classList.add('border-blue-500', 'text-blue-600');
            } else if (link.classList.contains('mobile-nav-link')) {
                link.classList.remove('border-transparent', 'text-gray-500');
                link.classList.add('bg-blue-50', 'border-blue-500', 'text-blue-700');
            }
        });
    }

    // Close mobile menu when clicking on regular nav links (not anchor links)
    const allNavLinks = document.querySelectorAll('a[href]:not([href^="#"])');
    allNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                menuClosedIcon.classList.remove('hidden');
                menuOpenIcon.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    });
});
</script>

<style>
/* Active state transitions */
.nav-link {
    position: relative;
}

.nav-link.border-blue-500 {
    font-weight: 600;
}

/* Smooth border animation */
.nav-link::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #3b82f6;
    transition: width 0.3s ease-in-out;
}

.nav-link:hover::after {
    width: 100%;
}

.nav-link.border-blue-500::after {
    width: 100%;
}

/* Mobile active state styling */
.mobile-nav-link.bg-blue-50 {
    font-weight: 600;
}

/* User dropdown animation */
#user-menu {
    transform: scale(0.95);
    opacity: 0;
    transition: all 0.1s ease-out;
}

#user-menu:not(.hidden) {
    transform: scale(1);
    opacity: 1;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Ensure sections have proper spacing for navbar */
section {
    scroll-margin-top: 80px; /* Adjust based on navbar height */
}

/* My Tickets link hover effect */
.nav-link:hover svg,
.mobile-nav-link:hover svg {
    transform: scale(1.1);
    transition: transform 0.2s ease-in-out;
}

/* Enhanced dropdown menu styling */
#user-menu a:hover svg {
    transform: translateX(2px);
    transition: transform 0.2s ease-in-out;
}

/* Mobile menu enhanced styling */
.mobile-nav-link svg {
    transition: all 0.2s ease-in-out;
}

.mobile-nav-link:hover svg {
    color: #3b82f6;
}
</style>
