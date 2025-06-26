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
                            <select name="from" id="from-select"
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
                                        d="M15 11a3 3 0 11-6 0 3 3 0 616 0z" />
                                </svg>
                                To
                            </label>
                            <select name="to" id="to-select"
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

                    <!-- Search Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-end">
                        <!-- Show All Button -->
                        <a href="{{ route('search.tickets') }}?show_all=1&departure_date={{ request('departure_date', date('Y-m-d')) }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span>Show All</span>
                        </a>

                        <!-- Search Button -->
                        <button type="submit"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center justify-center space-x-2">
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

        @if (request()->hasAny(['from', 'to', 'departure_date', 'show_all']))
            <!-- Search Results Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Results Header -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 border border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            @if (isset($showAll) && $showAll)
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">All Available Tickets</h2>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('l, d F Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Showing all available routes</p>
                            @else
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">Available Boat Schedules</h2>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('l, d F Y') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 md:mt-0">
                            @if (isset($showAll) && $showAll)
                                <div class="bg-green-50 rounded-lg px-4 py-2 inline-block">
                                    <span class="text-green-800 font-medium">All Routes</span>
                                </div>
                            @else
                                <div class="bg-blue-50 rounded-lg px-4 py-2 inline-block">
                                    <span class="text-blue-800 font-medium">
                                        {{ request('from', 'Sanur') }}
                                        <svg class="w-4 h-4 mx-1 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        {{ request('to', 'Nusa Penida') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $displayTickets = $tickets;
                    if (isset($noResultsFound) && $noResultsFound && isset($allTickets) && $allTickets->isNotEmpty()) {
                        $displayTickets = $allTickets;
                    }
                @endphp

                @if (count($displayTickets) > 0)
                    @if (isset($noResultsFound) && $noResultsFound && isset($allTickets) && $allTickets->isNotEmpty())
                        <!-- No specific results, showing all -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="text-yellow-800 font-medium">No direct routes found</h3>
                                    <p class="text-yellow-700 text-sm">We couldn't find direct routes for
                                        {{ request('from') }} to {{ request('to') }}, but here are all available tickets
                                        for {{ \Carbon\Carbon::parse(request('departure_date'))->format('d F Y') }}:</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Ticket Results -->
                    <div class="space-y-6">
                        @foreach ($displayTickets as $ticket)
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                                        <!-- Boat Info -->
                                        <div class="flex items-start mb-4 md:mb-0">
                                            <div class="relative">
                                                @if (!empty($ticket['boat_image']) && $ticket['boat_image'] !== '/images/boats/default-boat.jpg')
                                                    <img src="{{ $ticket['boat_image'] }}"
                                                        alt="{{ $ticket['boat_name'] }}"
                                                        class="w-20 h-20 rounded-lg object-cover mr-4 border border-gray-200">
                                                @else
                                                    <div
                                                        class="w-20 h-20 rounded-lg bg-gray-200 flex items-center justify-center mr-4 border border-gray-200">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                @if ($ticket['available_seats'] < 1)
                                                    <div
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                        Full
                                                    </div>
                                                @elseif ($ticket['available_seats'] < 10)
                                                    <div
                                                        class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                        Few left
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-800">{{ $ticket['boat_name'] }}
                                                </h3>

                                                <!-- Route Info -->
                                                <div class="flex items-center mt-1 text-gray-600">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    </svg>
                                                    <span class="text-sm font-medium">
                                                        {{ $ticket['departure_port'] }}
                                                        <svg class="w-3 h-3 mx-1 inline" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                        </svg>
                                                        {{ $ticket['arrival_port'] }}
                                                    </span>
                                                </div>

                                                <!-- Time Info -->
                                                <div class="flex items-center mt-1 text-gray-600">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
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
                                                        {{ $departureTime }} - {{ $arrivalTime }}
                                                        ({{ $ticket['duration'] }})
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
                                            @if ($ticket['available_seats'] > 0)
                                                <a href="{{ route('wisatawan.pemesanan', [
                                                    'jadwal_id' => $ticket['id'],
                                                    'from' => $ticket['departure_port'],
                                                    'to' => $ticket['arrival_port'],
                                                    'departure_date' => request('departure_date'),
                                                    'passenger_count' => 1,
                                                    'passenger_type' => 'domestic',
                                                ]) }}"
                                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-sm">
                                                    Select
                                                </a>
                                            @else
                                                <button type="button" onclick="showSoldOutModal()"
                                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-400 cursor-not-allowed transition duration-150 ease-in-out shadow-sm">
                                                    Select
                                                </button>
                                            @endif
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
                                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            @if (isset($showAll) && $showAll)
                                <h3 class="text-xl font-medium text-gray-900 mb-2">No tickets available</h3>
                                <p class="text-gray-500 mb-6">
                                    There are no boat schedules available for the selected date.
                                    Please try selecting a different date.
                                </p>
                            @else
                                <h3 class="text-xl font-medium text-gray-900 mb-2">No schedules available</h3>
                                <p class="text-gray-500 mb-6">
                                    We couldn't find any boat schedules matching your search criteria.
                                    Please try adjusting your search parameters or view all available tickets.
                                </p>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                @if (!isset($showAll) || !$showAll)
                                    <a href="{{ route('search.tickets') }}?show_all=1&departure_date={{ request('departure_date', date('Y-m-d')) }}"
                                        class="inline-flex items-center px-5 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        View All Available Tickets
                                    </a>
                                @endif

                                <a href="{{ route('search.tickets') }}"
                                    class="inline-flex items-center px-5 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                                    <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Try Different Search
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Modal Tiket Habis -->
    <div id="soldOutModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Ticket Sold Out</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Sorry, this ticket is no longer available as it has been
                                    sold out. Please try another schedule.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeSoldOutModal()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        OK
                    </button>
                </div>
            </div>
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

        // Show all tickets function
        function showAllTickets() {
            const departureDate = document.getElementById('departure-date').value || '{{ date('Y-m-d') }}';
            const url = '{{ route('search.tickets') }}?show_all=1&departure_date=' + encodeURIComponent(departureDate);
            window.location.href = url;
        }

        function showSoldOutModal() {
            const modal = document.getElementById('soldOutModal');
            modal.classList.remove('hidden');
            modal.style.display = 'block';
        }

        function closeSoldOutModal() {
            const modal = document.getElementById('soldOutModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('soldOutModal');
            if (event.target === modal) {
                closeSoldOutModal();
            }
        });
    </script>
@endpush
