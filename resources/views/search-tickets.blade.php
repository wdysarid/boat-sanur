@extends('layouts.app')

@section('title', 'Search Results - E-Ticketing Boat Sanur')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Search Form Section -->
        <div class="bg-white shadow-sm border-b pt-20 md:pt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <form action="{{ route('search.tickets') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- From -->
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                From
                            </label>
                            <select name="from"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Sanur" {{ request('from') == 'Sanur' ? 'selected' : '' }}>Sanur</option>
                                <option value="Nusa Penida" {{ request('from') == 'Nusa Penida' ? 'selected' : '' }}>Nusa
                                    Penida</option>
                                <option value="Nusa Lembongan" {{ request('from') == 'Nusa Lembongan' ? 'selected' : '' }}>
                                    Nusa Lembongan</option>
                                <option value="Nusa Ceningan" {{ request('from') == 'Nusa Ceningan' ? 'selected' : '' }}>
                                    Nusa Ceningan</option>
                            </select>
                        </div>

                        <!-- To -->
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                To
                            </label>
                            <select name="to"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Nusa Penida" {{ request('to') == 'Nusa Penida' ? 'selected' : '' }}>Nusa
                                    Penida</option>
                                <option value="Sanur" {{ request('to') == 'Sanur' ? 'selected' : '' }}>Sanur</option>
                                <option value="Nusa Lembongan" {{ request('to') == 'Nusa Lembongan' ? 'selected' : '' }}>
                                    Nusa Lembongan</option>
                                <option value="Nusa Ceningan" {{ request('to') == 'Nusa Ceningan' ? 'selected' : '' }}>Nusa
                                    Ceningan</option>
                            </select>
                        </div>

                        <!-- Departure Date -->
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Departure
                            </label>
                            <input type="date" id="departure-date" name="departure_date"
                                value="{{ request('departure_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-700 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Results Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Available Boat Schedules</h2>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span
                                class="font-medium">{{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('l, d F Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="bg-blue-50 rounded-lg px-4 py-2 inline-block">
                            <span class="text-blue-800 font-medium">
                                {{ request('from', 'Sanur') }}
                                <svg class="w-4 h-4 mx-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                                {{ request('to', 'Nusa Penida') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($tickets) > 0)
                <!-- Ticket Results -->
                <div class="space-y-6">
                    @foreach ($tickets as $ticket)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <!-- Boat Info -->
                                    <div class="flex items-start mb-4 md:mb-0">
                                        <div class="relative">
                                            <img src="{{ $ticket['boat_image'] }}" alt="{{ $ticket['boat_name'] }}"
                                                class="w-20 h-20 rounded-lg object-cover mr-4 border border-gray-200">
                                            @if ($ticket['available_seats'] < 10)
                                                <div
                                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                    Few left
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $ticket['boat_name'] }}</h3>
                                            <div class="flex items-center mt-1 text-gray-600">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                @php
                                                    $date = \Carbon\Carbon::parse(
                                                        request('departure_date', date('Y-m-d')),
                                                    );
                                                    $departureTime = \Carbon\Carbon::parse(
                                                        $ticket['departure_time'],
                                                    )->format('H:i');
                                                    $arrivalTime = \Carbon\Carbon::parse(
                                                        $ticket['arrival_time'],
                                                    )->format('H:i');
                                                @endphp

                                                <span class="text-sm">
                                                    {{ $date->translatedFormat('l, d F Y') }} {{ $departureTime }} -
                                                    {{ $arrivalTime }} ({{ $ticket['duration'] }})
                                                </span>

                                            </div>
                                            <div class="mt-2">
                                                <span
                                                    class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                    {{ $ticket['available_seats'] }} seats available
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price and Action -->
                                    <div class="flex flex-col items-end">
                                        <div class="text-right mb-2">
                                            <p class="text-sm text-gray-500">Price</p>
                                            <p class="text-2xl font-bold text-blue-600">Rp
                                                {{ number_format($ticket['price'], 0, ',', '.') }}</p>
                                        </div>
                                        <a href="#"
                                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-sm">
                                            Select
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results Section -->
                <div class="text-center py-16 bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="max-w-md mx-auto">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                            <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-medium text-gray-900 mb-2">No schedules available</h3>
                        <p class="text-gray-500 mb-6">
                            We couldn't find any boat schedules matching your search criteria.
                            Please try adjusting your search parameters.
                        </p>

                        <a href="{{ route('search.tickets') }}?from={{ request('from') }}&to={{ request('to') }}&departure_date={{ request('departure_date') }}"
                            class="inline-flex items-center px-5 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                            <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Try Again
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Calendar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('departure-date');
            if (dateInput) {
                dateInput.addEventListener('click', function() {
                    this.showPicker();
                });
            }
        });
    </script>
@endpush
