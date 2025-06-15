@extends('layouts.wisatawan')

@section('title', 'Konfirmasi Tiket')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('wisatawan.dashboard') }}" class="text-gray-500 hover:text-gray-700">
                            <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4 text-sm font-medium text-gray-900">Konfirmasi Tiket</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Booking Progress - 3 Buletan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-center space-x-4 text-sm">
                <div class="flex items-center text-green-600">
                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium">Detail Penumpang</span>
                </div>
                <div class="w-16 h-px bg-green-600"></div>
                <div class="flex items-center text-green-600">
                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium">Pembayaran</span>
                </div>
                <div class="w-16 h-px bg-green-600"></div>
                <div class="flex items-center text-green-600">
                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium">Konfirmasi</span>
                </div>
            </div>
        </div>

        <!-- Simple Success Message -->
        <div class="bg-green-500 rounded-2xl p-8 text-white text-center mb-8">
            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold mb-2">Pemesanan Berhasil!</h1>
            <p class="text-green-100 mb-6">Terima kasih telah memesan tiket dengan kami</p>

            <div class="bg-white rounded-xl p-4 inline-block">
                <p class="text-sm text-gray-600 mb-1">Kode Pemesanan Anda:</p>
                <p class="text-xl font-bold text-gray-900">{{ $booking_code ?? 'TKT-' . strtoupper(substr(uniqid(), -8)) }}</p>
            </div>
        </div>

        <!-- Simple Professional Status -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
    <div class="flex items-center mb-6">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900">Status Pemesanan</h3>
    </div>

    <div class="space-y-4 mb-6">
        <div class="flex items-center p-3 bg-green-50 rounded-lg">
            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-green-800">Pemesanan berhasil dibuat</p>
                <p class="text-xs text-green-600">{{ now()->format('d M Y, H:i') }} WIB</p>
            </div>
        </div>

        <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
            <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-yellow-800">Menunggu konfirmasi pembayaran</p>
                <p class="text-xs text-yellow-600">Estimasi: 1-2 jam kerja</p>
            </div>
        </div>

        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
            <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">E-tiket akan dikirim via email</p>
                <p class="text-xs text-gray-500">Setelah pembayaran dikonfirmasi</p>
            </div>
        </div>

        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
            <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Siap untuk perjalanan</p>
                <p class="text-xs text-gray-500">Tunjukkan e-tiket saat check-in</p>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-blue-800">Informasi Penting</p>
                <p class="text-sm text-blue-700 mt-1">
                    Simpan kode pemesanan Anda dan periksa email secara berkala.
                    Hubungi customer service di <strong>+62 812-3456-7890</strong> jika butuh bantuan.
                </p>
            </div>
        </div>
    </div>
</div>

        <!-- Simple Ticket List -->
        <div class="space-y-4">
            <!-- Current Booking - Pending -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-yellow-500 px-6 py-3">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="font-semibold">{{ $booking_code ?? 'TKT-' . strtoupper(substr(uniqid(), -8)) }}</h3>
                            <p class="text-yellow-100 text-sm">Sanur → Nusa Penida</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-sm font-medium rounded-lg">
                            Menunggu Konfirmasi
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium ml-2">{{ \Carbon\Carbon::tomorrow()->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <span class="font-medium ml-2">08:30</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <span class="font-medium ml-2">2 orang</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <span class="font-medium ml-2">Rp 295.000</span>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-800">
                            Pembayaran sedang diverifikasi. Anda akan menerima konfirmasi dalam 1-2 jam.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Example Confirmed Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-green-500 px-6 py-3">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="font-semibold">TKT-DEF67890</h3>
                            <p class="text-green-100 text-sm">Nusa Penida → Sanur</p>
                        </div>
                        <span class="px-3 py-1 bg-green-400 text-green-900 text-sm font-medium rounded-lg">
                            Dikonfirmasi
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium ml-2">{{ \Carbon\Carbon::parse('+3 days')->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <span class="font-medium ml-2">14:30</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <span class="font-medium ml-2">1 orang</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <span class="font-medium ml-2">Rp 175.000</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">QR Code Check-in</p>
                                <p class="text-xs text-gray-500">Siap untuk perjalanan</p>
                            </div>
                        </div>

                        <button onclick="downloadTicket('DEF67890')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg font-medium transition-colors">
                            Download E-Tiket
                        </button>
                    </div>
                </div>
            </div>

            <!-- Example Completed Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden opacity-75">
                <div class="bg-gray-500 px-6 py-3">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="font-semibold">TKT-GHI11223</h3>
                            <p class="text-gray-100 text-sm">Sanur → Lembongan</p>
                        </div>
                        <span class="px-3 py-1 bg-gray-400 text-gray-900 text-sm font-medium rounded-lg">
                            Selesai
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-center py-4">
                        <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perjalanan selesai dengan sukses
                        </div>
                        <p class="text-sm text-gray-500 mt-2">{{ \Carbon\Carbon::parse('-2 days')->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Actions -->
        <div class="mt-8 text-center">
            <a href="{{ route('wisatawan.dashboard') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function downloadTicket(ticketId) {
    alert('Mengunduh E-Tiket untuk ' + ticketId);
    // Implementasi download e-tiket
}

// Simple toast notification
function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg z-50';
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endpush
