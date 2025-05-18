@ -1,14 +1,50 @@
@extends('layouts.app')

@section('content')
    <!-- DESTINATIONS -->
    <section class="py-16 bg-white px-6" id="destinations">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-10">Explore Top Destinations</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach (['Island Paradise', 'Sunset Bay', 'Adventure Coast'] as $i => $place)
                    <div
                        class="bg-blue-50 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 opacity-0 translate-y-6 animate-fade-up delay-[{{ $i * 100 }}ms]">
                        <img src="https://via.placeholder.com/300x200" class="rounded-lg mb-4 w-full"
                            alt="{{ $place }}">
                        <h3 class="text-xl font-semibold">{{ $place }}</h3>
                        <p class="text-gray-600 mt-2">Enjoy stunning views and a relaxing journey.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- BOOKING -->
    <section class="py-16 px-6 bg-gray-50" id="booking">
        <div class="max-w-xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-center">Book Your Ticket</h2>
            <form action="#" method="POST" class="space-y-4 bg-white p-6 rounded-xl shadow-md">
                <div>
                    <label class="block mb-1 font-medium" for="fullname">Full Name</label>
                    <input id="fullname" name="fullname" type="text"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring" placeholder="Your name"
                        required>
                </div>
                <div>
                    <label class="block mb-1 font-medium" for="destination">Destination</label>
                    <select id="destination" name="destination"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring" required>
                        <option value="">Select a destination</option>
                        <option value="Island Paradise">Island Paradise</option>
                        <option value="Sunset Bay">Sunset Bay</option>
                        <option value="Adventure Coast">Adventure Coast</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium" for="travel_date">Travel Date</label>
                    <input id="travel_date" name="travel_date" type="date"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                    Book Ticket
                </button>
            </form>
        </div>
    </section>
@endsection
