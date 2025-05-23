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
        <div class="absolute inset-0 flex flex-col z-10">
            <div class="flex-1 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-xl mt-50 pt-20" data-aos="fade-right" data-aos-delay="300" data-aos-duration="1000">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight uppercase tracking-wide">
                            Practical Access to Dream Islands
                        </h1>
                        <p class="text-white text-base md:text-lg mt-4 max-w-lg opacity-90 font-light">
                            Discover the most beautiful islands and beaches around the world. Book your dream vacation today.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Search container positioned at bottom -->
            <div class="relative transform translate-y-10 z-40" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-lg shadow-lg p-5">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-5">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                                <div class="border-t md:border-t-0 border-gray-200 md:pl-4 pt-2 md:pt-0" data-aos="fade-up" data-aos-delay="800" data-aos-anchor=".bg-white">
                                    <div class="mb-1">
                                        <label for="location-select" class="block text-sm font-medium text-gray-700">Destinations</label>
                                    </div>
                                    <div class="relative">
                                        <select id="location-select" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none cursor-pointer">
                                            <option value="" selected disabled>Select your destination</option>
                                            <option value="bali">Bali, Indonesia</option>
                                            <option value="maldives">Maldives</option>
                                            <option value="santorini">Santorini, Greece</option>
                                            <option value="borabora">Bora Bora</option>
                                            <option value="fiji">Fiji Islands</option>
                                            <option value="phuket">Phuket, Thailand</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t md:border-t-0 md:border-l border-gray-200 md:pl-4 pt-2 md:pt-0" data-aos="fade-up" data-aos-delay="1000" data-aos-anchor=".bg-white">
                                    <div class="mb-1">
                                        <label for="date-select" class="block text-sm font-medium text-gray-700">Date</label>
                                    </div>
                                    <div class="relative">
                                        <select id="date-select" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md appearance-none cursor-pointer">
                                            <option value="" selected disabled>Select your date</option>
                                            <option value="jun2025">June 2025</option>
                                            <option value="jul2025">July 2025</option>
                                            <option value="aug2025">August 2025</option>
                                            <option value="sep2025">September 2025</option>
                                            <option value="oct2025">October 2025</option>
                                            <option value="nov2025">November 2025</option>
                                            <option value="dec2025">December 2025</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div data-aos="fade-up" data-aos-delay="1200" data-aos-anchor=".bg-white">
                                    <button class="w-full h-full bg-blue-500 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md transition duration-150 ease-in-out cursor-pointer">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
