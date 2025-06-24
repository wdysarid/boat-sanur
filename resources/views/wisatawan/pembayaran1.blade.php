@extends('layouts.wisatawan')

@section('title', 'Pembayaran')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('wisatawan.dashboard') }}" class="text-gray-500 hover:text-gray-700">
                                <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <a href="{{ route('wisatawan.pemesanan') }}"
                                    class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Pemesanan</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-900">Pembayaran</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-4">
                    <h1 class="text-3xl font-bold text-gray-900">Pembayaran</h1>
                    <p class="mt-2 text-gray-600">Pilih metode pembayaran dan selesaikan transaksi Anda</p>
                </div>
            </div>

            <!-- Booking Progress -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="flex items-center justify-center space-x-4 text-sm">
                    <div class="flex items-center text-green-600">
                        <div
                            class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="ml-3 font-medium">Detail Penumpang</span>
                    </div>
                    <div class="w-16 h-px bg-green-600"></div>
                    <div class="flex items-center text-blue-600">
                        <div
                            class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                            2</div>
                        <span class="ml-3 font-medium">Pembayaran</span>
                    </div>
                    <div class="w-16 h-px bg-gray-300"></div>
                    <div class="flex items-center text-gray-400">
                        <div
                            class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">
                            3</div>
                        <span class="ml-3">Konfirmasi</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Payment Methods Section -->
                <div class="lg:col-span-2">
                    <form id="paymentForm" method="POST" action="{{ route('wisatawan.pembayaran.proses') }}"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Hidden booking data -->
                        <input type="hidden" name="tiket_id" value="{{ $tiket['id'] ?? '' }}">
                        <input type="hidden" name="jumlah_bayar" value="{{ $tiket['total_harga'] ?? 0 }}">
                        <input type="hidden" name="metode_bayar" id="selected_payment_method" value="">

                        <!-- Payment Timer -->
                        <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-red-800">Selesaikan pembayaran dalam</p>
                                    <p class="text-2xl font-bold text-red-600" id="countdown">15:00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Pilih Metode Pembayaran</h2>

                            <!-- Bank Transfer -->
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg">
                                    <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50 rounded-lg">
                                        <input type="radio" name="payment_method" value="transfer"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    <span class="font-medium text-gray-900">Transfer Bank</span>
                                                </div>
                                                <span class="text-sm text-green-600 font-medium">Direkomendasikan</span>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">Transfer ke rekening bank kami</p>
                                        </div>
                                    </label>

                                    <!-- Bank Transfer Details -->
                                    <div id="bank_transfer_details" class="px-4 pb-4 border-t border-gray-100">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center mr-3">
                                                        <span class="text-white font-bold text-sm">BCA</span>
                                                    </div>
                                                    <span class="font-medium">Bank BCA</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-1">Nomor Rekening:</p>
                                                <div class="flex items-center justify-between bg-white p-3 rounded border">
                                                    <span class="font-mono font-medium">1234567890</span>
                                                    <button type="button" onclick="copyToClipboard('1234567890')"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                        Salin
                                                    </button>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-2">Atas Nama: <span
                                                        class="font-medium">PT SanurBoat Indonesia</span></p>
                                            </div>

                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-8 h-8 bg-yellow-500 rounded flex items-center justify-center mr-3">
                                                        <span class="text-white font-bold text-xs">MDR</span>
                                                    </div>
                                                    <span class="font-medium">Bank Mandiri</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-1">Nomor Rekening:</p>
                                                <div class="flex items-center justify-between bg-white p-3 rounded border">
                                                    <span class="font-mono font-medium">0987654321</span>
                                                    <button type="button" onclick="copyToClipboard('0987654321')"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                        Salin
                                                    </button>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-2">Atas Nama: <span
                                                        class="font-medium">PT SanurBoat Indonesia</span></p>
                                            </div>
                                        </div>

                                        <!-- Transfer Instructions -->
                                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                            <h4 class="font-medium text-blue-900 mb-3">Instruksi Transfer:</h4>
                                            <ol class="text-sm text-blue-800 space-y-1">
                                                <li>1. Transfer sesuai nominal ke salah satu rekening di atas</li>
                                                <li>2. Upload bukti transfer di bawah ini</li>
                                                <li>3. Kami akan verifikasi pembayaran dalam 1-2 jam</li>
                                                <li>4. E-tiket akan dikirim via email setelah verifikasi</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- QRIS Payment -->
                                <div class="border border-gray-200 rounded-lg">
                                    <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50 rounded-lg">
                                        <input type="radio" name="payment_method" value="qris"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span class="font-medium text-gray-900">QRIS</span>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">Bayar dengan QR Code (Gopay, OVO, DANA,
                                                dll)</p>
                                        </div>
                                    </label>

                                    <!-- QRIS Details -->
                                    <div id="qris_details" class="px-4 pb-4 border-t border-gray-100 hidden">
                                        <div class="mt-4 text-center">
                                            <div
                                                class="mx-auto bg-white p-4 rounded-lg border border-gray-200 inline-block mb-4">
                                                <img src="{{ asset('images/qris.png') }}" alt="QRIS Payment"
                                                    class="w-48 h-48">
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Transfer Instructions -->
                                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                                <h4 class="font-medium text-blue-900 mb-3">Instruksi Pembayaran
                                                    QRIS:</h4>
                                                <ol class="text-sm text-blue-800 space-y-1">
                                                    <li>1. Buka aplikasi dompet digital atau mobile banking Anda</li>
                                                    <li>2. Pilih fitur scan QRIS dan arahkan kamera ke QR code di atas
                                                    </li>
                                                    <li>3. Pastikan nominal sesuai dengan total pembayaran dan
                                                        selesaikan pembayaran</li>
                                                    <li>4. Upload bukti transfer di bawah ini</li>
                                                    <li>5. Kami akan verifikasi pembayaran dalam 1-2 jam</li>
                                                    <li>6. E-tiket akan dikirim via email setelah verifikasi</li>
                                                </ol>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- E-Wallet Options -->
                                {{-- <div class="border border-gray-200 rounded-lg">
                                    <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50 rounded-lg">
                                        <input type="radio" name="payment_method" value="ewallet"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span class="font-medium text-gray-900">E-Wallet</span>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">Bayar dengan GoPay, OVO, DANA, atau
                                                ShopeePay</p>
                                        </div>
                                    </label>

                                    <!-- E-Wallet Options -->
                                    <div id="ewallet_details" class="px-4 pb-4 border-t border-gray-100 hidden">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                                            <label
                                                class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                                <input type="radio" name="ewallet_type" value="gopay"
                                                    class="sr-only">
                                                <div
                                                    class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-2">
                                                    <span class="text-white font-bold text-xs">GO</span>
                                                </div>
                                                <span class="text-sm font-medium">GoPay</span>
                                            </label>
                                            <label
                                                class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                                <input type="radio" name="ewallet_type" value="ovo"
                                                    class="sr-only">
                                                <div
                                                    class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-2">
                                                    <span class="text-white font-bold text-xs">OVO</span>
                                                </div>
                                                <span class="text-sm font-medium">OVO</span>
                                            </label>
                                            <label
                                                class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                                <input type="radio" name="ewallet_type" value="dana"
                                                    class="sr-only">
                                                <div
                                                    class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mb-2">
                                                    <span class="text-white font-bold text-xs">DANA</span>
                                                </div>
                                                <span class="text-sm font-medium">DANA</span>
                                            </label>
                                            <label
                                                class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                                <input type="radio" name="ewallet_type" value="shopeepay"
                                                    class="sr-only">
                                                <div
                                                    class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mb-2">
                                                    <span class="text-white font-bold text-xs">SP</span>
                                                </div>
                                                <span class="text-sm font-medium">ShopeePay</span>
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Credit Card -->
                                {{-- <div class="border border-gray-200 rounded-lg">
                                    <label class="flex items-center p-4 cursor-pointer hover:bg-gray-50 rounded-lg">
                                        <input type="radio" name="payment_method" value="credit_card"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-purple-600 mr-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                <span class="font-medium text-gray-900">Kartu Kredit/Debit</span>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">Visa, Mastercard, JCB</p>
                                        </div>
                                    </label>

                                    <!-- Credit Card Form -->
                                    <div id="credit_card_details" class="px-4 pb-4 border-t border-gray-100 hidden">
                                        <div class="space-y-4 mt-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                                    Kartu</label>
                                                <input type="text" name="card_number"
                                                    placeholder="1234 5678 9012 3456"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                                        Kadaluarsa</label>
                                                    <input type="text" name="card_expiry" placeholder="MM/YY"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                                    <input type="text" name="card_cvv" placeholder="123"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemegang
                                                    Kartu</label>
                                                <input type="text" name="card_holder" placeholder="Nama sesuai kartu"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Upload Payment Proof (for Bank Transfer) -->
                        <div id="upload_section" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Upload Bukti Pembayaran</h3>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                                <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*"
                                    class="hidden" onchange="handleFileUpload(this)">
                                <label for="bukti_transfer" class="cursor-pointer">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-4">
                                        <p class="text-lg text-gray-600">
                                            <span class="font-medium text-blue-600 hover:text-blue-500">Klik untuk
                                                upload</span>
                                            atau drag and drop
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG, JPEG maksimal 2MB</p>
                                    </div>
                                </label>
                            </div>
                            <div id="file_preview" class="mt-4 hidden">
                                <div class="flex items-center p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-green-800 flex-1" id="file_name"></span>
                                    <button type="button" onclick="removeFile()"
                                        class="text-green-600 hover:text-green-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" id="payment_terms" name="payment_terms" required
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="payment_terms" class="text-sm text-gray-700">
                                    Saya menyetujui <a href="#"
                                        class="text-blue-600 hover:underline font-medium">syarat dan
                                        ketentuan
                                        pembayaran</a>
                                    dan memahami bahwa pemesanan akan dikonfirmasi setelah verifikasi pembayaran.
                                    <span class="text-red-500">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between">
                            <a href="{{ route('wisatawan.pemesanan') }}"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Kembali
                            </a>
                            <button type="submit" id="paymentBtn"
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Proses Pembayaran
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Payment Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Ringkasan Pembayaran</h2>

                        @if ($tiket)
                            <!-- Booking Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">ID Pemesanan</span>
                                    <span class="font-medium">{{ $tiket['kode_pemesanan'] }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Rute</span>
                                    <span class="font-medium">
                                        {{ ucfirst($tiket['rute_asal']) }} →
                                        {{ ucfirst($tiket['rute_tujuan']) }}
                                    </span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tanggal</span>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($tiket['tanggal'])->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Penumpang</span>
                                    <span class="font-medium">{{ $tiket['jumlah_penumpang'] }} orang</span>
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-t pt-4 mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Harga Tiket</span>
                                    <span class="text-sm">Rp
                                        {{ number_format($tiket['harga_tiket'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Jumlah</span>
                                    <span class="text-sm">{{ $tiket['jumlah_penumpang'] }}x</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Biaya Admin</span>
                                    <span class="text-sm">Rp
                                        {{ number_format($tiket['biaya_admin'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center font-semibold text-lg border-t pt-2">
                                    <span>Total Pembayaran</span>
                                    <span class="text-blue-600">
                                        Rp {{ number_format($tiket['total_harga'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-8">
                                <div
                                    class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pembayaran aktif</h3>
                                <p class="text-gray-500 mb-6">
                                    Silakan pesan tiket terlebih dahulu untuk melakukan pembayaran.
                                </p>

                                <a href="{{ route('search.tickets') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Cari Jadwal
                                </a>
                            </div>
                        @endif

                        <!-- Security Notice -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-green-800">Pembayaran Aman</p>
                                    <p class="text-xs text-green-700">Dilindungi dengan enkripsi SSL</p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Support -->
                        <div class="border-t pt-4">
                            <p class="text-xs text-gray-500 text-center mb-3">Butuh bantuan pembayaran?</p>
                            <div class="flex justify-center space-x-4">
                                <a href="tel:+6281234567890"
                                    class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Telepon
                                </a>
                                <a href="https://wa.me/6281234567890"
                                    class="text-green-600 hover:text-green-800 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688" />
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
            const qrisDetails = document.getElementById('qris_details');
            // const ewalletDetails = document.getElementById('ewallet_details');
            // const creditCardDetails = document.getElementById('credit_card_details');
            const uploadSection = document.getElementById('upload_section');

            document.querySelector('input[name="payment_method"][value="transfer"]').checked = true;
            bankTransferDetails.style.display = 'block';
            uploadSection.style.display = 'block';
            qrisDetails.classList.add('hidden');

            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    // Hide all details
                    bankTransferDetails.style.display = 'none';
                    qrisDetails.classList.add('hidden');
                    // ewalletDetails.classList.add('hidden');
                    // creditCardDetails.classList.add('hidden');
                    uploadSection.style.display = 'none';

                    // Show relevant details
                    if (this.value === 'transfer') {
                        bankTransferDetails.style.display = 'block';
                        uploadSection.style.display = 'block';
                    } else if (this.value === 'qris') {
                        qrisDetails.classList.remove('hidden');
                        uploadSection.style.display = 'block';
                    } // else if (this.value === 'ewallet') {
                    //     ewalletDetails.classList.remove('hidden');
                    // } else if (this.value === 'credit_card') {
                    //     creditCardDetails.classList.remove('hidden');
                    // }
                });
            });

            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    showToast('Nomor rekening berhasil disalin!', 'success');
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                    showToast('Gagal menyalin nomor rekening', 'error');
                });
            }
            // Initialize with bank transfer selected
            bankTransferDetails.style.display = 'block';
            uploadSection.style.display = 'block';

            // Payment countdown timer
            // Payment countdown timer
            function startCountdown() {
                let timeLeft = 15 * 60; // 15 minutes in seconds
                const countdownElement = document.getElementById('countdown');
                const tiketId = document.querySelector('input[name="tiket_id"]').value;

                async function cancelPayment() {
                    try {
                        const response = await fetch('/api/pembayaran/batal', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                tiket_id: tiketId,
                                reason: 'Waktu pembayaran habis'
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            console.error('Gagal membatalkan pemesanan:', data.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }

                function updateCountdown() {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    countdownElement.textContent =
                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        countdownElement.textContent = '00:00';
                        countdownElement.classList.add('text-red-600', 'font-bold');

                        // Tampilkan modal/alert bahwa waktu habis
                        showToast('Waktu pembayaran telah habis. Pemesanan dibatalkan.', 'error');

                        // Kirim request untuk membatalkan pembayaran
                        cancelPayment();

                        // Redirect setelah 5 detik
                        setTimeout(() => {
                            window.location.href = '{{ route('wisatawan.pemesanan') }}?timeout=true';
                        }, 5000);
                        return;
                    }

                    // Ubah warna jadi merah ketika sisa waktu 5 menit
                    if (timeLeft <= 300) { // 5 menit = 300 detik
                        countdownElement.classList.add('text-red-600');
                    }

                    timeLeft--;
                }

                updateCountdown(); // Initial call
                const timer = setInterval(updateCountdown, 1000);

                return timer;
            }

            // Start the countdown
            const countdownTimer = startCountdown();

            document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('selected_payment_method').value = this.value;
                });
            });

            // Form submission
            const paymentForm = document.getElementById('paymentForm');
            const paymentBtn = document.getElementById('paymentBtn');

            document.getElementById('selected_payment_method').value = 'transfer';
            document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('selected_payment_method').value = this.value;
                });
            });

            paymentForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Disable submit button
                paymentBtn.disabled = true;
                paymentBtn.innerHTML =
                    '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">' +
                    '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                    '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>' +
                    '</svg> Memproses Pembayaran...';

                try {
                    const formData = new FormData(paymentForm);

                    const response = await fetch(paymentForm.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            // Handle Laravel validation errors
                            let errorMessages = [];
                            for (const field in data.errors) {
                                errorMessages.push(...data.errors[field]);
                            }
                            showToast(errorMessages.join('<br>'), 'error', 5000);
                        } else {
                            showToast(data.message || 'Terjadi kesalahan', 'error');
                        }
                        return;
                    }

                    window.location.href = data.redirect;

                } catch (error) {
                    showToast(error.message, 'error');
                } finally {
                    paymentBtn.disabled = false;
                    paymentBtn.innerHTML =
                        '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />' +
                        '</svg>' +
                        'Proses Pembayaran';
                }
            });
        });

        // Copy to clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show toast notification
                showToast('Nomor rekening berhasil disalin!', 'success');
            });
        }

        // File upload handler
        function handleFileUpload(input) {
            const file = input.files[0];
            if (file) {
                const filePreview = document.getElementById('file_preview');
                const fileName = document.getElementById('file_name');

                fileName.textContent = file.name;
                filePreview.classList.remove('hidden');
            }
        }

        // Remove file function
        function removeFile() {
            const fileInput = document.getElementById('bukti_transfer');
            const filePreview = document.getElementById('file_preview');

            fileInput.value = '';
            filePreview.classList.add('hidden');
        }

        // Toast notification function
        //     function showToast(message, type = 'info') {
        //         const toast = document.createElement('div');
        //         toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
    //     type === 'success' ? 'bg-green-500' :
    //     type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    // }`;
        //         toast.textContent = message;

        //         document.body.appendChild(toast);

        //         setTimeout(() => {
        //             toast.remove();
        //         }, 3000);
        //     }

        function showToast(message, type = 'info', duration = 3000) {
            // Hapus toast yang ada
            document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `custom-toast fixed top-4 right-4 px-4 py-3 rounded-lg text-white z-50 ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
            toast.innerHTML = message; // Gunakan innerHTML untuk menerima tag <br>

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, duration);
        }
        // Fungsi untuk menampilkan modal timeout
        function showTimeoutModal() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-center mb-4">
                <svg class="h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Waktu Pembayaran Habis</h3>
            <p class="text-sm text-gray-500 text-center mb-4">
                Maaf, waktu pembayaran Anda telah habis. Silakan lakukan pemesanan ulang.
            </p>
            <div class="flex justify-center">
                <button onclick="this.parentElement.parentElement.remove(); window.location.href='{{ route('wisatawan.pemesanan') }}'"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Kembali ke Pemesanan
                </button>
            </div>
        </div>
    `;
            document.body.appendChild(modal);
        }
    </script>
@endpush
