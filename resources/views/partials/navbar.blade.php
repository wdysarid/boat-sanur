<nav id="navbar" class="fixed w-full top-0 left-0 z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <!-- Logo -->
        <div class="text-2xl font-bold text-gray-900">
            Logo
        </div>

        <!-- Hamburger button (mobile) -->
        <button id="menu-btn" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Desktop menu -->
        <ul id="menu" class="hidden md:flex space-x-8 items-center font-medium text-gray-900">
            <li><a href="#home" class="hover:text-blue-600">Home</a></li>
            <li><a href="#about" class="hover:text-blue-600">About Us</a></li>
            <li><a href="#testimonials" class="hover:text-blue-600">Testimonials</a></li>
            <li><a href="#my-ticket" class="hover:text-blue-600">My Ticket</a></li>
            <li>
                <div class="h-5 w-px bg-gray-400 mx-2"></div>
            </li>
            <li><a href="#register" class="hover:text-blue-600">Register</a></li>
            <li>
                <a href="#login" class="ml-2 bg-gray-100 text-gray-900 px-4 py-2 rounded hover:bg-gray-200 transition">
                    Log In
                </a>
            </li>
        </ul>
    </div>

    <!-- Mobile menu -->
    <ul id="mobile-menu" class="md:hidden bg-white w-full text-gray-900 hidden flex-col space-y-4 px-6 pb-6">
        <li><a href="#home" class="block py-2 hover:text-blue-600">Home</a></li>
        <li><a href="#about" class="block py-2 hover:text-blue-600">About Us</a></li>
        <li><a href="#testimonials" class="block py-2 hover:text-blue-600">Testimonials</a></li>
        <li><a href="#my-ticket" class="block py-2 hover:text-blue-600">My Ticket</a></li>
        <li>
            <hr>
        </li>
        <li><a href="#register" class="block py-2 hover:text-blue-600">Register</a></li>
        <li><a href="#login" class="block py-2 bg-gray-100 px-4 rounded hover:bg-gray-200 transition">Log In</a></li>
    </ul>
</nav>
