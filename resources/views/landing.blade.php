@extends('layouts.app')

@section('content')
    @include('partials.user.header')

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
                        Experience a safe, comfortable, and scenic sea journey with Sanur Boat, your gateway to Bali's most beautiful nearby islands.
                        Inspired by a passion for exploration and a love for island life,
                        Sanur Boat was created to connect travelers with hidden paradises like Nusa Penida, Nusa Lembongan, and the Gili Islands.
                        With reliable schedules and trusted local partners, Sanur Boat makes it easy to discover the beauty beyond Bali.
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
                    <div class="absolute inset-0 bg-blue-100 rounded-2xl -rotate-2 float-animation" style="animation-delay: 0.5s"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                             alt="DreamIslands Founders"
                             class="w-full h-auto object-cover">
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
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
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
                            Experience the breathtaking views of this hidden gem with crystal clear waters and pristine white sand beaches. A true paradise for nature lovers.
                        </p>
                    </div>
                </div>

                <!-- Destination Card 2 -->
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
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
                            Discover the perfect combination of rocky cliffs and turquoise waters. This secluded beach offers a peaceful escape from the everyday hustle.
                        </p>
                    </div>
                </div>

                <!-- Destination Card 3 -->
                <div class="relative rounded-2xl overflow-hidden h-[500px] group" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
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
                            Explore the natural rock formations and stunning ocean views. This unique beach destination offers unforgettable experiences for adventurous travelers.
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
                         alt="Luxury boat"
                         class="rounded-lg shadow-lg w-full h-auto">
                </div>

                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
                    <p class="text-base text-gray-600 mb-8 font-light">
                        We provide exceptional travel experiences with attention to detail and personalized service.
                    </p>

                    <div class="space-y-6">
                        <div class="flex" data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Handpicked Destinations</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600 font-light">
                                    We carefully select the most beautiful and unique destinations for an unforgettable experience.
                                </p>
                            </div>
                        </div>

                        <div class="flex" data-aos="fade-up" data-aos-delay="400" data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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

                        <div class="flex" data-aos="fade-up" data-aos-delay="500" data-aos-anchor-placement="top-bottom">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">24/7 Support</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600 font-light">
                                    Our dedicated support team is available around the clock to assist you with any questions or concerns.
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
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/wahana-gili.png') }}" alt="Wahana Gili Ocean" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Wahana Gili Ocean</text></svg>';">
                    </div>
                </div>

                <!-- Eka Jaya Fast Boat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/eka-jaya.png') }}" alt="Eka Jaya Fast Boat" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Eka Jaya Fast Boat</text></svg>';">
                    </div>
                </div>

                <!-- Scoot Fast Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/scoot-fast.png') }}" alt="Scoot Fast Cruises" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Scoot Fast Cruises</text></svg>';">
                    </div>
                </div>

                <!-- Bali Hai Cruises -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/bali-hai.png') }}" alt="Bali Hai Cruises" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Bali Hai Cruises</text></svg>';">
                    </div>
                </div>

                <!-- BlueWater Express -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="600">
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/bluewater.png') }}" alt="BlueWater Express" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>BlueWater Express</text></svg>';">
                    </div>
                </div>

                <!-- Gili Cat -->
                <div class="flex justify-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600">
                    <div class="h-16 w-full max-w-[140px] bg-white rounded-lg shadow-sm p-3 flex items-center justify-center hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('images/partners/gili-cat.png') }}" alt="Gili Cat" class="max-h-full max-w-full object-contain" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 40\'><rect width=\'100\' height=\'40\' fill=\'%23f3f4f6\'/><text x=\'50\' y=\'25\' font-family=\'Arial\' font-size=\'10\' text-anchor=\'middle\' fill=\'%236b7280\'>Gili Cat</text></svg>';">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">What Our Customers Say</h2>
                <p class="mt-3 text-base md:text-lg text-gray-600 max-w-3xl mx-auto font-light">
                    Read testimonials from our satisfied customers who have experienced our services
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-medium">JD</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">John Doe</h3>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base font-light">
                        "Our trip to Bali was absolutely perfect! The accommodations were luxurious, and the itinerary was well-planned. I can't wait to book my next adventure with DreamIslands."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-medium">JS</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Jane Smith</h3>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base font-light">
                        "The Maldives vacation exceeded all my expectations. The staff was incredibly attentive, and the overwater bungalow was a dream come true. Highly recommend DreamIslands!"
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-medium">RJ</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Robert Johnson</h3>
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base font-light">
                        "Santorini was magical! The views were breathtaking, and the local experiences arranged by DreamIslands were authentic and memorable. The customer service was top-notch."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Form Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                    <p class="mt-3 text-base md:text-lg text-gray-600 font-light">
                        Have questions or feedback? We'd love to hear from you.
                    </p>
                </div>

                <form class="space-y-6" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1">
                            <input id="name" name="name" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
