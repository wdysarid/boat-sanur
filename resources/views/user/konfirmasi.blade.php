@extends('layouts.app')

@section('title', 'Booking Confirmation - E-Ticketing Boat Sanur')

@section('content')
<!-- Navbar -->
<nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo (Left Side) -->
            <div class="flex-shrink-0 flex items-center" data-aos="fade-right" data-aos-duration="800">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-trans.png') }}" alt="DreamIslands Logo" class="h-10 w-auto mr-2">
                    <a href="/" class="text-blue-600 font-bold text-xl">SanurBoat</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b pt-20 md:pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Booking Confirmation</h1>
                <p class="text-gray-600">Your booking has been successfully processed</p>
            </div>

            <!-- Booking Progress - All Complete -->
            <div class="flex items-center justify-center space-x-4 text-sm mt-6">
                <div class="flex items-center text-green-600">
                    <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-medium">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 font-medium">Passenger Details</span>
                </div>
                <div class="w-8 h-px bg-green-600"></div>
                <div class="flex items-center text-green-600">
                    <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-medium">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 font-medium">Payment</span>
                </div>
                <div class="w-8 h-px bg-green-600"></div>
                <div class="flex items-center text-green-600">
                    <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-medium">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 font-medium">Confirmation</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success Message -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-green-800">Booking Confirmed!</h2>
                    <p class="text-green-700 mt-1">
                        @if(($booking['payment_status'] ?? 'pending') === 'verified')
                            Your payment has been verified and your e-ticket is ready.
                        @else
                            Your booking is confirmed. We're processing your payment and will send your e-ticket once verified.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- E-Ticket Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8" id="eticket">
            <!-- Ticket Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold">E-TICKET</h3>
                        <p class="text-blue-100">Fast Boat Ticket</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-100">Booking ID</p>
                        <p class="text-lg font-bold">{{ $booking['kode_pemesanan'] ?? 'TKT-ABC12345' }}</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Body -->
            <div class="p-6">
                <!-- Passenger Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Passenger Information
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Name:</span>
                                <span class="font-medium">{{ $booking['nama_lengkap'] ?? 'John Doe' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium">{{ $booking['email'] ?? 'john@example.com' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phone:</span>
                                <span class="font-medium">{{ $booking['no_telepon'] ?? '+6281234567890' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID Number:</span>
                                <span class="font-medium">{{ $booking['no_identitas'] ?? '1234567890123456' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Passengers:</span>
                                <span class="font-medium">{{ $booking['passenger_count'] ?? 1 }} person{{ ($booking['passenger_count'] ?? 1) > 1 ? 's' : '' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Trip Details
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Route:</span>
                                <span class="font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $booking['from'] ?? 'sanur')) }} →
                                    {{ ucfirst(str_replace('_', ' ', $booking['to'] ?? 'nusa_penida')) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($booking['departure_date'] ?? date('Y-m-d'))->format('l, d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Departure:</span>
                                <span class="font-medium">{{ $booking['departure_time'] ?? '06:30' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Boat:</span>
                                <span class="font-medium">{{ $booking['boat_name'] ?? 'Semabu Hills Fast Boat' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Duration:</span>
                                <span class="font-medium">{{ $booking['duration'] ?? '45 minutes' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Visualization -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $booking['departure_port'] ?? 'Sanur Harbor' }}</p>
                            <p class="text-xs text-gray-600">{{ $booking['departure_time'] ?? '06:30' }}</p>
                        </div>

                        <div class="flex-1 flex items-center justify-center mx-4">
                            <div class="flex items-center">
                                <div class="h-px bg-blue-300 flex-1"></div>
                                <svg class="w-8 h-8 text-blue-600 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                <div class="h-px bg-blue-300 flex-1"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $booking['arrival_port'] ?? 'Banjar Nyuh Harbor' }}</p>
                            <p class="text-xs text-gray-600">{{ $booking['arrival_time'] ?? '07:15' }}</p>
                        </div>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="flex items-center justify-center mb-6">
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-2">
                            <!-- QR Code placeholder - you can integrate with a QR code library -->
                            <div class="w-24 h-24 bg-black" style="background-image: url('data:image/svg+xml;base64,{{ base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="white"/><rect x="0" y="0" width="10" height="10" fill="black"/><rect x="20" y="0" width="10" height="10" fill="black"/><rect x="40" y="0" width="10" height="10" fill="black"/><rect x="60" y="0" width="10" height="10" fill="black"/><rect x="80" y="0" width="10" height="10" fill="black"/></svg>') }}'); background-size: cover;"></div>
                        </div>
                        <p class="text-xs text-gray-600">Scan QR code at departure</p>
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="border-t pt-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Payment Status:</span>
                        @if(($booking['payment_status'] ?? 'pending') === 'verified')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Verified
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total Paid:</span>
                        <span class="font-semibold text-lg text-green-600">
                            Rp. {{ number_format($booking['total_amount'] ?? 150000, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ticket Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t">
                <div class="flex items-center justify-between text-xs text-gray-600">
                    <span>Issued: {{ now()->format('d M Y, H:i') }}</span>
                    <span>Valid for travel date only</span>
                </div>
            </div>
        </div>

        <!-- Important Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Important Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Before Departure</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Arrive at harbor 30 minutes before departure</li>
                        <li>• Bring valid ID (KTP/Passport) matching ticket</li>
                        <li>• Check weather conditions before travel</li>
                        <li>• Luggage limit: 20kg per person</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Cancellation Policy</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Free cancellation 24 hours before departure</li>
                        <li>• 50% refund 12-24 hours before departure</li>
                        <li>• No refund less than 12 hours before departure</li>
                        <li>• Weather cancellation: full refund</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="downloadTicket()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m3 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Download E-Ticket
            </button>

            <button onclick="shareTicket()"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                </svg>
                Share Ticket
            </button>

            <a href="{{ route('user.dashboard') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                </svg>
                My Bookings
            </a>

            <a href="#"
               class="border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3 px-6 rounded-md transition duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Back to Home
            </a>
        </div>

        <!-- Contact Support -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600 mb-4">Need help or have questions about your booking?</p>
            <div class="flex justify-center space-x-6">
                <a href="tel:+6281234567890" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Call Support: +62 812-3456-7890
                </a>
                <a href="https://wa.me/6281234567890" class="text-green-600 hover:text-green-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                    </svg>
                    WhatsApp Support
                </a>
                <a href="mailto:support@sanurboat.com" class="text-purple-600 hover:text-purple-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email Support
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Email Notification Modal -->
<div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Email Confirmation</h3>
            </div>
            <p class="text-gray-600 mb-4">
                Your e-ticket has been sent to <strong>{{ $booking['email'] ?? 'your email' }}</strong>.
                Please check your inbox and spam folder.
            </p>
            <div class="flex justify-end">
                <button onclick="closeEmailModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Got it
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show email notification modal after 2 seconds
    setTimeout(function() {
        document.getElementById('emailModal').classList.remove('hidden');
    }, 2000);

    // Auto-refresh payment status if pending
    @if(($booking['payment_status'] ?? 'pending') !== 'verified')
        setInterval(function() {
            checkPaymentStatus();
        }, 30000); // Check every 30 seconds
    @endif
});

function downloadTicket() {
    const element = document.getElementById('eticket');
    const opt = {
        margin: 0.5,
        filename: 'e-ticket-{{ $booking["kode_pemesanan"] ?? "TKT-ABC12345" }}.png',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Use html2canvas to capture the ticket
    html2canvas(element, {
        scale: 2,
        useCORS: true,
        backgroundColor: '#ffffff'
    }).then(function(canvas) {
        const link = document.createElement('a');
        link.download = 'e-ticket-{{ $booking["kode_pemesanan"] ?? "TKT-ABC12345" }}.png';
        link.href = canvas.toDataURL();
        link.click();
    });
}

function shareTicket() {
    if (navigator.share) {
        navigator.share({
            title: 'My Boat Ticket',
            text: 'Check out my boat ticket for {{ $booking["from"] ?? "Sanur" }} to {{ $booking["to"] ?? "Nusa Penida" }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy link to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Ticket link copied to clipboard!');
        });
    }
}

function closeEmailModal() {
    document.getElementById('emailModal').classList.add('hidden');
}

function checkPaymentStatus() {
    fetch('/api/booking/{{ $booking["id"] ?? 1 }}/status')
        .then(response => response.json())
        .then(data => {
            if (data.payment_status === 'verified') {
                location.reload(); // Refresh page to show updated status
            }
        })
        .catch(error => {
            console.log('Error checking payment status:', error);
        });
}

// Print ticket function
function printTicket() {
    const printContent = document.getElementById('eticket').innerHTML;
    const originalContent = document.body.innerHTML;

    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}
