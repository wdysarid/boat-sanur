<header class="w-full bg-white border-b border-gray-100 shadow-sm h-full">
    <div class="px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-between h-full">
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Logo/Title -->
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-gray-900">Admin Panel</h1>
            </div>

            <!-- Search -->
            <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-start max-w-lg">
                <div class="w-full lg:max-w-xs">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:placeholder-gray-300 focus:ring-1 focus:border-blue-500 sm:text-sm" placeholder="Search" type="search">
                    </div>
                </div>
            </div>

            <!-- Right side menu -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative">
                    <button type="button" class="p-2 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                </div>

                <!-- Profile dropdown -->
                <div class="relative">
                    <button type="button"
                            id="userMenuButton"
                            class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:bg-gray-50 px-3 py-2 transition-colors duration-200">
                        <img class="h-8 w-8 rounded-full object-cover"
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=2271B3&color=fff"
                             alt="{{ Auth::user()->nama }}">
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium text-gray-700">{{ Auth::user()->nama }}</div>
                            <div class="text-xs text-gray-500">Administrator</div>
                        </div>
                        <svg class="h-4 w-4 text-gray-400 transition-transform duration-200"
                             id="dropdownArrow"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="userDropdown"
                         class="hidden origin-top-right absolute right-0 mt-2 w-80 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 opacity-0 scale-95 transition-all duration-100">

                        <!-- User info header -->
                        <div class="px-4 py-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <img class="h-12 w-12 rounded-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=2271B3&color=fff"
                                     alt="{{ Auth::user()->nama }}">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->nama }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    @if(Auth::user()->no_telp)
                                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->no_telp }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Menu items -->
                        <div class="py-2">
                            <a href="#"
                               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                                <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Profile
                            </a>


                        </div>

                        <!-- Logout section -->
                        <div class="border-t border-gray-100">
                            <button type="button"
                                    id="logoutButton"
                                    class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                <svg class="mr-3 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Hidden logout form for fallback -->
<form id="logoutForm" method="POST" action="#" style="display: none;">
    @csrf
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');
    const dropdownArrow = document.getElementById('dropdownArrow');
    const logoutButton = document.getElementById('logoutButton');
    let isDropdownOpen = false;

    // Toggle dropdown
    function toggleDropdown() {
        isDropdownOpen = !isDropdownOpen;

        if (isDropdownOpen) {
            userDropdown.classList.remove('hidden');
            userDropdown.offsetHeight;
            userDropdown.classList.remove('opacity-0', 'scale-95');
            userDropdown.classList.add('opacity-100', 'scale-100');
            dropdownArrow.style.transform = 'rotate(180deg)';
        } else {
            userDropdown.classList.remove('opacity-100', 'scale-100');
            userDropdown.classList.add('opacity-0', 'scale-95');
            dropdownArrow.style.transform = 'rotate(0deg)';

            setTimeout(() => {
                if (!isDropdownOpen) {
                    userDropdown.classList.add('hidden');
                }
            }, 100);
        }
    }

    // Logout functionality using global function
    logoutButton.addEventListener('click', function(e) {
        e.preventDefault();

        if (confirm('Apakah Anda yakin ingin logout?')) {
            window.performLogout();
        }
    });

    // Dropdown events
    userMenuButton.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown();
    });

    document.addEventListener('click', function(e) {
        if (isDropdownOpen && !userDropdown.contains(e.target) && !userMenuButton.contains(e.target)) {
            toggleDropdown();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isDropdownOpen) {
            toggleDropdown();
        }
    });
});
</script>
