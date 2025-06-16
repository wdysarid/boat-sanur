<header class="relative" id="home">
    <div class="relative h-[700px] overflow-hidden">
        <!-- Single full-width background image -->
        <div class="absolute inset-0" data-aos="fade" data-aos-duration="1500">
            <div class="absolute inset-0 bg-black/30 z-0"></div>
            <img src="{{ asset('images/header-bg.jpg') }}" alt="Dream Islands"
                class="w-full h-full object-cover object-center">
        </div>

        <!-- Content overlay -->
        <div class="absolute inset-0 flex flex-col justify-center z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-xl" data-aos="fade-right" data-aos-delay="300" data-aos-duration="1000">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight uppercase tracking-wide">
                        Practical Access to Dream Islands
                    </h1>
                    <p class="text-white text-base md:text-lg mt-4 max-w-lg opacity-90 font-light">
                        Discover the most beautiful islands and beaches around the world. Book your dream vacation
                        today.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATED: Search container with proper z-index and scroll behavior -->
    <div id="search-container" class="absolute -bottom-8 left-0 right-0 px-4 sm:px-6 lg:px-8 z-40 transition-all duration-300"
         data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-6">
                <form action="{{ route('search.tickets') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- From -->
                        <div data-aos="fade-up" data-aos-delay="700" data-aos-anchor=".bg-white">
                            <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                            <div class="relative">
                                <select name="from" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none cursor-pointer bg-gray-50" required>
                                    <option value="" selected disabled>Select departure</option>
                                    <option value="Sanur" {{ request('from') == 'Sanur' ? 'selected' : '' }}>Sanur</option>
                                    <option value="Nusa Penida" {{ request('from') == 'Nusa Penida' ? 'selected' : '' }}>Nusa Penida</option>
                                    <option value="Nusa Lembongan" {{ request('from') == 'Nusa Lembongan' ? 'selected' : '' }}>Nusa Lembongan</option>
                                    <option value="Nusa Ceningan" {{ request('from') == 'Nusa Ceningan' ? 'selected' : '' }}>Nusa Ceningan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- To -->
                        <div data-aos="fade-up" data-aos-delay="750" data-aos-anchor=".bg-white">
                            <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                            <div class="relative">
                                <select name="to" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none cursor-pointer bg-gray-50" required>
                                    <option value="" selected disabled>Select destination</option>
                                    <option value="Sanur" {{ request('to') == 'Sanur' ? 'selected' : '' }}>Sanur</option>
                                    <option value="Nusa Penida" {{ request('to') == 'Nusa Penida' ? 'selected' : '' }}>Nusa Penida</option>
                                    <option value="Nusa Lembongan" {{ request('to') == 'Nusa Lembongan' ? 'selected' : '' }}>Nusa Lembongan</option>
                                    <option value="Nusa Ceningan" {{ request('to') == 'Nusa Ceningan' ? 'selected' : '' }}>Nusa Ceningan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        <div data-aos="fade-up" data-aos-delay="800" data-aos-anchor=".bg-white">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <div class="relative">
                                <input type="date" name="departure_date" value="{{ request('departure_date', date('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="block w-full pl-3 pr-3 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-gray-50"
                                    required>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-end" data-aos="fade-up" data-aos-delay="900" data-aos-anchor=".bg-white">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- Hidden fields for default values -->
                    <input type="hidden" name="passenger_type" value="foreign">
                    <input type="hidden" name="passenger_count" value="1">
                </form>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchContainer = document.getElementById('search-container');
    const navbar = document.querySelector('nav');

    if (searchContainer && navbar) {
        let lastScrollY = window.scrollY;

        function handleSearchContainerScroll() {
            const currentScrollY = window.scrollY;
            const navbarHeight = navbar.offsetHeight;
            const searchRect = searchContainer.getBoundingClientRect();

            // UPDATED: Jika search container akan bertabrakan dengan navbar
            if (searchRect.top <= navbarHeight + 10) { // 10px buffer
                // Pindahkan search container ke bawah navbar
                searchContainer.style.transform = `translateY(${navbarHeight + 20 - searchRect.top}px)`;
                searchContainer.style.zIndex = '30'; // Di bawah navbar
            } else {
                // Reset posisi normal
                searchContainer.style.transform = 'translateY(0)';
                searchContainer.style.zIndex = '40';
            }

            lastScrollY = currentScrollY;
        }

        // Throttle scroll event untuk performa yang lebih baik
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(handleSearchContainerScroll, 10);
        });

        // Initial check
        handleSearchContainerScroll();
    }
});
</script>

<style>
/* UPDATED: Enhanced search container styling */
#search-container {
    /* Smooth transition untuk semua transformasi */
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), z-index 0.3s ease;
}

/* Responsive adjustments untuk search form */
@media (max-width: 768px) {
    #search-container {
        /* Di mobile, berikan lebih banyak ruang */
        bottom: -12px;
    }

    #search-container .grid {
        /* Stack semua field di mobile */
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

@media (min-width: 769px) and (max-width: 1023px) {
    #search-container .grid {
        /* 2 kolom di tablet */
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Enhanced form styling */
#search-container select:focus,
#search-container input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
}

#search-container button:hover {
    transform: translateY(-1px);
}

#search-container button:active {
    transform: translateY(0);
}

/* Smooth shadow transition */
#search-container .bg-white {
    transition: box-shadow 0.3s ease;
}

#search-container .bg-white:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Ensure proper spacing from navbar */
.scroll-margin-navbar {
    scroll-margin-top: 80px;
}
</style>
