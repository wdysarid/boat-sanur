<header class="w-full bg-white border-b border-gray-100 shadow-sm h-full">
    <div class="px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-between h-full">
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Search -->
            <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-start">
                <div class="max-w-lg w-full lg:max-w-xs">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:placeholder-gray-300 focus:ring-1 focus:border-blue-500 sm:text-sm" placeholder="Search" type="search" style="--tw-ring-color: #2271B3; --tw-border-opacity: 1; --tw-border-color: rgba(34, 113, 179, var(--tw-border-opacity));">
                    </div>
                </div>
            </div>

            <!-- Right side menu - Simplified for guest access -->
            <div class="flex items-center">
                <!-- View Mode Indicator -->
                <span class="hidden sm:inline-block px-3 py-1 text-xs font-medium rounded-full" style="background-color: #E6F0F9; color: #2271B3;">
                    View Only Mode
                </span>

                <!-- Notifications - Kept for UI consistency -->
                <button type="button" class="ml-3 p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2" style="--tw-ring-color: #2271B3;">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Profile dropdown - Simplified for guest access -->
                <div class="ml-3 relative">
                    <div>
                        <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true" style="--tw-ring-color: #2271B3;">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Guest+User&background=2271B3&color=fff" alt="Guest User">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
