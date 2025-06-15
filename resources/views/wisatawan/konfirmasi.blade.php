@extends('layouts.wisatawan')

@section('title', 'Konfirmasi Tiket')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success Message -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold mb-2">Pemesanan Berhasil!</h1>
                <p class="text-green-100 text-lg mb-4">Terima kasih telah memesan tiket dengan kami</p>
                <div class="bg-white bg-opacity-10 rounded-xl p-4 inline-block">
                    <p class="text-sm font-medium mb-1">Kode Pemesanan Anda:</p>
                    <p class="text-2xl font-bold tracking-wider">{{ $booking_code ?? 'TKT-' . strtoupper(uniqid()) }}</p>
                </div>
            </div>
        </div>

        <!-- Status Information -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Status Pemesanan</h3>
                    <div class="space-y-2 text-blue-800">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm">✅ Pemesanan berhasil dibuat</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3 animate-pulse"></div>
                            <span class="text-sm">⏳ Menunggu konfirmasi pembayaran (1-2 jam)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">📧 E-tiket akan dikirim via email</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-gray-300 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-600">🎫 Siap untuk perjalanan</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 bg-blue-100 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <span class="font-medium">💡 Tips:</span> Simpan kode pemesanan Anda dan periksa email secara berkala untuk update status tiket.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <nav class="flex space-x-8" x-data="{ activeTab: 'all' }">
                <button @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Semua Tiket (5)
                </button>
                <button @click="activeTab = 'upcoming'"
                        :class="activeTab === 'upcoming' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Akan Datang (2)
                </button>
                <button @click="activeTab = 'completed'"
                        :class="activeTab === 'completed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Selesai (2)
                </button>
                <button @click="activeTab = 'cancelled'"
                        :class="activeTab === 'cancelled' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Dibatalkan (1)
                </button>
            </nav>
        </div>

        <!-- Tickets List -->
        <div class="space-y-6">
            <!-- Dummy Ticket 1 - Pending (Just Booked) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Ticket Header -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $booking_code ?? 'TKT-ABC12345' }}</h3>
                            <p class="text-yellow-100 text-sm">E-Tiket Perjalanan • Baru Dipesan</p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 bg-yellow-400 text-yellow-900 text-sm font-medium rounded-xl flex items-center">
                                <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Menunggu Konfirmasi
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ticket Content -->
                <div class="p-6">
                    <!-- Route Information -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Sanur</div>
                            <div class="text-sm text-gray-500">08:30</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::tomorrow()->format('d M Y') }}</div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-16 h-0.5 bg-yellow-500"></div>
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <div class="w-16 h-0.5 bg-yellow-500"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Nusa Penida</div>
                            <div class="text-sm text-gray-500">10:00</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::tomorrow()->format('d M Y') }}</div>
                        </div>
                    </div>

                    <!-- Passenger Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Detail Penumpang</h4>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <span class="text-yellow-600 font-semibold text-sm">1</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'John Doe' }}</p>
                                        <p class="text-xs text-gray-500">28 tahun, Laki-laki</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <span class="text-yellow-600 font-semibold text-sm">2</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Jane Smith</p>
                                        <p class="text-xs text-gray-500">25 tahun, Perempuan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Informasi Tiket</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Kelas Tiket:</span>
                                    <span class="text-sm font-medium text-gray-900">Economy</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Jumlah Penumpang:</span>
                                    <span class="text-sm font-medium text-gray-900">2 orang</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total Harga:</span>
                                    <span class="text-sm font-medium text-gray-900">Rp 295.000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Status Pembayaran:</span>
                                    <span class="text-sm font-medium text-yellow-600">Menunggu Verifikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waiting Status -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-yellow-800">Sedang Memproses Pembayaran</p>
                                    <p class="text-xs text-yellow-700">Tim kami sedang memverifikasi pembayaran Anda. Proses ini biasanya memakan waktu 1-2 jam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dummy Ticket 2 - Confirmed -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-DEF67890</h3>
                            <p class="text-green-100 text-sm">E-Tiket Perjalanan • Dikonfirmasi</p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 bg-green-400 text-green-900 text-sm font-medium rounded-xl flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Dikonfirmasi
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Nusa Penida</div>
                            <div class="text-sm text-gray-500">14:30</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('+3 days')->format('d M Y') }}</div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div class="w-16 h-0.5 bg-green-500"></div>
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <div class="w-16 h-0.5 bg-green-500"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Sanur</div>
                            <div class="text-sm text-gray-500">16:00</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('+3 days')->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Detail Penumpang</h4>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center">
                                        <span class="text-green-600 font-semibold text-sm">1</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Michael Johnson</p>
                                        <p class="text-xs text-gray-500">32 tahun, Laki-laki</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Informasi Tiket</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Kelas Tiket:</span>
                                    <span class="text-sm font-medium text-gray-900">Premium</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Jumlah Penumpang:</span>
                                    <span class="text-sm font-medium text-gray-900">1 orang</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total Harga:</span>
                                    <span class="text-sm font-medium text-gray-900">Rp 175.000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Status Pembayaran:</span>
                                    <span class="text-sm font-medium text-green-600">Lunas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code and Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- QR Code -->
                                <div class="w-20 h-20 bg-green-100 border-2 border-green-300 rounded-xl flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">QR Code Check-in</p>
                                    <p class="text-xs text-gray-500">Tunjukkan QR code ini saat check-in</p>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <button onclick="downloadTicket('DEF67890')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-xl font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download E-Tiket
                                </button>
                                <button onclick="shareTicket('DEF67890')" class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm rounded-xl font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                    </svg>
                                    Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dummy Ticket 3 - Completed -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden opacity-75">
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-GHI11223</h3>
                            <p class="text-gray-100 text-sm">E-Tiket Perjalanan • Selesai</p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 bg-gray-400 text-gray-900 text-sm font-medium rounded-xl">
                                Perjalanan Selesai
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Sanur</div>
                            <div class="text-sm text-gray-500">09:00</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('-2 days')->format('d M Y') }}</div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                                <div class="w-16 h-0.5 bg-gray-400"></div>
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="w-16 h-0.5 bg-gray-400"></div>
                                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Lembongan</div>
                            <div class="text-sm text-gray-500">10:30</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('-2 days')->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="text-center py-4">
                        <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">Perjalanan telah selesai dengan sukses</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Terima kasih telah menggunakan layanan kami!</p>
                    </div>
                </div>
            </div>

            <!-- Dummy Ticket 4 - Cancelled -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden opacity-60">
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-JKL44556</h3>
                            <p class="text-red-100 text-sm">E-Tiket Perjalanan • Dibatalkan</p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 bg-red-400 text-red-900 text-sm font-medium rounded-xl">
                                Dibatalkan
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-800">Tiket Dibatalkan</p>
                                <p class="text-xs text-red-700">Pembayaran tidak diterima dalam batas waktu yang ditentukan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dummy Ticket 5 - Upcoming -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-MNO77889</h3>
                            <p class="text-blue-100 text-sm">E-Tiket Perjalanan • Akan Datang</p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 bg-blue-400 text-blue-900 text-sm font-medium rounded-xl">
                                Siap Berangkat
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Sanur</div>
                            <div class="text-sm text-gray-500">07:00</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('+7 days')->format('d M Y') }}</div>
                        </div>

                        <div class="flex-1 flex items-center justify-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <div class="w-16 h-0.5 bg-blue-500"></div>
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <div class="w-16 h-0.5 bg-blue-500"></div>
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Gili Trawangan</div>
                            <div class="text-sm text-gray-500">09:30</div>
                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse('+7 days')->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Reminder Perjalanan</p>
                                <p class="text-xs text-blue-700">Jangan lupa tiba di pelabuhan 30 menit sebelum keberangkatan</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button onclick="downloadTicket('MNO77889')" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download E-Tiket
                        </button>
                        <button onclick="setReminder('MNO77889')" class="px-4 py-2 border border-blue-300 hover:bg-blue-50 text-blue-700 text-sm rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 4.828A4 4 0 015.5 4H9v1H5.5a3 3 0 00-2.121.879L4.828 4.828zM15 8h-2v5.5a.5.5 0 01-.5.5H7a.5.5 0 01-.5-.5V8H4.5A2.5 2.5 0 002 5.5v-1A2.5 2.5 0 014.5 2H15v6z"/>
                            </svg>
                            Set Reminder
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function downloadTicket(ticketId) {
    showToast('Mengunduh E-Tiket untuk ' + ticketId + '...', 'success');
    // Implementasi download e-tiket
}

function shareTicket(ticketId) {
    if (navigator.share) {
        navigator.share({
            title: 'E-Tiket Fast Boat',
            text: 'Lihat tiket perjalanan saya: ' + ticketId,
            url: window.location.href
        });
    } else {
        // Fallback untuk browser yang tidak support Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            showToast('Link tiket berhasil disalin!', 'success');
        });
    }
}

function setReminder(ticketId) {
    showToast('Reminder berhasil diatur untuk tiket ' + ticketId, 'success');
    // Implementasi set reminder
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-xl text-white z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    toast.textContent = message;

    document.body.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

// Auto refresh status for pending tickets
setInterval(() => {
    // Simulate status check for pending tickets
    const pendingTickets = document.querySelectorAll('[data-status="pending"]');
    // In real app, this would make an AJAX call to check status
}, 30000); // Check every 30 seconds
</script>
@endpush
