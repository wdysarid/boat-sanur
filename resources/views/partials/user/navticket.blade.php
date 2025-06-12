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
