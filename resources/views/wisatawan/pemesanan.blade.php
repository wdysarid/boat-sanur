@extends('layouts.wisatawan')

@section('title', 'Pemesanan Tiket')

@section('content')
    @if (!isset($ticket) || !$ticket)
        <!-- Modal Pilih Jadwal -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-10 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-xl p-6 max-w-md w-full">
                <div class="flex justify-center mb-4">
                    <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Belum Memilih Jadwal</h3>
                <p class="text-sm text-gray-500 text-center mb-6">
                    Silakan pilih jadwal perjalanan terlebih dahulu untuk melanjutkan pemesanan.
                </p>
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('search.tickets') }}"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center">
                        Cari Jadwal Sekarang
                    </a>
                    <a href="{{ route('wisatawan.dashboard') }}"
                        class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    @endif

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
                                <span class="ml-4 text-sm font-medium text-gray-900">Pemesanan Tiket</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-4">
                    <h1 class="text-3xl font-bold text-gray-900">Detail Pemesanan</h1>
                    <p class="mt-2 text-gray-600">Lengkapi informasi penumpang untuk melanjutkan pemesanan</p>
                </div>
            </div>

            <!-- Booking Progress -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="flex items-center justify-center space-x-4 text-sm">
                    <div class="flex items-center text-blue-600">
                        <div
                            class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                            1</div>
                        <span class="ml-3 font-medium">Detail Penumpang</span>
                    </div>
                    <div class="w-16 h-px bg-gray-300"></div>
                    <div class="flex items-center text-gray-400">
                        <div
                            class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">
                            2</div>
                        <span class="ml-3">Pembayaran</span>
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
                <!-- Main Form Section -->
                <div class="lg:col-span-2">
                    <form id="bookingForm" method="POST" action="{{ route('wisatawan.pemesanan.proses') }}"
                        class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Hidden Fields for Ticket Data -->
                        <input type="hidden" name="jadwal_id" value="{{ $ticket['id'] ?? '' }}">
                        <input type="hidden" name="departure_date" value="{{ request('departure_date') }}">
                        <input type="hidden" name="from" value="{{ request('from') }}">
                        <input type="hidden" name="to" value="{{ request('to') }}">
                        {{-- <input type="hidden" name="passenger_type" value="{{ request('passenger_type') }}"> --}}

                        <!-- Passenger Count Selection -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Jumlah Penumpang
                            </h2>

                            <div class="flex items-center space-x-4">
                                <div class="w-32">
                                    <label for="passenger_count" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex items-center">
                                        <button type="button" id="decreasePassengers"
                                            class="px-3 py-2 bg-gray-200 text-gray-700 rounded-l-lg hover:bg-gray-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" id="passenger_count" name="passenger_count" min="1"
                                            max="10" value="{{ request('passenger_count', 1) }}"
                                            class="w-11 text-center py-2 border-y border-gray-300 focus:outline-none"
                                            readonly>
                                        <button type="button" id="increasePassengers"
                                            class="px-3 py-2 bg-gray-200 text-gray-700 rounded-r-lg hover:bg-gray-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">
                                        Jumlah penumpang yang akan melakukan perjalanan. Maksimal 10 orang per pemesanan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Main Passenger (Pemesan) -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Informasi Pemesan
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" required
                                        value="{{ old('nama_lengkap', Auth::user()->nama ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="Masukkan nama lengkap">
                                    @error('nama_lengkap')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="no_telepon" name="no_telpon" required
                                        value="{{ old('no_telepon', Auth::user()->no_telp ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="Contoh: +62812345678">
                                    @error('no_telepon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="no_identitas" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Identitas (KTP/Passport) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="no_identitas" name="no_identitas" required
                                        value="{{ old('no_identitas') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="Masukkan nomor identitas">
                                    @error('no_identitas')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required
                                        value="{{ old('email', Auth::user()->email ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="contoh@email.com">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                                        Usia <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="usia" name="usia" required min="1"
                                        max="120" value="{{ old('usia') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="Masukkan usia">
                                    @error('usia')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="laki-laki"
                                            {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="perempuan"
                                            {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Passengers Container -->
                        <div id="additional-passengers-container" class="space-y-6">
                            <!-- Additional passenger forms will be dynamically added here -->
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" id="terms" name="terms" required
                                    class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="terms" class="text-sm text-gray-700">
                                    Saya menyetujui <a href="#"
                                        class="text-blue-600 hover:underline font-medium">syarat dan ketentuan</a>
                                    serta <a href="#" class="text-blue-600 hover:underline font-medium">kebijakan
                                        privasi</a> yang berlaku.
                                    <span class="text-red-500">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between">
                            {{-- <a href="{{ route('wisatawan.dashboard') }}"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Kembali
                            </a> --}}
                            <button type="button" id="backButton"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                Kembali
                            </button>
                            <button type="submit"
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Lanjutkan ke Pembayaran
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Booking Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Ringkasan Pemesanan</h2>

                        @if (isset($ticket) && $ticket)
                            <!-- Ticket Details -->
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center space-x-3">

                                    @if (isset($ticket['image']) && $ticket['image'] !== '/images/boats/default-boat.jpg')
                                        <img src="{{ $ticket['image'] }}" alt="{{ $ticket['boat_name'] }}"
                                            class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center border border-gray-200">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 2 0 002 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $ticket['boat_name'] ?? 'Semabu Hills Fast Boat' }}</h3>
                                        <p class="text-sm text-gray-600">{{ $ticket['duration'] ?? '45 menit' }}</p>
                                    </div>
                                </div>

                                <div class="border-t pt-4 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Rute</span>
                                        <span class="text-sm font-medium">
                                            {{ ucfirst(str_replace('_', ' ', request('from', 'sanur'))) }} →
                                            {{ ucfirst(str_replace('_', ' ', request('to', 'nusa_penida'))) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Tanggal</span>
                                        <span class="text-sm font-medium">
                                            {{ \Carbon\Carbon::parse(request('departure_date', date('Y-m-d')))->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Waktu</span>
                                        <span
                                            class="text-sm font-medium">{{ $ticket['departure_time'] ?? '06:30' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Penumpang</span>
                                        <span class="text-sm font-medium"
                                            id="passenger-count-display">{{ request('passenger_count', 1) }} orang</span>
                                    </div>
                                    {{-- <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Tipe</span>
                                        <span
                                            class="text-sm font-medium">{{ request('passenger_type') == 'foreign' ? 'Asing' : 'Domestik' }}</span>
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-t pt-4 mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Harga per orang</span>
                                    <span class="text-sm">Rp
                                        {{ number_format($ticket['price'] ?? 145000, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Jumlah</span>
                                    <span class="text-sm"
                                        id="passenger-multiplier">{{ request('passenger_count', 1) }}x</span>
                                </div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Biaya Admin</span>
                                    <span class="text-sm">Rp 5.000</span>
                                </div>
                                <div class="flex justify-between items-center font-semibold text-lg border-t pt-2">
                                    <span>Total</span>
                                    <span class="text-blue-600" id="total-price">
                                        Rp
                                        {{ number_format(($ticket['price'] ?? 145000) * request('passenger_count', 1) + 5000, 0, ',', '.') }}
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

                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum memilih jadwal</h3>
                                <p class="text-gray-500 mb-6">
                                    Silakan pilih jadwal perjalanan terlebih dahulu untuk melanjutkan pemesanan.
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

                        <!-- Contact Support -->
                        <div class="border-t pt-4">
                            <p class="text-xs text-gray-500 text-center mb-3">Butuh bantuan?</p>
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

    <!-- Modal Konfirmasi Kembali -->
    <div id="confirmBackModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <div class="flex justify-center mb-4">
                <svg class="h-12 w-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Yakin ingin keluar?</h3>
            <p class="text-sm text-gray-500 text-center mb-6">
                Data yang sudah diisi tidak akan tersimpan. Anda akan kembali ke halaman dashboard.
            </p>
            <div class="flex justify-center space-x-4">
                <button id="cancelBackBtn" type="button"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Batal
                </button>
                <a href="{{ route('wisatawan.dashboard') }}" id="confirmBackBtn"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    Ya, Kembali
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables
            const passengerCountInput = document.getElementById('passenger_count');
            const decreaseBtn = document.getElementById('decreasePassengers');
            const increaseBtn = document.getElementById('increasePassengers');
            const additionalPassengersContainer = document.getElementById('additional-passengers-container');
            const passengerCountDisplay = document.getElementById('passenger-count-display');
            const passengerMultiplier = document.getElementById('passenger-multiplier');
            const totalPriceDisplay = document.getElementById('total-price');
            const ticketPrice = {{ $ticket['price'] ?? 145000 }};
            const adminFee = 5000;

            const backButton = document.getElementById('backButton');
            const confirmBackModal = document.getElementById('confirmBackModal');
            const cancelBackBtn = document.getElementById('cancelBackBtn');

            if (backButton && confirmBackModal && cancelBackBtn) {
                backButton.addEventListener('click', function() {
                    confirmBackModal.classList.remove('hidden');
                });

                cancelBackBtn.addEventListener('click', function() {
                    confirmBackModal.classList.add('hidden');
                });
            }


            // FITUR BARU: Page Leave Confirmation
            let hasUnsavedChanges = false;
            let isSubmitting = false;
            const hasTicketSelected = {{ isset($ticket) && $ticket ? 'true' : 'false' }};

            // Track form changes untuk mendeteksi perubahan
            const formInputs = document.querySelectorAll(
                '#bookingForm input, #bookingForm select, #bookingForm textarea');
            formInputs.forEach(input => {
                input.addEventListener('change', function() {
                    hasUnsavedChanges = true;
                });
                input.addEventListener('input', function() {
                    hasUnsavedChanges = true;
                });
            });

            // Prevent page leave confirmation saat submit form
            const form = document.getElementById('bookingForm');
            form.addEventListener('submit', function() {
                isSubmitting = true;
            });

            // Show confirmation saat user mencoba leave page
            window.addEventListener('beforeunload', function(e) {
                // Hanya tampilkan konfirmasi jika ada perubahan, tidak sedang submit, dan ada tiket yang dipilih
                if (hasUnsavedChanges && !isSubmitting && hasTicketSelected) {
                    const confirmationMessage =
                        'Jika Anda keluar dari halaman ini, tiket yang sudah dipilih akan hilang. Apakah Anda yakin ingin meninggalkan halaman?';
                    e.preventDefault();
                    e.returnValue = confirmationMessage;
                    return confirmationMessage;
                }
            });

            // Handle navigation via browser back/forward buttons
            window.addEventListener('popstate', function(e) {
                if (hasUnsavedChanges && !isSubmitting && hasTicketSelected) {
                    const confirmLeave = confirm(
                        'Jika Anda keluar dari halaman ini, tiket yang sudah dipilih akan hilang. Apakah Anda yakin ingin meninggalkan halaman?'
                    );
                    if (!confirmLeave) {
                        // Push current state back untuk prevent navigation
                        history.pushState(null, null, window.location.href);
                    }
                }
            });

            // Handle clicks pada navigation links
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link && link.href && !link.href.includes('#') && hasUnsavedChanges && !isSubmitting &&
                    hasTicketSelected) {
                    // Skip confirmation untuk form submission buttons
                    if (link.closest('#bookingForm')) {
                        return;
                    }

                    const confirmLeave = confirm(
                        'Jika Anda keluar dari halaman ini, tiket yang sudah dipilih akan hilang. Apakah Anda yakin ingin meninggalkan halaman?'
                    );
                    if (!confirmLeave) {
                        e.preventDefault();
                        return false;
                    }
                }
            });

            // Initialize passenger forms
            updatePassengerForms();

            const modal = document.querySelector('.fixed.inset-0');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.remove();
                    }
                });
            }

            // Event listeners for passenger count buttons
            decreaseBtn.addEventListener('click', function() {
                if (parseInt(passengerCountInput.value) > 1) {
                    passengerCountInput.value = parseInt(passengerCountInput.value) - 1;
                    updatePassengerForms();
                    updatePriceSummary();
                }
            });

            increaseBtn.addEventListener('click', function() {
                if (parseInt(passengerCountInput.value) < 10) {
                    passengerCountInput.value = parseInt(passengerCountInput.value) + 1;
                    updatePassengerForms();
                    updatePriceSummary();
                }
            });

            // Function to update passenger forms based on count
            function updatePassengerForms() {
                const passengerCount = parseInt(passengerCountInput.value);
                additionalPassengersContainer.innerHTML = '';

                // Create additional passenger forms if count > 1
                if (passengerCount > 1) {
                    for (let i = 2; i <= passengerCount; i++) {
                        additionalPassengersContainer.appendChild(createPassengerForm(i));
                    }
                }
            }

            // Function to create a passenger form
            function createPassengerForm(index) {
                const formContainer = document.createElement('div');
                formContainer.className = 'bg-white rounded-xl shadow-sm border border-gray-100 p-6';
                formContainer.innerHTML = `
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">${index}</span>
                    Penumpang ${index}
                </h3>
                <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Data Penumpang</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="passenger_${index}_nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="passenger_${index}_nama"
                           name="passengers[${index}][nama_lengkap]"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label for="passenger_${index}_identitas" class="block text-sm font-medium text-gray-700 mb-2">
                        No. Identitas <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="passenger_${index}_identitas"
                           name="passengers[${index}][no_identitas]"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Masukkan nomor identitas">
                </div>

                <div>
                    <label for="passenger_${index}_usia" class="block text-sm font-medium text-gray-700 mb-2">
                        Usia <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="passenger_${index}_usia"
                           name="passengers[${index}][usia]"
                           required
                           min="1"
                           max="120"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Masukkan usia">
                </div>

                <div>
                    <label for="passenger_${index}_gender" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <select id="passenger_${index}_gender"
                            name="passengers[${index}][jenis_kelamin]"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
        `;

                return formContainer;
            }

            // Function to update price summary
            function updatePriceSummary() {
                const passengerCount = parseInt(passengerCountInput.value);
                const totalPrice = (ticketPrice * passengerCount) + adminFee;

                passengerCountDisplay.textContent = `${passengerCount} orang`;
                passengerMultiplier.textContent = `${passengerCount}x`;
                totalPriceDisplay.textContent = `Rp ${formatNumber(totalPrice)}`;
            }

            // Helper function to format number as currency
            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Form submission handler
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';

                try {
                    // Collect all form data
                    const formData = {
                        jadwal_id: form.querySelector('[name="jadwal_id"]').value,
                        departure_date: form.querySelector('[name="departure_date"]').value,
                        from: form.querySelector('[name="from"]').value,
                        to: form.querySelector('[name="to"]').value,
                        passenger_count: form.querySelector('[name="passenger_count"]').value,
                        nama_lengkap: form.querySelector('[name="nama_lengkap"]').value,
                        no_identitas: form.querySelector('[name="no_identitas"]').value,
                        usia: form.querySelector('[name="usia"]').value,
                        jenis_kelamin: form.querySelector('[name="jenis_kelamin"]').value,
                        email: form.querySelector('[name="email"]').value,
                        no_telpon: form.querySelector('[name="no_telpon"]').value,
                        terms: form.querySelector('[name="terms"]').checked ? '1' : '0',
                        passengers: []
                    };

                    // Collect additional passengers
                    const passengerCount = parseInt(document.getElementById('passenger_count').value);
                    if (passengerCount > 1) {
                        for (let i = 2; i <= passengerCount; i++) {
                            formData.passengers.push({
                                nama_lengkap: document.getElementById(`passenger_${i}_nama`)
                                    .value,
                                no_identitas: document.getElementById(
                                    `passenger_${i}_identitas`).value,
                                usia: document.getElementById(`passenger_${i}_usia`).value,
                                jenis_kelamin: document.getElementById(`passenger_${i}_gender`)
                                    .value
                            });
                        }
                    }

                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        // Display validation errors if any
                        if (data.errors) {
                            let errorMessages = [];
                            for (const [field, errors] of Object.entries(data.errors)) {
                                errorMessages.push(...errors);
                            }
                            showToast(errorMessages.join('<br>'), 'error');
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan server');
                        }
                    } else if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error(data.message || 'Pemesanan gagal');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast(error.message, 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Lanjutkan ke Pembayaran';
                }
            });

            function showToast(message, type = 'info') {
                const container = document.getElementById('toast-container') || document.body;

                // Remove existing toasts
                document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());

                const toast = document.createElement('div');
                toast.className = `custom-toast fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
                    type === 'success' ? 'bg-green-500' :
                    type === 'error' ? 'bg-red-500' : 'bg-blue-500'
                }`;
                toast.innerHTML = message; // Allows HTML content

                container.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 5000);
            }

            function calculateTotalPrice() {
                const passengerCount = parseInt(document.getElementById('passenger_count').value);
                const ticketPrice = {{ $ticket['price'] ?? 145000 }};
                return (passengerCount * ticketPrice) + 5000; // Include admin fee
            }

            function showError(message) {
                // Implement your error display logic here
                alert(message); // Ganti dengan notifikasi yang lebih baik
            }

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

            // Add validation for dynamically created identity inputs
            additionalPassengersContainer.addEventListener('input', function(e) {
                if (e.target.id && e.target.id.includes('_identitas')) {
                    e.target.value = e.target.value.replace(/[^a-zA-Z0-9]/g, '');
                }
            });

        });
    </script>
@endpush
