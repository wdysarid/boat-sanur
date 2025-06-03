@extends('layouts.app')

@section('title', 'Search Results - E-Ticketing Boat Sanur')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Search Form Section -->
    <div class="bg-white shadow-sm border-b pt-20 md:pt-24">
        <!-- Container dengan max-width dan margin auto untuk center -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form action="#" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- From -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            From
                        </label>
                        <select name="from" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="sanur" {{ request('from') == 'sanur' ? 'selected' : '' }}>Sanur (Denpasar)</option>
                            <option value="nusa_penida" {{ request('from') == 'nusa_penida' ? 'selected' : '' }}>Nusa Penida</option>
                            <option value="gili_trawangan" {{ request('from') == 'gili_trawangan' ? 'selected' : '' }}>Gili Trawangan</option>
                            <option value="lombok" {{ request('from') == 'lombok' ? 'selected' : '' }}>Lombok</option>
                        </select>
                    </div>

                    <!-- To -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            To
                        </label>
                        <select name="to" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="nusa_penida" {{ request('to') == 'nusa_penida' ? 'selected' : '' }}>Nusa Penida</option>
                            <option value="sanur" {{ request('to') == 'sanur' ? 'selected' : '' }}>Sanur (Denpasar)</option>
                            <option value="gili_trawangan" {{ request('to') == 'gili_trawangan' ? 'selected' : '' }}>Gili Trawangan</option>
                            <option value="lombok" {{ request('to') == 'lombok' ? 'selected' : '' }}>Lombok</option>
                        </select>
                    </div>

                    <!-- Type -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            Type
                        </label>
                        <select name="passenger_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="foreign" {{ request('passenger_type') == 'foreign' ? 'selected' : '' }}>Foreign</option>
                            <option value="domestic" {{ request('passenger_type') == 'domestic' ? 'selected' : '' }}>Domestic</option>
                        </select>
                    </div>

                    <!-- Passenger Count -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600">Passenger</label>
                        <select name="passenger_count" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('passenger_count', 1) == $i ? 'selected' : '' }}>
                                    {{ $i }} person{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <!-- Departure Date -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Departure
                        </label>
                        <input type="date"
                               id="departure-date"
                               name="departure_date"
                               value="{{ request('departure_date', date('Y-m-d')) }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 uppercase tracking-wide shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Search</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(isset($tickets) && count($tickets) > 0)
            <!-- Results Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Choose Departure</h2>
                <p class="text-blue-100">
                    {{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('d M, Y') }}
                </p>
                <p class="text-blue-100">
                    {{ ucfirst(str_replace('_', ' ', request('from', 'sanur'))) }}
                    <span class="mx-2">→</span>
                    {{ ucfirst(str_replace('_', ' ', request('to', 'nusa_penida'))) }}
                </p>
            </div>

            <!-- Ticket Results -->
            <div class="space-y-4">
                @foreach($tickets ?? [] as $ticket)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="flex flex-col lg:flex-row">
                            <!-- Boat Image -->
                            <div class="lg:w-64 h-48 lg:h-auto">
                                <img src="{{ $ticket['image'] ?? '/images/boats/default-boat.jpg' }}"
                                     alt="{{ $ticket['boat_name'] ?? 'Fast Boat' }}"
                                     class="w-full h-full object-cover">
                            </div>

                            <!-- Ticket Details -->
                            <div class="flex-1 p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <!-- Boat Name -->
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                            {{ $ticket['boat_name'] ?? 'Semabu Hills Fast Boat' }}
                                        </h3>

                                        <!-- Time and Route -->
                                        <div class="flex items-center space-x-6 mb-4">
                                            <div class="text-center">
                                                <div class="text-xl font-bold text-gray-900">
                                                    {{ $ticket['departure_time'] ?? '06:30' }}
                                                </div>
                                                <div class="text-sm text-blue-600 flex items-center justify-center">
                                                    <span>{{ $ticket['departure_port'] ?? 'Sanur (Denpasar)' }}</span>
                                                    <svg class="w-3 h-3 ml-1 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Port Information">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="flex-1 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                                </svg>
                                            </div>

                                            <div class="text-center">
                                                <div class="text-xl font-bold text-gray-900">
                                                    {{ $ticket['arrival_time'] ?? '07:15' }}
                                                </div>
                                                <div class="text-sm text-blue-600 flex items-center justify-center">
                                                    <span>{{ $ticket['arrival_port'] ?? 'Banjar Nyuh' }}</span>
                                                    <svg class="w-3 h-3 ml-1 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Port Information">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Duration -->
                                        <div class="text-sm text-gray-500 mb-4 text-center">
                                            Duration: {{ $ticket['duration'] ?? '45 minutes' }}
                                        </div>

                                        <!-- Amenities -->
                                        <div class="flex items-center justify-center space-x-3 mb-4">
                                            @if($ticket['has_ac'] ?? true)
                                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center" title="Air Conditioning">
                                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($ticket['has_luggage'] ?? true)
                                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center" title="Luggage Storage">
                                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($ticket['has_life_jacket'] ?? true)
                                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center" title="Life Jacket">
                                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a3 3 0 01-3-3V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($ticket['has_insurance'] ?? true)
                                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center" title="Insurance">
                                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Detail & Policy Link -->
                                        <div class="text-center">
                                            <button type="button"
                                                    onclick="showTicketDetails({{ $ticket['id'] ?? 1 }})"
                                                    class="text-blue-600 hover:text-blue-800 text-sm flex items-center justify-center mx-auto">
                                                <span>Detail & policy</span>
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Price and Button -->
                                    <div class="mt-6 lg:mt-0 lg:ml-6 text-center lg:text-right">
                                        <div class="mb-4">
                                            <div class="text-sm text-gray-600 mb-1">
                                                {{ request('passenger_type') == 'foreign' ? 'Foreign' : 'Domestic' }} Price
                                            </div>
                                            <div class="text-2xl font-bold text-gray-900">
                                                Rp. {{ number_format($ticket['price'] ?? 145000, 0, ',', '.') }}
                                            </div>
                                            @if(request('passenger_count', 1) > 1)
                                                <div class="text-xs text-gray-500">
                                                    per person ({{ request('passenger_count', 1) }} passengers)
                                                </div>
                                            @endif
                                        </div>

                                        <form action="#" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $ticket['id'] ?? 1 }}">
                                            <input type="hidden" name="departure_date" value="{{ request('departure_date') }}">
                                            <input type="hidden" name="passenger_count" value="{{ request('passenger_count', 1) }}">
                                            <input type="hidden" name="passenger_type" value="{{ request('passenger_type') }}">
                                            <input type="hidden" name="from" value="{{ request('from') }}">
                                            <input type="hidden" name="to" value="{{ request('to') }}">

                                            <button type="submit"
                                                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-md transition duration-200 w-full lg:w-auto uppercase">
                                                Choose Departure
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <!-- No Results Section -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <!-- No Results Icon -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mb-2">No tickets found</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Sorry, we couldn't find any tickets for your search criteria. Please try different dates or routes.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">


                        <a href="#"
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="mr-2 -ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            New Search
                        </a>
                    </div>
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

    // Modal functions
    function showTicketDetails(ticketId) {
        // You can fetch ticket details via AJAX here if needed
        document.getElementById('ticketDetailsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeTicketDetails() {
        document.getElementById('ticketDetailsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
