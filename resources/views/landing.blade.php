@extends('layouts.app')

@section('content')
    @include('partials.user.header')

    <!-- Modal Notification -->
    <div id="notificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div id="modalIcon" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4">
                    <!-- Icon will be inserted here -->
                </div>
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900 mb-2"></h3>
                <div class="mt-2 px-7 py-3">
                    <p id="modalMessage" class="text-sm text-gray-500"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="modalCloseBtn" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors duration-200">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <section id="about-us" class="relative py-16 bg-white pt-20 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-blue-500 font-medium mb-2">About Us</div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Sanur Boat Pass
                    </h2>

                    <p class="text-gray-600 mb-8 text-base md:text-lg">
                        Experience a safe, comfortable, and scenic sea journey with Sanur Boat, your gateway to Bali's most
                        beautiful nearby islands.
                        Inspired by a passion for exploration and a love for island life,
                        Sanur Boat was created to connect travelers with hidden paradises like Nusa Penida, Nusa Lembongan,
                        and the Gili Islands.
                        With reliable schedules and trusted local partners, Sanur Boat makes it easy to discover the beauty
                        beyond Bali.
                    </p>

                    <div class="grid grid-cols-2 gap-8 mt-10">
                        <div data-aos="fade-up" data-aos-delay="200" data-aos-anchor-placement="top-bottom">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600">7.5</div>
                            <div class="text-gray-600 mt-1">Years Experience</div>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600">42</div>
                            <div class="text-gray-600 mt-1">Island Destinations</div>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="400" data-aos-anchor-placement="top-bottom">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600">15K+</div>
                            <div class="text-gray-600 mt-1">Happy Travelers</div>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="500" data-aos-anchor-placement="top-bottom">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600">98%</div>
                            <div class="text-gray-600 mt-1">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                    <div class="absolute inset-0 bg-blue-200 rounded-2xl transform rotate-3 float-animation"></div>
                    <div class="absolute inset-0 bg-blue-100 rounded-2xl -rotate-2 float-animation"
                        style="animation-delay: 0.5s"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                            alt="DreamIslands Founders" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore Destination Section -->
    <section id="destinations" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Explore Destinations</h2>
                <p class="mt-3 text-base md:text-lg text-gray-600 max-w-3xl mx-auto font-light">
                    Discover the most beautiful islands and beaches around the world
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Destination Card 1 -->
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="800">
                    <img src="https://images.unsplash.com/photo-1573790387438-4da905039392?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Paradise Island"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/70"></div>

                    <div class="absolute top-4 left-4">
                        <div class="px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                            <span class="text-white font-medium text-sm">Kelingking Beach</span>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-2">Paradise Island</h3>
                        <p class="text-white/90 text-sm md:text-base font-light">
                            Experience the breathtaking views of this hidden gem with crystal clear waters and pristine
                            white sand beaches. A true paradise for nature lovers.
                        </p>
                    </div>
                </div>

                <!-- Destination Card 2 -->
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="200"
                    data-aos-duration="800">
                    <img src="https://images.unsplash.com/photo-1586861635167-e5223aadc9fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                        alt="Dream Beach"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/70"></div>

                    <div class="absolute top-4 left-4">
                        <div class="px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                            <span class="text-white font-medium text-sm">Angel's Billabongs</span>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-2">Dream Beach</h3>
                        <p class="text-white/90 text-sm md:text-base font-light">
                            Discover the perfect combination of rocky cliffs and turquoise waters. This secluded beach
                            offers a peaceful escape from the everyday hustle.
                        </p>
                    </div>
                </div>

                <!-- Destination Card 3 -->
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="300"
                    data-aos-duration="800">
                    <img src="https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80"
                        alt="Broken Beach"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/70"></div>

                    <div class="absolute top-4 left-4">
                        <div class="px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                            <span class="text-white font-medium text-sm">Angel's Billabongs</span>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-2">Dream Beach</h3>
                        <p class="text-white/90 text-sm md:text-base font-light">
                            Explore the natural rock formations and stunning ocean views. This unique beach destination
                            offers unforgettable experiences for adventurous travelers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <img src="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2072&q=80"
                        alt="Luxury boat" class="rounded-lg shadow-lg w-full h-auto">
                </div>

                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
                    <p class="text-base text-gray-600 mb-8 font-light">
                        We provide exceptional travel experiences with attention to detail and personalized service.
                    </p>

                    <div class="space-y-6">
                        <div class="flex" data-aos="fade-up" data-aos-delay="300"
                            data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Handpicked Destinations</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600 font-light">
                                    We carefully select the most beautiful and unique destinations for an unforgettable
                                    experience.
                                </p>
                            </div>
                        </div>

                        <div class="flex" data-aos="fade-up" data-aos-delay="400"
                            data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Best Price Guarantee</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600 font-light">
                                    We offer competitive prices and will match any comparable offer you find elsewhere.
                                </p>
                            </div>
                        </div>

                        <div class="flex" data-aos="fade-up" data-aos-delay="500"
                            data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">24/7 Support</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600 font-light">
                                    Our dedicated support team is available around the clock to assist you with any
                                    questions or concerns.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Logos Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
                <!-- Wahana Gili Ocean -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/wahana-gili.png') }}" alt="Wahana Gili Ocean"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Wahana Gili Ocean</text></svg>';">
                    </div>
                </div>

                <!-- Eka Jaya Fast Boat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/eka-jaya.png') }}" alt="Eka Jaya Fast Boat"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Eka Jaya Fast Boat</text></svg>';">
                    </div>
                </div>

                <!-- Scoot Fast Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/scoot-fast.png') }}" alt="Scoot Fast Cruises"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Scoot Fast Cruises</text></svg>';">
                    </div>
                </div>

                <!-- Bali Hai Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/bali-hai.png') }}" alt="Bali Hai Cruises"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Bali Hai Cruises</text></svg>';">
                    </div>
                </div>

                <!-- BlueWater Express -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/bluewater.png') }}" alt="BlueWater Express"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>BlueWater Express</text></svg>';">
                    </div>
                </div>

                <!-- Gili Cat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600">
                    <div
                        class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/gili-cat.png') }}" alt="Gili Cat"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Gili Cat</text></svg>';">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="feedback" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">What Our Customers Say</h2>
                <p class="mt-3 text-base md:text-lg text-gray-600 max-w-3xl mx-auto font-light">
                    Read testimonials from our satisfied customers who have experienced our services
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="100"
                    data-aos-duration="800">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-medium">JD</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">John Doe</h3>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base font-light">
                        "Our trip to Bali was absolutely perfect! The accommodations were luxurious, and the itinerary was
                        well-planned. I can't wait to book my next adventure with DreamIslands."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews & Rating Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Share Your Experience</h2>
                    <p class="mt-3 text-base md:text-lg text-gray-600 font-light">
                        Help other travelers by sharing your boat trip experience.
                    </p>
                </div>

                <!-- Universal Feedback Form -->
                <form action="{{ route('wisatawan.feedback.tambah') }}" method="POST" class="space-y-6"
                    data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" id="review-form">
                    @csrf

                    <!-- Star Rating -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Rate Your Experience</label>
                        <div class="flex items-center space-x-1" id="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                    class="star-btn text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                                    data-rating="{{ $i }}">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <div class="mt-2">
                            <span id="rating-text" class="text-sm text-gray-500">Click stars to rate</span>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="{{ old('rating', 0) }}">
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Review Message -->
                    <div>
                        <label for="pesan" class="block text-sm font-medium text-gray-700">Your Review</label>
                        <div class="mt-1">
                            <textarea id="pesan" name="pesan" rows="4"
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                placeholder="Share your experience with other travelers...">{{ old('pesan') }}</textarea>
                        </div>
                        @error('pesan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dynamic Submit Button -->
                    <div data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom">
                        @auth
                            <!-- User sudah login - tombol submit biasa -->
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Submit Review
                            </button>
                        @else
                            <!-- User belum login - tombol login dan submit -->
                            <div class="space-y-3">
                                <button type="button" id="loginAndSubmitBtn"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Login & Submit Review
                                </button>
                                <p class="text-sm text-gray-500 text-center">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}?intended={{ urlencode(url()->current() . '#feedback') }}"
                                        class="text-blue-600 hover:text-blue-700 font-medium">Daftar di sini</a>
                                </p>
                            </div>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Modal Functions
        function showNotificationModal(type, title, message) {
            const modal = document.getElementById('notificationModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalCloseBtn = document.getElementById('modalCloseBtn');

            // Set icon and colors based on type
            let iconHTML = '';
            let iconBgColor = '';
            let buttonColor = '';

            switch(type) {
                case 'success':
                    iconHTML = `
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    `;
                    iconBgColor = 'bg-green-100';
                    modalIcon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4 bg-green-500';
                    buttonColor = 'bg-green-500 hover:bg-green-700 focus:ring-green-300';
                    break;
                case 'error':
                    iconHTML = `
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    `;
                    iconBgColor = 'bg-red-100';
                    modalIcon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4 bg-red-500';
                    buttonColor = 'bg-red-500 hover:bg-red-700 focus:ring-red-300';
                    break;
                case 'info':
                default:
                    iconHTML = `
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    `;
                    iconBgColor = 'bg-blue-100';
                    modalIcon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4 bg-blue-500';
                    buttonColor = 'bg-blue-500 hover:bg-blue-700 focus:ring-blue-300';
                    break;
            }

            modalIcon.innerHTML = iconHTML;
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modalCloseBtn.className = `px-4 py-2 text-white text-base font-medium rounded-md w-full shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 ${buttonColor}`;

            modal.classList.remove('hidden');

            // Auto close after 5 seconds for success messages
            if (type === 'success') {
                setTimeout(() => {
                    closeNotificationModal();
                }, 5000);
            }
        }

        function closeNotificationModal() {
            const modal = document.getElementById('notificationModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside or on close button
        document.getElementById('notificationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeNotificationModal();
            }
        });

        document.getElementById('modalCloseBtn').addEventListener('click', closeNotificationModal);

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotificationModal();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Update rating display
            function updateRatingDisplay(rating) {
                const ratingTexts = {
                    1: 'Poor - Very disappointed',
                    2: 'Fair - Below expectations',
                    3: 'Good - Met expectations',
                    4: 'Very Good - Exceeded expectations',
                    5: 'Excellent - Outstanding experience!'
                };

                document.getElementById('rating-value').value = rating;
                document.getElementById('rating-text').textContent = ratingTexts[rating];

                // Update star colors
                const starButtons = document.querySelectorAll('#star-rating .star-btn');
                starButtons.forEach((star, starIndex) => {
                    if (starIndex < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            // Star rating functionality
            const starButtons = document.querySelectorAll('#star-rating .star-btn');
            starButtons.forEach((button) => {
                button.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    updateRatingDisplay(rating);
                });

                // Hover effect
                button.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.dataset.rating);
                    starButtons.forEach((star, starIndex) => {
                        if (starIndex < rating) {
                            star.classList.add('text-yellow-300');
                        }
                    });
                });

                button.addEventListener('mouseleave', function() {
                    starButtons.forEach(star => {
                        star.classList.remove('text-yellow-300');
                    });
                });
            });

            // Function to restore form data from localStorage
            function restoreFormData() {
                console.log('Attempting to restore form data...');

                // Check localStorage for saved data
                const savedData = localStorage.getItem('pendingReview');
                console.log('Saved data from localStorage:', savedData);

                if (savedData) {
                    try {
                        const formData = JSON.parse(savedData);
                        console.log('Parsed form data:', formData);

                        // Restore rating
                        if (formData.rating && formData.rating !== '0' && formData.rating > 0) {
                            console.log('Restoring rating:', formData.rating);
                            updateRatingDisplay(parseInt(formData.rating));
                        }

                        // Restore message
                        if (formData.pesan && formData.pesan.trim() !== '') {
                            console.log('Restoring message:', formData.pesan);
                            const pesanField = document.getElementById('pesan');
                            if (pesanField) {
                                pesanField.value = formData.pesan;
                            }
                        }

                        // Clear localStorage after restoring
                        localStorage.removeItem('pendingReview');
                        console.log('Form data restored and localStorage cleared');

                        // Show notification that data was restored
                        showNotificationModal('info', 'Data Dipulihkan', 'Data review Anda telah dipulihkan. Silakan lanjutkan untuk mengirim review.');

                    } catch (error) {
                        console.error('Error parsing saved form data:', error);
                        localStorage.removeItem('pendingReview');
                    }
                }
            }

            @auth
            // Form validation for logged in users
            document.getElementById('review-form').addEventListener('submit', function(e) {
                const rating = document.getElementById('rating-value').value;

                if (rating === '0') {
                    e.preventDefault();
                    showNotificationModal('error', 'Rating Diperlukan', 'Silakan berikan rating sebelum mengirim review Anda.');
                    return false;
                }

                return true;
            });

            // Restore form data from session (Laravel old input)
            const oldRating = {{ old('rating', 0) }};
            const oldPesan = `{{ old('pesan', '') }}`;

            console.log('Laravel old rating:', oldRating);
            console.log('Laravel old pesan:', oldPesan);

            if (oldRating > 0) {
                updateRatingDisplay(oldRating);
            } else {
                // If no Laravel old data, try to restore from localStorage
                restoreFormData();
            }

            if (oldPesan.trim() !== '') {
                document.getElementById('pesan').value = oldPesan;
            }
            @else
            // Handle login and submit for non-authenticated users
            const loginBtn = document.getElementById('loginAndSubmitBtn');
            if (loginBtn) {
                loginBtn.addEventListener('click', function() {
                    const rating = document.getElementById('rating-value').value;
                    const pesan = document.getElementById('pesan').value;

                    console.log('Saving form data before login:', { rating, pesan });

                    // Save form data to localStorage before redirecting to login
                    const formData = {
                        rating: rating,
                        pesan: pesan
                    };
                    localStorage.setItem('pendingReview', JSON.stringify(formData));
                    console.log('Form data saved to localStorage');

                    // Redirect to login with intended URL
                    window.location.href = "{{ route('login') }}?intended={{ urlencode(url()->current() . '#feedback') }}";
                });
            }

            // Try to restore form data when page loads (for users who just logged in)
            restoreFormData();
            @endauth

            // Auto scroll to feedback section if hash is present
            if (window.location.hash === '#feedback') {
                setTimeout(() => {
                    document.getElementById('feedback').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 500);
            }

            // Show success/error messages using modal instead of alert
            @if(session('success'))
                showNotificationModal('success', 'Berhasil!', '{{ session('success') }}');
            @endif

            @if(session('error'))
                showNotificationModal('error', 'Terjadi Kesalahan', '{{ session('error') }}');
            @endif

            @if($errors->any())
                let errorMessages = [];
                @foreach($errors->all() as $error)
                    errorMessages.push('{{ $error }}');
                @endforeach
                showNotificationModal('error', 'Validasi Error', errorMessages.join('\n'));
            @endif
        });
    </script>
@endsection
