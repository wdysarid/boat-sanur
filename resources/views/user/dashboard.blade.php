@extends('layouts.app')

@section('title', 'My Dashboard - E-Ticketing Boat Sanur')

@section('content')
<!-- Navbar -->
<nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="SanurBoat Logo" class="h-10 w-auto mr-2">
                    <a href="/" class="text-blue-600 font-bold text-xl">SanurBoat</a>
                </div>
            </div>

            <!-- Navigation Links (Right Side) -->
            <div class="flex items-center">
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                    <a href="#" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="{{ route('user.dashboard') }}" class="bg-blue-50 text-blue-600 px-3 py-2 rounded-md text-sm font-medium">My Dashboard</a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            <span>{{ Auth::user()->name ?? 'User' }}</span>
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="min-h-screen bg-gray-50 pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">My Dashboard</h1>
            <p class="mt-1 text-sm text-gray-600">Manage your tickets and bookings</p>
        </div>

        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-700">Active Tickets</h2>
                        <p class="mt-1 text-3xl font-bold text-blue-600">{{ $activeTickets ?? 2 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-700">Completed Trips</h2>
                        <p class="mt-1 text-3xl font-bold text-green-600">{{ $completedTrips ?? 3 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-700">Pending Payments</h2>
                        <p class="mt-1 text-3xl font-bold text-yellow-600">{{ $pendingPayments ?? 1 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Tickets Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900">My Tickets</h2>
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Book New Ticket
                </a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @forelse($tickets ?? [] as $ticket)
                        <li>
                            <div class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-blue-600">
                                                    {{ $ticket->kode_pemesanan ?? 'TKT-'.rand(10000, 99999) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ ucfirst($ticket->from ?? 'Sanur') }} → {{ ucfirst($ticket->to ?? 'Nusa Penida') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-4 flex flex-col items-end">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $ticket->departure_date ?? \Carbon\Carbon::now()->addDays(rand(1, 10))->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $ticket->departure_time ?? '08:'.rand(10, 59) }} AM
                                                </div>
                                            </div>

                                            @if(($ticket->payment_status ?? '') == 'verified')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Payment Accepted
                                                </span>
                                            @elseif(($ticket->payment_status ?? '') == 'rejected')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Payment Rejected
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ $ticket->passenger_count ?? rand(1, 4) }} Passenger(s)
                                        </div>
                                        <div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <!-- Sample tickets for demonstration -->
                        <li>
                            <div class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-blue-600">
                                                    TKT-12345
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    Sanur → Nusa Penida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-4 flex flex-col items-end">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::now()->addDays(3)->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    08:30 AM
                                                </div>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Payment Accepted
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            2 Passengers
                                        </div>
                                        <div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-blue-600">
                                                    TKT-67890
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    Nusa Penida → Sanur
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-4 flex flex-col items-end">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::now()->addDays(7)->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    14:15 PM
                                                </div>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            1 Passenger
                                        </div>
                                        <div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-blue-600">
                                                    TKT-54321
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    Sanur → Lembongan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-4 flex flex-col items-end">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::now()->addDays(1)->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    09:45 AM
                                                </div>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Payment Rejected
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            3 Passengers
                                        </div>
                                        <div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Additional Information</h2>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form action="#" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Emergency Contact</label>
                                <input type="text" name="emergency_contact" id="emergency_contact" value="{{ $user->emergency_contact ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-xs text-gray-500">Name and phone number of emergency contact</p>
                            </div>

                            <div>
                                <label for="medical_conditions" class="block text-sm font-medium text-gray-700">Medical Conditions</label>
                                <input type="text" name="medical_conditions" id="medical_conditions" value="{{ $user->medical_conditions ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-xs text-gray-500">Any medical conditions we should be aware of</p>
                            </div>

                            <div>
                                <label for="accommodation" class="block text-sm font-medium text-gray-700">Accommodation Details</label>
                                <input type="text" name="accommodation" id="accommodation" value="{{ $user->accommodation ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-xs text-gray-500">Hotel/villa name and location at your destination</p>
                            </div>

                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                                <input type="text" name="special_requests" id="special_requests" value="{{ $user->special_requests ?? '' }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-xs text-gray-500">Any special requests for your journey</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment History Section -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment History</h2>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Booking ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Method
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($payments ?? [] as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        {{ $payment->booking_id ?? 'TKT-'.rand(10000, 99999) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->created_at ?? \Carbon\Carbon::now()->subDays(rand(1, 10))->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp. {{ number_format($payment->amount ?? rand(100000, 500000), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->method ?? 'Bank Transfer' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(($payment->status ?? '') == 'verified')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Accepted
                                            </span>
                                        @elseif(($payment->status ?? '') == 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <!-- Sample payments for demonstration -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        TKT-12345
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::now()->subDays(2)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp. 290.000
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Bank Transfer
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Accepted
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        TKT-67890
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::now()->subDays(1)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp. 145.000
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        E-Wallet (OVO)
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                        TKT-54321
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::now()->subDays(5)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp. 435.000
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Credit Card
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex justify-center md:justify-start">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="SanurBoat Logo" class="h-8 w-auto mr-2">
                    <span class="text-blue-600 font-bold text-lg">SanurBoat</span>
                </div>
            </div>
            <div class="mt-8 md:mt-0">
                <p class="text-center md:text-right text-sm text-gray-500">
                    &copy; {{ date('Y') }} SanurBoat. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Any additional JavaScript for the dashboard
    });
</script>
@endpush
