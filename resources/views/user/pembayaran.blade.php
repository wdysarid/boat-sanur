@extends('layouts.app')

@section('title', 'Payment - E-Ticketing Boat Sanur')

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
                <a href="{{ route('user.pemesanan') }}" class="text-blue-600 hover:text-blue-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Payment</h1>
            </div>

            <!-- Booking Progress -->
            <div class="flex items-center space-x-4 text-sm">
                <div class="flex items-center text-green-600">
                    <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-medium">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 font-medium">Passenger Details</span>
                </div>
                <div class="w-8 h-px bg-green-600"></div>
                <div class="flex items-center text-blue-600">
                    <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium">2</div>
                    <span class="ml-2 font-medium">Payment</span>
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
            <!-- Payment Methods Section -->
            <div class="lg:col-span-2">
                <form id="paymentForm" method="POST" action="#" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Hidden booking data -->
                    <input type="hidden" name="booking_id" value="{{ $booking['id'] ?? '' }}">
                    <input type="hidden" name="total_amount" value="{{ $booking['total_amount'] ?? 0 }}">

                    <!-- Payment Timer -->
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-800">Complete payment within</p>
                                <p class="text-lg font-bold text-red-600" id="countdown">15:00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Choose Payment Method</h2>

                        <!-- Bank Transfer -->
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg">
                                <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                                <span class="font-medium text-gray-900">Bank Transfer</span>
                                            </div>
                                            <span class="text-sm text-green-600 font-medium">Recommended</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Transfer to our bank account</p>
                                    </div>
                                </label>

                                <!-- Bank Transfer Details -->
                                <div id="bank_transfer_details" class="px-4 pb-4 border-t border-gray-100">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center mb-2">
                                                <img src="/images/banks/bca.png" alt="BCA" class="w-8 h-8 mr-2" onerror="this.style.display='none'">
                                                <span class="font-medium">Bank BCA</span>
                                            </div>
                                            <p class="text-sm text-gray-600">Account Number:</p>
                                            <div class="flex items-center justify-between bg-white p-2 rounded border mt-1">
                                                <span class="font-mono font-medium">1234567890</span>
                                                <button type="button" onclick="copyToClipboard('1234567890')" class="text-blue-600 hover:text-blue-800 text-sm">
                                                    Copy
                                                </button>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-2">Account Name: <span class="font-medium">PT Sanur Boat</span></p>
                                        </div>

                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center mb-2">
                                                <img src="/images/banks/mandiri.png" alt="Mandiri" class="w-8 h-8 mr-2" onerror="this.style.display='none'">
                                                <span class="font-medium">Bank Mandiri</span>
                                            </div>
                                            <p class="text-sm text-gray-600">Account Number:</p>
                                            <div class="flex items-center justify-between bg-white p-2 rounded border mt-1">
                                                <span class="font-mono font-medium">0987654321</span>
                                                <button type="button" onclick="copyToClipboard('0987654321')" class="text-blue-600 hover:text-blue-800 text-sm">
                                                    Copy
                                                </button>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-2">Account Name: <span class="font-medium">PT Sanur Boat</span></p>
                                        </div>
                                    </div>

                                    <!-- Transfer Instructions -->
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <h4 class="font-medium text-blue-900 mb-2">Transfer Instructions:</h4>
                                        <ol class="text-sm text-blue-800 space-y-1">
                                            <li>1. Transfer the exact amount to one of the accounts above</li>
                                            <li>2. Upload your transfer receipt below</li>
                                            <li>3. We will verify your payment within 1-2 hours</li>
                                            <li>4. You will receive your e-ticket via email after verification</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet Options -->
                            <div class="border border-gray-200 rounded-lg">
                                <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="ewallet" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium text-gray-900">E-Wallet</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Pay with GoPay, OVO, DANA, or ShopeePay</p>
                                    </div>
                                </label>

                                <!-- E-Wallet Options -->
                                <div id="ewallet_details" class="px-4 pb-4 border-t border-gray-100 hidden">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                                        <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                            <input type="radio" name="ewallet_type" value="gopay" class="sr-only">
                                            <img src="/images/ewallet/gopay.png" alt="GoPay" class="w-12 h-12 mb-2" onerror="this.style.display='none'">
                                            <span class="text-sm font-medium">GoPay</span>
                                        </label>
                                        <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                            <input type="radio" name="ewallet_type" value="ovo" class="sr-only">
                                            <img src="/images/ewallet/ovo.png" alt="OVO" class="w-12 h-12 mb-2" onerror="this.style.display='none'">
                                            <span class="text-sm font-medium">OVO</span>
                                        </label>
                                        <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                            <input type="radio" name="ewallet_type" value="dana" class="sr-only">
                                            <img src="/images/ewallet/dana.png" alt="DANA" class="w-12 h-12 mb-2" onerror="this.style.display='none'">
                                            <span class="text-sm font-medium">DANA</span>
                                        </label>
                                        <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                            <input type="radio" name="ewallet_type" value="shopeepay" class="sr-only">
                                            <img src="/images/ewallet/shopeepay.png" alt="ShopeePay" class="w-12 h-12 mb-2" onerror="this.style.display='none'">
                                            <span class="text-sm font-medium">ShopeePay</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Credit Card -->
                            <div class="border border-gray-200 rounded-lg">
                                <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="credit_card" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                            <span class="font-medium text-gray-900">Credit/Debit Card</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Visa, Mastercard, JCB</p>
                                    </div>
                                </label>

                                <!-- Credit Card Form -->
                                <div id="credit_card_details" class="px-4 pb-4 border-t border-gray-100 hidden">
                                    <div class="space-y-4 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                            <input type="text" name="card_number" placeholder="1234 5678 9012 3456"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                                <input type="text" name="expiry_date" placeholder="MM/YY"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                                <input type="text" name="cvv" placeholder="123"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                                            <input type="text" name="cardholder_name" placeholder="John Doe"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Payment Proof (for Bank Transfer) -->
                    <div id="upload_section" class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Payment Proof</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" class="hidden" onchange="handleFileUpload(this)">
                            <label for="payment_proof" class="cursor-pointer">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </label>
                        </div>
                        <div id="file_preview" class="mt-4 hidden">
                            <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm text-green-800" id="file_name"></span>
                                <button type="button" onclick="removeFile()" class="ml-auto text-green-600 hover:text-green-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="payment_terms" name="payment_terms" required
                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="payment_terms" class="text-sm text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:underline">payment terms and conditions</a>
                                and understand that my booking will be confirmed after payment verification.
                                <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Payment Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Summary</h2>

                    <!-- Booking Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Booking ID</span>
                            <span class="font-medium">{{ $booking['kode_pemesanan'] ?? 'TKT-ABC12345' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Route</span>
                            <span class="font-medium">
                                {{ ucfirst(str_replace('_', ' ', $booking['from'] ?? 'sanur')) }} →
                                {{ ucfirst(str_replace('_', ' ', $booking['to'] ?? 'nusa_penida')) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Date</span>
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($booking['departure_date'] ?? date('Y-m-d'))->format('d M, Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Passengers</span>
                            <span class="font-medium">{{ $booking['passenger_count'] ?? 1 }} person{{ ($booking['passenger_count'] ?? 1) > 1 ? 's' : '' }}</span>
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Ticket Price</span>
                            <span class="text-sm">Rp. {{ number_format($booking['ticket_price'] ?? 145000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Quantity</span>
                            <span class="text-sm">{{ $booking['passenger_count'] ?? 1 }}x</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Admin Fee</span>
                            <span class="text-sm">Rp. {{ number_format($booking['admin_fee'] ?? 5000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center font-semibold text-lg border-t pt-2">
                            <span>Total Payment</span>
                            <span class="text-blue-600">
                                Rp. {{ number_format($booking['total_amount'] ?? 150000, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button type="submit" form="paymentForm" id="paymentBtn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md transition duration-200 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Process Payment
                    </button>

                    <!-- Security Notice -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <div>
                                <p class="text-xs font-medium text-green-800">Secure Payment</p>
                                <p class="text-xs text-green-700">Your payment is protected with SSL encryption</p>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Support -->
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-xs text-gray-500 text-center mb-2">Need help with payment?</p>
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
    // Payment method toggle
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const bankTransferDetails = document.getElementById('bank_transfer_details');
    const ewalletDetails = document.getElementById('ewallet_details');
    const creditCardDetails = document.getElementById('credit_card_details');
    const uploadSection = document.getElementById('upload_section');

    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            // Hide all details
            bankTransferDetails.style.display = 'none';
            ewalletDetails.classList.add('hidden');
            creditCardDetails.classList.add('hidden');

            // Show relevant details
            if (this.value === 'bank_transfer') {
                bankTransferDetails.style.display = 'block';
                uploadSection.style.display = 'block';
            } else if (this.value === 'ewallet') {
                ewalletDetails.classList.remove('hidden');
                uploadSection.style.display = 'none';
            } else if (this.value === 'credit_card') {
                creditCardDetails.classList.remove('hidden');
                uploadSection.style.display = 'none';
            }
        });
    });

    // E-wallet selection
    const ewalletOptions = document.querySelectorAll('input[name="ewallet_type"]');
    ewalletOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Remove selected class from all
            ewalletOptions.forEach(opt => {
                opt.closest('label').classList.remove('border-blue-500', 'bg-blue-50');
            });
            // Add selected class to current
            this.closest('label').classList.add('border-blue-500', 'bg-blue-50');
        });
    });

    // Payment countdown timer
    let timeLeft = 15 * 60; // 15 minutes in seconds
    const countdownElement = document.getElementById('countdown');

    function updateCountdown() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (timeLeft <= 0) {
            alert('Payment time has expired. Please start a new booking.');
            window.location.href = '/';
        }
        timeLeft--;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Form submission
    const paymentForm = document.getElementById('paymentForm');
    const paymentBtn = document.getElementById('paymentBtn');

    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

        // Validate based on payment method
        if (selectedMethod === 'bank_transfer') {
            const paymentProof = document.getElementById('payment_proof').files[0];
            if (!paymentProof) {
                alert('Please upload your payment proof');
                return;
            }
        } else if (selectedMethod === 'ewallet') {
            const selectedEwallet = document.querySelector('input[name="ewallet_type"]:checked');
            if (!selectedEwallet) {
                alert('Please select an e-wallet option');
                return;
            }
        } else if (selectedMethod === 'credit_card') {
            const cardNumber = document.querySelector('input[name="card_number"]').value;
            const expiryDate = document.querySelector('input[name="expiry_date"]').value;
            const cvv = document.querySelector('input[name="cvv"]').value;
            const cardholderName = document.querySelector('input[name="cardholder_name"]').value;

            if (!cardNumber || !expiryDate || !cvv || !cardholderName) {
                alert('Please fill in all credit card details');
                return;
            }
        }

        // Disable button and show loading
        paymentBtn.disabled = true;
        paymentBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing Payment...';

        // Submit form
        this.submit();
    });

    // Credit card formatting
    const cardNumberInput = document.querySelector('input[name="card_number"]');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }

    const expiryInput = document.querySelector('input[name="expiry_date"]');
    if (expiryInput) {
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }
});

// Utility functions
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Account number copied to clipboard!');
    });
}

function handleFileUpload(input) {
    const file = input.files[0];
    if (file) {
        const filePreview = document.getElementById('file_preview');
        const fileName = document.getElementById('file_name');

        fileName.textContent = file.name;
        filePreview.classList.remove('hidden');
    }
}

function removeFile() {
    const input = document.getElementById('payment_proof');
    const filePreview = document.getElementById('file_preview');

    input.value = '';
    filePreview.classList.add('hidden');
}
</script>
@endpush
