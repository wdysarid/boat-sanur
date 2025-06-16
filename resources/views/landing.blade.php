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
                        class="h-30 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/wahana-gili.png') }}" alt="Wahana Gili Ocean"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Wahana Gili Ocean</text></svg>';">
                    </div>
                </div>

                <!-- Eka Jaya Fast Boat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <div
                        class="h-30  w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/ekajaya.png') }}" alt="Eka Jaya Fast Boat"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Eka Jaya Fast Boat</text></svg>';">
                    </div>
                </div>

                <!-- Scoot Fast Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
                    <div
                        class="h-30  w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/ganggari.png') }}" alt="Scoot Fast Cruises"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Scoot Fast Cruises</text></svg>';">
                    </div>
                </div>

                <!-- Bali Hai Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                    <div
                        class="h-30  w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/gili-fast.png') }}" alt="Bali Hai Cruises"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Bali Hai Cruises</text></svg>';">
                    </div>
                </div>

                <!-- BlueWater Express -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="600">
                    <div
                        class="h-30  w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/mahi-mahi.png') }}" alt="BlueWater Express"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>BlueWater Express</text></svg>';">
                    </div>
                </div>

                <!-- Gili Cat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600">
                    <div
                        class="h-30  w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/semaya-gili.png') }}" alt="Gili Cat"
                            class="max-h-full max-w-full object-contain"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Gili Cat</text></svg>';">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FIXED: Customer Testimonials Section with Infinite Loop Carousel -->
    <section id="testimonials" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">What Our Customers Say</h2>
                <p class="mt-3 text-base md:text-lg text-gray-600 max-w-3xl mx-auto font-light">
                    Read testimonials from our satisfied customers who have experienced our services
                </p>
            </div>

            <!-- Loading State -->
            <div id="testimonials-loading" class="text-center py-12">
                <div class="inline-flex items-center px-6 py-3 font-semibold leading-6 text-sm shadow-sm rounded-xl text-blue-600 bg-blue-50 border border-blue-100">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memuat testimoni pelanggan...
                </div>
            </div>

            <!-- Testimonials Carousel Container -->
            <div id="testimonials-container" class="hidden">
                <div class="relative overflow-hidden">
                    <!-- Carousel Track -->
                    <div id="testimonials-track" class="flex">
                        <!-- Testimonials will be loaded here dynamically -->
                    </div>

                    <!-- Navigation Arrows -->
                    <button id="prev-testimonial" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button id="next-testimonial" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

                <!-- Carousel Indicators -->
                <div id="testimonials-indicators" class="flex justify-center mt-8 space-x-2">
                    <!-- Indicators will be generated dynamically -->
                </div>
            </div>

            <!-- Empty State -->
            <div id="testimonials-empty" class="hidden text-center py-12">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada Testimoni</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Jadilah yang pertama memberikan testimoni tentang pengalaman perjalanan Anda bersama kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews & Rating Section -->
    <section id="feedback" class="py-16 bg-gray-50">
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
        // Testimonials Carousel Variables - UPDATED for infinite loop
        let testimonialsData = [];
        let currentTestimonialIndex = 0;
        let testimonialInterval;
        let testimonialsPerView = 3; // Default for desktop
        let isTransitioning = false;

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

        // Load Approved Testimonials
        async function loadTestimonials() {
            try {
                console.log('Loading testimonials...');
                const response = await fetch('/api/feedback/', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Testimonials data:', data);

                if (data.success && data.data && data.data.length > 0) {
                    testimonialsData = data.data;
                    renderTestimonials();
                    startInfiniteCarousel();
                } else {
                    showEmptyTestimonials();
                }
            } catch (error) {
                console.error('Error loading testimonials:', error);
                showEmptyTestimonials();
            } finally {
                document.getElementById('testimonials-loading').classList.add('hidden');
            }
        }

        // UPDATED: Render Testimonials for Infinite Loop
        function renderTestimonials() {
            const track = document.getElementById('testimonials-track');
            const indicators = document.getElementById('testimonials-indicators');

            // Clear existing content
            track.innerHTML = '';
            indicators.innerHTML = '';

            // Determine testimonials per view based on screen size
            updateTestimonialsPerView();

            // Create original testimonial cards
            testimonialsData.forEach((testimonial, index) => {
                const testimonialCard = createTestimonialCard(testimonial);
                track.appendChild(testimonialCard);
            });

            // UPDATED: Clone first few testimonials for infinite loop
            const cloneCount = testimonialsPerView;
            for (let i = 0; i < cloneCount; i++) {
                const testimonial = testimonialsData[i % testimonialsData.length];
                const clonedCard = createTestimonialCard(testimonial);
                clonedCard.classList.add('cloned');
                track.appendChild(clonedCard);
            }

            // Create indicators based on original testimonials only
            const totalSlides = Math.ceil(testimonialsData.length / testimonialsPerView);
            for (let i = 0; i < totalSlides; i++) {
                const indicator = document.createElement('button');
                indicator.className = `w-3 h-3 rounded-full transition-all duration-300 ${i === 0 ? 'bg-blue-600' : 'bg-gray-300'}`;
                indicator.addEventListener('click', () => goToSlide(i));
                indicators.appendChild(indicator);
            }

            // Show container
            document.getElementById('testimonials-container').classList.remove('hidden');

            // Setup navigation
            setupTestimonialNavigation();
        }

        // Create Testimonial Card
        function createTestimonialCard(testimonial) {
            const card = document.createElement('div');
            card.className = `flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-4`;

            const stars = generateStars(testimonial.rating);
            const initials = testimonial.user.nama.split(' ').map(n => n[0]).join('').toUpperCase();
            const formattedDate = new Date(testimonial.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            card.innerHTML = `
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full hover:shadow-md transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm mr-4">
                            ${initials}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">${testimonial.user.nama}</h3>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 mr-2">
                                    ${stars}
                                </div>
                                <span class="text-sm text-gray-500">${testimonial.rating}/5</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-4">
                        "${testimonial.pesan}"
                    </p>
                    <div class="text-xs text-gray-400">
                        ${formattedDate}
                    </div>
                </div>
            `;

            return card;
        }

        // Generate Stars
        function generateStars(rating) {
            let stars = '';
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;

            for (let i = 1; i <= 5; i++) {
                if (i <= fullStars) {
                    stars += `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>`;
                } else if (i === fullStars + 1 && hasHalfStar) {
                    stars += `<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <defs>
                            <linearGradient id="half-star-${rating}">
                                <stop offset="50%" stop-color="currentColor"/>
                                <stop offset="50%" stop-color="#d1d5db"/>
                            </linearGradient>
                        </defs>
                        <path fill="url(#half-star-${rating})" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>`;
                } else {
                    stars += `<svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>`;
                }
            }
            return stars;
        }

        // Update testimonials per view based on screen size
        function updateTestimonialsPerView() {
            if (window.innerWidth >= 1024) {
                testimonialsPerView = 3; // lg screens
            } else if (window.innerWidth >= 768) {
                testimonialsPerView = 2; // md screens
            } else {
                testimonialsPerView = 1; // sm screens
            }
        }

        // Setup Testimonial Navigation
        function setupTestimonialNavigation() {
            const prevBtn = document.getElementById('prev-testimonial');
            const nextBtn = document.getElementById('next-testimonial');

            prevBtn.addEventListener('click', () => {
                if (!isTransitioning) {
                    previousSlide();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (!isTransitioning) {
                    nextSlide();
                }
            });
        }

        // UPDATED: Infinite Loop Carousel Functions
        function nextSlide() {
            if (isTransitioning) return;

            isTransitioning = true;
            const track = document.getElementById('testimonials-track');
            const totalOriginalSlides = Math.ceil(testimonialsData.length / testimonialsPerView);

            currentTestimonialIndex++;

            // Apply transition
            track.style.transition = 'transform 0.5s ease-in-out';
            track.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;

            // Check if we've reached the cloned slides
            if (currentTestimonialIndex >= totalOriginalSlides) {
                setTimeout(() => {
                    // Reset to beginning without transition
                    track.style.transition = 'none';
                    currentTestimonialIndex = 0;
                    track.style.transform = `translateX(0%)`;

                    // Re-enable transitions after a brief delay
                    setTimeout(() => {
                        track.style.transition = 'transform 0.5s ease-in-out';
                        isTransitioning = false;
                    }, 50);
                }, 500);
            } else {
                setTimeout(() => {
                    isTransitioning = false;
                }, 500);
            }

            updateIndicators();
        }

        function previousSlide() {
            if (isTransitioning) return;

            isTransitioning = true;
            const track = document.getElementById('testimonials-track');
            const totalOriginalSlides = Math.ceil(testimonialsData.length / testimonialsPerView);

            if (currentTestimonialIndex <= 0) {
                // Jump to the end without transition
                track.style.transition = 'none';
                currentTestimonialIndex = totalOriginalSlides;
                track.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;

                // Then slide to the previous slide with transition
                setTimeout(() => {
                    track.style.transition = 'transform 0.5s ease-in-out';
                    currentTestimonialIndex--;
                    track.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;

                    setTimeout(() => {
                        isTransitioning = false;
                    }, 500);
                }, 50);
            } else {
                currentTestimonialIndex--;
                track.style.transition = 'transform 0.5s ease-in-out';
                track.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;

                setTimeout(() => {
                    isTransitioning = false;
                }, 500);
            }

            updateIndicators();
        }

        function goToSlide(index) {
            if (isTransitioning) return;

            isTransitioning = true;
            const track = document.getElementById('testimonials-track');

            currentTestimonialIndex = index;
            track.style.transition = 'transform 0.5s ease-in-out';
            track.style.transform = `translateX(-${currentTestimonialIndex * 100}%)`;

            setTimeout(() => {
                isTransitioning = false;
            }, 500);

            updateIndicators();
        }

        function updateIndicators() {
            const indicators = document.getElementById('testimonials-indicators').children;
            const totalOriginalSlides = Math.ceil(testimonialsData.length / testimonialsPerView);
            const activeIndex = currentTestimonialIndex % totalOriginalSlides;

            Array.from(indicators).forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.className = 'w-3 h-3 rounded-full transition-all duration-300 bg-blue-600';
                } else {
                    indicator.className = 'w-3 h-3 rounded-full transition-all duration-300 bg-gray-300';
                }
            });
        }

        // UPDATED: Start Infinite Carousel
        function startInfiniteCarousel() {
            testimonialInterval = setInterval(() => {
                nextSlide();
            }, 4000); // Move every 4 seconds
        }

        function stopTestimonialCarousel() {
            if (testimonialInterval) {
                clearInterval(testimonialInterval);
            }
        }

        // Show Empty State
        function showEmptyTestimonials() {
            document.getElementById('testimonials-empty').classList.remove('hidden');
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (testimonialsData.length > 0) {
                updateTestimonialsPerView();
                // Re-render testimonials for new screen size
                renderTestimonials();
                startInfiniteCarousel();
            }
        });

        // Pause carousel on hover
        document.addEventListener('DOMContentLoaded', function() {
            const testimonialsContainer = document.getElementById('testimonials-container');

            testimonialsContainer.addEventListener('mouseenter', stopTestimonialCarousel);
            testimonialsContainer.addEventListener('mouseleave', startInfiniteCarousel);

            // Load testimonials when page loads
            loadTestimonials();

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

    <style>
        /* Carousel Styles */
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* UPDATED: Infinite carousel styles */
        #testimonials-track {
            transition: transform 0.5s ease-in-out;
        }

        /* Hide scrollbar for carousel */
        #testimonials-container {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #testimonials-container::-webkit-scrollbar {
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #testimonials-track .flex-shrink-0 {
                width: 100% !important;
            }
        }

        @media (min-width: 769px) and (max-width: 1023px) {
            #testimonials-track .flex-shrink-0 {
                width: 50% !important;
            }
        }

        @media (min-width: 1024px) {
            #testimonials-track .flex-shrink-0 {
                width: 33.333333% !important;
            }
        }

        /* Smooth transition effects */
        #testimonials-track .flex-shrink-0 {
            transition: opacity 0.3s ease-in-out;
        }

        /* Indicator hover effects */
        #testimonials-indicators button:hover {
            transform: scale(1.2);
            background-color: #9ca3af;
        }

        /* Navigation button hover effects */
        #prev-testimonial:hover,
        #next-testimonial:hover {
            transform: translateY(-50%) scale(1.1);
        }

        /* Pause animation on hover for better control */
        #testimonials-container:hover #testimonials-track {
            animation-play-state: paused;
        }

        /* Ensure smooth infinite loop */
        #testimonials-track.no-transition {
            transition: none !important;
        }

        /* Loading animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #testimonials-container {
            animation: fadeIn 0.6s ease-out;
        }

        /* Testimonial card hover effects */
        #testimonials-track .bg-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Star rating animations */
        .star-btn:hover {
            transform: scale(1.1);
        }

        /* Responsive text sizing */
        @media (max-width: 640px) {
            .line-clamp-4 {
                -webkit-line-clamp: 3;
            }
        }
    </style>
@endsection
