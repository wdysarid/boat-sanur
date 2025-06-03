<header class="relative">
    <div class="relative h-[700px] overflow-hidden">
        <!-- Single full-width background image -->
        <div class="absolute inset-0" data-aos="fade" data-aos-duration="1500">
            <div class="absolute inset-0 bg-black/30 z-0"></div>
            <img src="{{ asset('images/header-bg.jpg') }}"
                 alt="Dream Islands"
                 class="w-full h-full object-cover object-center">
        </div>

        <!-- Content overlay -->
        <div class="absolute inset-0 flex flex-col justify-center z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-xl" data-aos="fade-right" data-aos-delay="300" data-aos-duration="1000">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight uppercase tracking-wide">
                        Practical Access to Dream Islands
                    </h1>
                    <p class="text-white text-base md:text-lg mt-4 max-w-lg opacity-90 font-light">
                        Discover the most beautiful islands and beaches around the world. Book your dream vacation today.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search container positioned absolutely at bottom of header -->
    <div class="absolute -bottom-8 left-0 right-0 px-4 sm:px-6 lg:px-8 z-50" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-6">
                <form action="#" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Destinations -->
                        <div data-aos="fade-up" data-aos-delay="700" data-aos-anchor=".bg-white">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Destinations</label>
                            <div class="relative">
                                <select name="destination" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none cursor-pointer bg-gray-50" required>
                                    <option value="" selected disabled>Select your destination</option>
                                    <option value="sanur-nusapenida">Sanur → Nusa Penida</option>
                                    <option value="nusapenida-sanur">Nusa Penida → Sanur</option>
                                    <option value="sanur-gilitrawangan">Sanur → Gili Trawangan</option>
                                    <option value="gilitrawangan-sanur">Gili Trawangan → Sanur</option>
                                    <option value="sanur-lombok">Sanur → Lombok</option>
                                    <option value="lombok-sanur">Lombok → Sanur</option>
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
                                <input type="date"
                                       name="departure_date"
                                       value="{{ date('Y-m-d') }}"
                                       min="{{ date('Y-m-d') }}"
                                       class="block w-full pl-3 pr-3 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-gray-50"
                                       required>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-end" data-aos="fade-up" data-aos-delay="900" data-aos-anchor=".bg-white">
                            <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
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
