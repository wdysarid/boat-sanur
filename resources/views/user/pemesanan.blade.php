@extends('layouts.app')

@section('title', 'Booking - E-Ticketing Boat Sanur')

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
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ url()->previous() }}" class="text-blue-600 hover:text-blue-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Booking Details</h1>
            </div>

            <!-- Booking Progress -->
            <div class="flex items-center space-x-4 text-sm">
                <div class="flex items-center text-blue-600">
                    <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium">1</div>
                    <span class="ml-2 font-medium">Passenger Details</span>
                </div>
                <div class="w-8 h-px bg-gray-300"></div>
                <div class="flex items-center text-gray-400">
                    <div class="w-6 h-6 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-xs font-medium">2</div>
                    <span class="ml-2">Payment</span>
                </div>
                <div class="w-8 h-px bg-gray-300"></div>
                <div class="flex items-center text-gray-400">
                    <div class="w-6 h-6 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-xs font-medium">3</div>
                    <span class="ml-2">Confirmation</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form Section -->
            <div class="lg:col-span-2">
                <form id="bookingForm" method="POST" action="#" class="space-y-6">
                    @csrf

                    <!-- Hidden Fields for Ticket Data -->
                    <input type="hidden" name="jadwal_id" value="{{ $ticket['id'] ?? '' }}">
                    <input type="hidden" name="departure_date" value="{{ request('departure_date') }}">
                    <input type="hidden" name="passenger_count" value="{{ request('passenger_count', 1) }}">
                    <input type="hidden" name="passenger_type" value="{{ request('passenger_type') }}">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="to" value="{{ request('to') }}">

                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Contact Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="nama_lengkap"
                                       name="nama_lengkap"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan nama lengkap">
                                @error('nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                    No. Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="tel"
                                       id="no_telepon"
                                       name="no_telepon"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Contoh: +62812345678">
                                @error('no_telepon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="no_identitas" class="block text-sm font-medium text-gray-700 mb-2">
                                    No. Identitas (KTP/Passport) <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="no_identitas"
                                       name="no_identitas"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan nomor identitas">
                                @error('no_identitas')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="contoh@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia <span class="text-red-500">*</span>
                                </label>
                                <input type="number"
                                       id="usia"
                                       name="usia"
                                       required
                                       min="1"
                                       max="120"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Masukkan usia">
                                @error('usia')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Passengers (if more than 1) -->
                    @if(request('passenger_count', 1) > 1)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Additional Passengers ({{ request('passenger_count', 1) - 1 }} more)
                        </h2>

                        @for($i = 2; $i <= request('passenger_count', 1); $i++)
                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-3">Passenger {{ $i }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="passenger_{{ $i }}_nama" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="passenger_{{ $i }}_nama"
                                           name="passengers[{{ $i }}][nama_lengkap]"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="Masukkan nama lengkap">
                                </div>
                                <div>
                                    <label for="passenger_{{ $i }}_identitas" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Identitas <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="passenger_{{ $i }}_identitas"
                                           name="passengers[{{ $i }}][no_identitas]"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="Masukkan nomor identitas">
                                </div>
                                <div>
                                    <label for="passenger_{{ $i }}_usia" class="block text-sm font-medium text-gray-700 mb-2">
                                        Usia <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                           id="passenger_{{ $i }}_usia"
                                           name="passengers[{{ $i }}][usia]"
                                           required
                                           min="1"
                                           max="120"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="Masukkan usia">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @endif

                    <!-- Terms and Conditions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox"
                                   id="terms"
                                   name="terms"
                                   required
                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="terms" class="text-sm text-gray-700">
                                Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a>
                                serta <a href="#" class="text-blue-600 hover:underline">kebijakan privasi</a> yang berlaku.
                                <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Booking Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h2>

                    <!-- Ticket Details -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $ticket['image'] ?? '/images/boats/default-boat.jpg' }}"
                                 alt="{{ $ticket['boat_name'] ?? 'Fast Boat' }}"
                                 class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $ticket['boat_name'] ?? 'Semabu Hills Fast Boat' }}</h3>
                                <p class="text-sm text-gray-600">{{ $ticket['duration'] ?? '45 minutes' }}</p>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Route</span>
                                <span class="text-sm font-medium">
                                    {{ ucfirst(str_replace('_', ' ', request('from', 'sanur'))) }} →
                                    {{ ucfirst(str_replace('_', ' ', request('to', 'nusa_penida'))) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Date</span>
                                <span class="text-sm font-medium">
                                    {{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('d M, Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Time</span>
                                <span class="text-sm font-medium">{{ $ticket['departure_time'] ?? '06:30' }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Passengers</span>
                                <span class="text-sm font-medium">{{ request('passenger_count', 1) }} person{{ request('passenger_count', 1) > 1 ? 's' : '' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Type</span>
                                <span class="text-sm font-medium">{{ request('passenger_type') == 'foreign' ? 'Foreign' : 'Domestic' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Price per person</span>
                            <span class="text-sm">Rp. {{ number_format($ticket['price'] ?? 145000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Quantity</span>
                            <span class="text-sm">{{ request('passenger_count', 1) }}x</span>
                        </div>
                        <div class="flex justify-between items-center font-semibold text-lg border-t pt-2">
                            <span>Total</span>
                            <span class="text-blue-600">
                                Rp. {{ number_format(($ticket['price'] ?? 145000) * request('passenger_count', 1), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button type="submit"
                                form="bookingForm"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md transition duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Continue to Payment
                        </button>

                        <a href="{{ url()->previous() }}"
                           class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-md transition duration-200 text-center block">
                            Back to Search
                        </a>
                    </div>

                    <!-- Contact Support -->
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-xs text-gray-500 text-center mb-2">Need help?</p>
                        <div class="flex justify-center space-x-4">
                            <a href="tel:+6281234567890" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Call
                            </a>
                            <a href="https://wa.me/6281234567890" class="text-green-600 hover:text-green-800 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('bookingForm');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';

        // Submit form
        this.submit();
    });

    // Phone number formatting
    const phoneInput = document.getElementById('no_telepon');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        if (!value.startsWith('62')) {
            value = '62' + value;
        }
        e.target.value = '+' + value;
    });

    // Identity number validation
    const identityInput = document.getElementById('no_identitas');
    identityInput.addEventListener('input', function(e) {
        // Remove non-alphanumeric characters
        e.target.value = e.target.value.replace(/[^a-zA-Z0-9]/g, '');
    });
});
</script>
@endpush
