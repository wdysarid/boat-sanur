<nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center" data-aos="fade-right" data-aos-duration="800">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="DreamIslands Logo" class="h-12 w-auto mr-2">
                    <a href="/" class="text-blue-600 font-bold text-xl">SanurFerryPass</a>
                </div>
            </div>

            <!-- Navigation Links and Buttons (Right Side) -->
            <div class="flex items-center">
                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 items-center">
                    <a href="#home" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" data-aos="fade-down" data-aos-delay="100" data-aos-duration="600">
                        Home
                    </a>
                    <a href="#about-us" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" data-aos="fade-down" data-aos-delay="200" data-aos-duration="600">
                        About Us
                    </a>
                    <a href="#destinations" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" data-aos="fade-down" data-aos-delay="300" data-aos-duration="600">
                        Destinations
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" data-aos="fade-down" data-aos-delay="400" data-aos-duration="600">
                        My Tickets
                    </a>
                    <!-- Login button (desktop) -->
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out ml-2 shadow-lg" data-aos="fade-left" data-aos-delay="500" data-aos-duration="800">
                        Login
                    </a>
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
            <a href="#" class="bg-blue-50 border-blue-500 text-blue-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" data-aos="fade-right" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                Home
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" data-aos="fade-right" data-aos-delay="100" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                About Us
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" data-aos="fade-right" data-aos-delay="200" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                Destinations
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" data-aos="fade-right" data-aos-delay="300" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                Contact
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" data-aos="fade-right" data-aos-delay="400" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                My Tickets
            </a>
            <div class="pt-4 pb-2" data-aos="fade-up" data-aos-delay="500" data-aos-duration="400" data-aos-anchor="#mobile-menu">
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">
                    Login
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClosedIcon = document.getElementById('menu-closed-icon');
        const menuOpenIcon = document.getElementById('menu-open-icon');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                // Toggle mobile menu visibility
                mobileMenu.classList.toggle('hidden');

                // Toggle between hamburger and X icons
                menuClosedIcon.classList.toggle('hidden');
                menuOpenIcon.classList.toggle('hidden');

                // Update aria-expanded attribute
                const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                mobileMenuButton.setAttribute('aria-expanded', !isExpanded);

                // Reinitialize AOS for mobile menu items
                if (!mobileMenu.classList.contains('hidden')) {
                    AOS.refresh();
                }
            });
        }

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
                navbar.classList.remove('shadow-sm');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.add('shadow-sm');
            }
        });
    });
</script>
