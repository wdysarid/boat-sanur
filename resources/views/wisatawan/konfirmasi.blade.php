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
                                <span class="ml-4 text-sm font-medium text-gray-900">Konfirmasi Tiket</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            @if (!isset($tiket) || !$tiket)
                <!-- Modal untuk tidak ada tiket aktif -->
                <div id="noActiveTicketModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 px-4">
                    <div class="bg-white rounded-xl p-6 max-w-md w-full">
                        <div class="flex justify-center mb-4">
                            <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Belum Ada Tiket Aktif</h3>
                        <p class="text-sm text-gray-500 text-center mb-6">
                            Anda belum memiliki tiket aktif. Silakan pesan tiket terlebih dahulu.
                        </p>
                        <div class="flex flex-col space-y-3">
                            <a href="{{ route('search.tickets') }}"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center">
                                Cari Jadwal & Pesan Tiket
                            </a>
                            <a href="{{ route('wisatawan.dashboard') }}"
                                class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($tiket) && $tiket)
                <!-- Booking Progress - 3 Buletan -->
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
                        <div class="flex items-center text-green-600">
                            <div
                                class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Pembayaran</span>
                        </div>
                        <div class="w-16 h-px bg-green-600"></div>
                        <div class="flex items-center text-green-600">
                            <div
                                class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 font-medium">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="bg-green-500 rounded-2xl p-8 text-white text-center mb-8">
                    <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold mb-2">Pemesanan Berhasil!</h1>
                    <p class="text-green-100 mb-6">Terima kasih telah memesan tiket dengan kami</p>

                    <div class="bg-white rounded-xl p-4 inline-block">
                        <p class="text-sm text-gray-600 mb-1">Kode Pemesanan Anda:</p>
                        <p class="text-xl font-bold text-gray-900">{{ $tiket->kode_pemesanan }}</p>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Status Pemesanan</h3>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Step 1: Booking created -->
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-green-800">Pemesanan berhasil dibuat</p>
                                <p class="text-xs text-green-600">{{ $tiket->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Step 2: Payment status -->
                        @if ($tiket->pembayaran)
                            @if ($tiket->pembayaran->status === 'terverifikasi')
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-green-800">Pembayaran berhasil diverifikasi</p>
                                        <p class="text-xs text-green-600">
                                            {{ $tiket->pembayaran->updated_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            @elseif ($tiket->pembayaran->status === 'ditolak')
                                <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                    <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-red-800">Pembayaran ditolak</p>
                                        <p class="text-xs text-red-600">
                                            {{ $tiket->pembayaran->updated_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                                    <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-yellow-800">Menunggu konfirmasi pembayaran</p>
                                        <p class="text-xs text-yellow-600">Estimasi: 1-2 jam kerja</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Belum melakukan pembayaran</p>
                                    <p class="text-xs text-gray-500">Silakan selesaikan pembayaran</p>
                                </div>
                            </div>
                        @endif

                        <!-- Step 3: E-ticket status -->
                        @if ($tiket->status === 'sukses' && $tiket->pembayaran && $tiket->pembayaran->status === 'terverifikasi')
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-800">E-tiket telah dikirim via email</p>
                                    <p class="text-xs text-green-600">{{ $tiket->updated_at->format('d M Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">E-tiket akan dikirim via email</p>
                                    <p class="text-xs text-gray-500">Setelah pembayaran dikonfirmasi</p>
                                </div>
                            </div>
                        @endif

                        <!-- Step 4: Trip status -->
                        @if ($tiket->status === 'sukses')
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-800">Siap untuk perjalanan</p>
                                    <p class="text-xs text-green-600">Tunjukkan e-tiket saat check-in</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Belum siap untuk perjalanan</p>
                                    <p class="text-xs text-gray-500">Selesaikan proses pembayaran terlebih dahulu</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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

                <!-- Ticket List -->
                <div class="space-y-4">
                    <!-- Current Booking -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        @if ($tiket->status === 'sukses' && $tiket->pembayaran && $tiket->pembayaran->status === 'terverifikasi')
                            <div class="bg-green-500 px-6 py-3">
                                <div class="flex items-center justify-between text-white">
                                    <div>
                                        <h3 class="font-semibold">{{ $tiket->kode_pemesanan }}</h3>
                                        <p class="text-green-100 text-sm">{{ ucfirst($tiket->jadwal->rute_asal) }} →
                                            {{ ucfirst($tiket->jadwal->rute_tujuan) }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-400 text-green-900 text-sm font-medium rounded-lg">
                                        Dikonfirmasi
                                    </span>
                                </div>
                            </div>
                        @elseif ($tiket->status === 'dibatalkan' || ($tiket->pembayaran && $tiket->pembayaran->status === 'ditolak'))
                            <div class="bg-red-500 px-6 py-3">
                                <div class="flex items-center justify-between text-white">
                                    <div>
                                        <h3 class="font-semibold">{{ $tiket->kode_pemesanan }}</h3>
                                        <p class="text-red-100 text-sm">{{ ucfirst($tiket->jadwal->rute_asal) }} →
                                            {{ ucfirst($tiket->jadwal->rute_tujuan) }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-red-400 text-red-900 text-sm font-medium rounded-lg">
                                        Dibatalkan
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-500 px-6 py-3">
                                <div class="flex items-center justify-between text-white">
                                    <div>
                                        <h3 class="font-semibold">{{ $tiket->kode_pemesanan }}</h3>
                                        <p class="text-yellow-100 text-sm">{{ ucfirst($tiket->jadwal->rute_asal) }} →
                                            {{ ucfirst($tiket->jadwal->rute_tujuan) }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-sm font-medium rounded-lg">
                                        @if ($tiket->pembayaran && $tiket->pembayaran->status === 'menunggu')
                                            Menunggu Konfirmasi
                                        @else
                                            Belum Dibayar
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Tanggal:</span>
                                    <span
                                        class="font-medium ml-2">{{ \Carbon\Carbon::parse($tiket->jadwal->tanggal)->format('d M Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Waktu:</span>
                                    <span class="font-medium ml-2">{{ $tiket->jadwal->waktu_berangkat }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Penumpang:</span>
                                    <span class="font-medium ml-2">{{ $tiket->jumlah_penumpang }} orang</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Total:</span>
                                    <span class="font-medium ml-2">Rp
                                        {{ number_format($tiket->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            @if ($tiket->status === 'sukses' && $tiket->pembayaran && $tiket->pembayaran->status === 'terverifikasi')
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium">QR Code Check-in</p>
                                            <p class="text-xs text-gray-500">Siap untuk perjalanan</p>
                                        </div>
                                    </div>

                                    <button onclick="downloadTicket('{{ $tiket->id }}')"
                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg font-medium transition-colors">
                                        Download E-Tiket
                                    </button>
                                </div>
                            @elseif ($tiket->status === 'dibatalkan' || ($tiket->pembayaran && $tiket->pembayaran->status === 'ditolak'))
                                <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                                    <p class="text-sm text-red-800">
                                        Pemesanan ini telah dibatalkan. Silakan buat pemesanan baru jika ingin melanjutkan.
                                    </p>
                                </div>
                            @else
                                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800">
                                        @if ($tiket->pembayaran && $tiket->pembayaran->status === 'menunggu')
                                            Pembayaran sedang diverifikasi. Anda akan menerima konfirmasi dalam 1-2 jam.
                                        @else
                                            Silakan selesaikan pembayaran untuk mengkonfirmasi tiket Anda.
                                        @endif
                                    </p>
                                </div>
                            @endif

                            @if ($tiket->status === 'menunggu' || ($tiket->pembayaran && $tiket->pembayaran->status === 'menunggu'))
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex space-x-3">
                                        {{-- <button onclick="viewTicketDetails('{{ $tiket->id }}')"
                                            class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                            Lihat Detail
                                        </button> --}}
                                        @if ($tiket->status === 'menunggu' || $tiket->status === 'diproses')
                                            <button onclick="cancelTicket('{{ $tiket->id }}')"
                                                class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                                Batalkan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>

                <!-- Simple Actions -->
                <div class="mt-8 text-center">
                    <a href="{{ route('wisatawan.dashboard') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Konfirmasi Pembatalan Tiket -->
    <div id="cancelTicketModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Konfirmasi Pembatalan
                    </h3>
                    <button id="closeCancelTicketModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <!-- Warning Icon -->
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>

                <!-- Ticket Info -->
                <div id="cancelTicketInfo" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h4 class="font-medium text-gray-900 mb-2">Detail Tiket yang akan dibatalkan:</h4>
                    <div class="space-y-1 text-sm text-gray-600">
                        <p><span class="font-medium">Kode:</span> <span id="cancelTicketCode">-</span></p>
                        <p><span class="font-medium">Rute:</span> <span id="cancelTicketRoute">-</span></p>
                        <p><span class="font-medium">Tanggal:</span> <span id="cancelTicketDate">-</span></p>
                        <p><span class="font-medium">Penumpang:</span> <span id="cancelTicketPassengers">-</span></p>
                    </div>
                </div>

                <!-- Warning Message -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 mb-1">Peringatan Penting!</h4>
                            <ul class="text-sm text-red-700 space-y-1">
                                <li>• Tiket yang dibatalkan tidak dapat dikembalikan</li>
                                <li>• Pembayaran yang sudah dilakukan akan diproses sesuai kebijakan</li>
                                <li>• Aksi ini tidak dapat dibatalkan</li>
                                <li>• Jika butuh bantuan, hubungi Customer Service: <strong>+62 361 3377890</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Question -->
                <p class="text-center text-gray-700 font-medium mb-6">
                    Apakah Anda yakin ingin membatalkan tiket ini?
                </p>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <button id="cancelCancelTicket"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Tidak, Batalkan
                </button>
                <button id="confirmCancelTicket"
                    class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Ya, Batalkan Tiket
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function downloadTicket(ticketId) {
            showToast('Memproses unduhan PDF...', 'info');
            window.location.href = `/wisatawan/tiket/${ticketId}/pdf`;
        }

        let currentTicketToCancel = null;

        // Fungsi untuk membatalkan tiket dengan modal konfirmasi
        function cancelTicket(ticketId) {
            fetchTicketDataForCancellation(ticketId);
        }

        // Fetch ticket data untuk modal konfirmasi
        function fetchTicketDataForCancellation(ticketId) {
            showLoading();

            fetch(`/wisatawan/tiket/${ticketId}/detail`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal memuat data tiket');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showCancelTicketModal(data.data);
                    } else {
                        throw new Error(data.message || 'Gagal memuat data tiket');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Gagal memuat data tiket: ' + error.message, 'error');
                })
                .finally(() => {
                    hideLoading();
                });
        }

        // Tampilkan modal konfirmasi pembatalan dengan data tiket
        function showCancelTicketModal(ticket) {
            currentTicketToCancel = ticket;

            // Populate modal dengan data tiket
            document.getElementById('cancelTicketCode').textContent = ticket.kode_pemesanan;
            document.getElementById('cancelTicketRoute').textContent =
                `${ticket.jadwal.rute_asal} → ${ticket.jadwal.rute_tujuan}`;

            // Format tanggal
            const ticketDate = new Date(ticket.jadwal.tanggal);
            document.getElementById('cancelTicketDate').textContent =
                ticketDate.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

            document.getElementById('cancelTicketPassengers').textContent =
                `${ticket.jumlah_penumpang} orang`;

            // Tampilkan modal
            const modal = document.getElementById('cancelTicketModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Focus pada tombol batal untuk accessibility
            setTimeout(() => {
                document.getElementById('cancelCancelTicket').focus();
            }, 100);
        }

        // Tutup modal konfirmasi
        function closeCancelTicketModal() {
            const modal = document.getElementById('cancelTicketModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentTicketToCancel = null;
        }

        // Konfirmasi pembatalan tiket
        function confirmTicketCancellation() {
            if (!currentTicketToCancel) {
                showToast('Data tiket tidak valid', 'error');
                return;
            }

            const confirmBtn = document.getElementById('confirmCancelTicket');
            const originalText = confirmBtn.innerHTML;

            // Disable button dan show loading
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = `
                <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Membatalkan...
            `;

            fetch(`/api/tiket/${currentTicketToCancel.id}/batal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal membatalkan tiket');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        closeCancelTicketModal();
                        showToast('Tiket berhasil dibatalkan', 'success');
                        // Refresh halaman untuk update status
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Gagal membatalkan tiket');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast(error.message || 'Terjadi kesalahan saat membatalkan tiket', 'error');
                })
                .finally(() => {
                    // Restore button
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = originalText;
                });
        }

        function viewTicketDetails(ticketId) {
            fetch(`/wisatawan/tiket/${ticketId}/detail`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showTicketDetailModal(data.data, data.qr_code);
                    } else {
                        showToast(data.message || 'Gagal memuat detail tiket', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat memuat detail tiket', 'error');
                });
        }

        function showLoading() {
            const loader = document.createElement('div');
            loader.id = 'loading-overlay';
            loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loader.innerHTML = `
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600"></div>
                    </div>
                    <p class="mt-4 text-center">Memuat data...</p>
                </div>
            `;
            document.body.appendChild(loader);
        }

        function hideLoading() {
            const loader = document.getElementById('loading-overlay');
            if (loader) {
                loader.remove();
            }
        }

        // Simple toast notification
        function showToast(message, type = 'info') {
            const container = document.createElement('div');
            container.className = 'fixed top-4 right-4 z-50';

            const toast = document.createElement('div');
            toast.className = `flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;

            let icon = '';
            let colorClass = '';

            switch (type) {
                case 'success':
                    colorClass = 'text-green-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>`;
                    break;
                case 'error':
                    colorClass = 'text-red-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>`;
                    break;
                default:
                    colorClass = 'text-blue-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>`;
            }

            toast.innerHTML = `
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${colorClass} bg-opacity-20 rounded-lg">
                    ${icon}
                </div>
                <div class="ml-3 text-sm font-medium text-gray-900">${message}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;

            container.appendChild(toast);
            document.body.appendChild(container);

            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    container.remove();
                }, 300);
            }, 4000);
        }


        // Show modal if no active ticket
        document.addEventListener('DOMContentLoaded', function() {
            @if (!isset($tiket) || !$tiket)
                const modal = document.getElementById('noActiveTicketModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            // Prevent closing modal by clicking outside
                            e.preventDefault();
                        }
                    });
                }
            @endif

            // Close modal buttons
            document.getElementById('closeCancelTicketModal')?.addEventListener('click', closeCancelTicketModal);
            document.getElementById('cancelCancelTicket')?.addEventListener('click', closeCancelTicketModal);

            // Confirm cancellation button
            document.getElementById('confirmCancelTicket')?.addEventListener('click', confirmTicketCancellation);

            // Close modal when clicking outside
            document.getElementById('cancelTicketModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCancelTicketModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('cancelTicketModal');
                    if (modal && !modal.classList.contains('hidden')) {
                        closeCancelTicketModal();
                    }

                    const detailModal = document.getElementById('ticketDetailModal');
                    if (detailModal) {
                        detailModal.remove();
                        document.body.style.overflow = 'auto';
                    }
                }
            });
        });
    </script>
@endpush
