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

                        <!-- Logout section -->
                        <div class="border-t border-gray-100">
                            <button type="button" id="logoutButton"
                                    class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                <svg class="mr-3 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </button>
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="logout-modal-overlay">
    <div class="logout-modal-content">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-center text-gray-900 mb-2">Konfirmasi Logout</h3>
            <p class="text-sm text-gray-500 text-center mb-6">
                Apakah Anda yakin ingin keluar dari akun Anda?
            </p>
            <div class="flex justify-center space-x-3">
                <button id="cancelLogout" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                    Batal
                </button>
                <button id="confirmLogout" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Logout Modal Styles */
.logout-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 2147483647; /* Maximum z-index value */
    opacity: 0;
    transition: opacity 0.3s ease;
}

.logout-modal-overlay.show {
    display: flex;
    opacity: 1;
}

.logout-modal-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    max-width: 400px;
    width: 90%;
    margin: 0 16px;
    transform: scale(0.95);
    transition: transform 0.3s ease;
    position: relative;
    z-index: 2147483647;
}

.logout-modal-overlay.show .logout-modal-content {
    transform: scale(1);
}

/* Force all elements to be below modal */
body.modal-open > *:not(#logoutModal) {
    position: relative;
    z-index: 1 !important;
}

body.modal-open {
    overflow: hidden;
}

/* Specific override for common sidebar selectors */
aside,
.sidebar,
nav,
[class*="sidebar"],
[class*="nav"] {
    position: relative !important;
    z-index: 1 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');
    const dropdownArrow = document.getElementById('dropdownArrow');
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

    // Logout modal functionality
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');
    const logoutForm = document.getElementById('logoutForm');

    // Force all elements to be below modal
    function forceModalOnTop() {
        // Get all elements and force them to have lower z-index
        const allElements = document.querySelectorAll('*:not(#logoutModal):not(#logoutModal *)');
        allElements.forEach(el => {
            const computedStyle = window.getComputedStyle(el);
            if (computedStyle.position !== 'static') {
                el.style.zIndex = '1';
            }
        });

        // Specifically target sidebar elements
        const sidebarElements = document.querySelectorAll('aside, .sidebar, nav, [class*="sidebar"], [class*="nav"]');
        sidebarElements.forEach(el => {
            el.style.position = 'relative';
            el.style.zIndex = '1';
        });
    }

    // Show logout modal
    function showLogoutModal() {
        // Close dropdown first
        if (isDropdownOpen) {
            toggleDropdown();
        }

        // Force modal on top
        forceModalOnTop();

        // Add body class
        document.body.classList.add('modal-open');

        // Show modal
        logoutModal.style.display = 'flex';

        // Force reflow
        logoutModal.offsetHeight;

        // Add show class for animation
        logoutModal.classList.add('show');
    }

    // Hide logout modal
    function hideLogoutModal() {
        logoutModal.classList.remove('show');
        document.body.classList.remove('modal-open');

        setTimeout(() => {
            logoutModal.style.display = 'none';

            // Reset z-index for all elements
            const allElements = document.querySelectorAll('*');
            allElements.forEach(el => {
                if (el.style.zIndex === '1') {
                    el.style.zIndex = '';
                }
            });
        }, 300);
    }

    // Logout button click
    logoutButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        showLogoutModal();
    });

    // Cancel logout
    cancelLogout.addEventListener('click', function() {
        hideLogoutModal();
    });

    // Confirm logout
    confirmLogout.addEventListener('click', function() {
        // Add loading state
        confirmLogout.disabled = true;
        confirmLogout.innerHTML = '<span class="animate-pulse">Logging out...</span>';

        // Submit the logout form
        setTimeout(() => {
            logoutForm.submit();
        }, 500);
    });

    // Close modal when clicking outside
    logoutModal.addEventListener('click', function(e) {
        if (e.target === logoutModal) {
            hideLogoutModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && logoutModal.classList.contains('show')) {
            hideLogoutModal();
        }
    });
});
</script>
