@extends('layouts.wisatawan')

@section('title', 'Tiket Saya')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                            <span class="ml-4 text-sm font-medium text-gray-900">Tiket Saya</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="mt-4">
                <h1 class="text-3xl font-bold text-gray-900">Tiket Saya</h1>
                <p class="mt-2 text-gray-600">Kelola dan lihat semua tiket perjalanan Anda</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">15</p>
                        <p class="text-sm text-gray-600">Total Tiket</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">3</p>
                        <p class="text-sm text-gray-600">Akan Datang</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">1</p>
                        <p class="text-sm text-gray-600">Pending</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">11</p>
                        <p class="text-sm text-gray-600">Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <nav class="flex space-x-8" x-data="{ activeTab: 'all' }">
                    <button @click="activeTab = 'all'; filterTickets('all')"
                            :class="activeTab === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Semua Tiket
                    </button>
                    <button @click="activeTab = 'upcoming'; filterTickets('upcoming')"
                            :class="activeTab === 'upcoming' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Akan Datang
                    </button>
                    <button @click="activeTab = 'pending'; filterTickets('pending')"
                            :class="activeTab === 'pending' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Pending
                    </button>
                    <button @click="activeTab = 'completed'; filterTickets('completed')"
                            :class="activeTab === 'completed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                        Selesai
                    </button>
                </nav>

                <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                    <div class="relative">
                        <input type="text" placeholder="Cari tiket..."
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button onclick="exportTickets()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg font-medium transition-colors">
                        Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Tickets List -->
        <div class="space-y-6" id="ticketsList">
            <!-- Pending Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ticket-card" data-status="pending">
                <div class="bg-yellow-500 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-ABC12345</h3>
                            <p class="text-yellow-100 text-sm">Sanur → Nusa Penida</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-sm font-medium rounded-lg">
                                Menunggu Konfirmasi
                            </span>
                            <p class="text-yellow-100 text-xs mt-1">{{ \Carbon\Carbon::tomorrow()->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <p class="font-medium">08:30 - 10:00</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <p class="font-medium">2 orang</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Kelas:</span>
                            <p class="font-medium">Economy</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <p class="font-medium">Rp 295.000</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                        <p class="text-sm text-yellow-800">
                            ⏳ Pembayaran sedang diverifikasi. Estimasi konfirmasi: 1-2 jam kerja.
                        </p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            <button onclick="viewTicketDetails('ABC12345')" class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                Lihat Detail
                            </button>
                            <button onclick="contactSupport('ABC12345')" class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-colors">
                                Hubungi Support
                            </button>
                        </div>
                        <button onclick="cancelTicket('ABC12345')" class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                            Batalkan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Confirmed Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ticket-card" data-status="upcoming">
                <div class="bg-green-500 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-DEF67890</h3>
                            <p class="text-green-100 text-sm">Nusa Penida → Sanur</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-green-400 text-green-900 text-sm font-medium rounded-lg">
                                Dikonfirmasi
                            </span>
                            <p class="text-green-100 text-xs mt-1">{{ \Carbon\Carbon::parse('+3 days')->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <p class="font-medium">14:30 - 16:00</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <p class="font-medium">1 orang</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Kelas:</span>
                            <p class="font-medium">Premium</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <p class="font-medium">Rp 175.000</p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                        <p class="text-sm text-green-800">
                            ✅ Tiket sudah dikonfirmasi. Tiba di pelabuhan 30 menit sebelum keberangkatan.
                        </p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium">QR Code Ready</p>
                                <p class="text-xs text-gray-500">Siap untuk check-in</p>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <button onclick="downloadTicket('DEF67890')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg font-medium transition-colors">
                                Download E-Tiket
                            </button>
                            <button onclick="shareTicket('DEF67890')" class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm rounded-lg font-medium transition-colors">
                                Bagikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ticket-card" data-status="upcoming">
                <div class="bg-blue-500 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-GHI11223</h3>
                            <p class="text-blue-100 text-sm">Sanur → Gili Trawangan</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-blue-400 text-blue-900 text-sm font-medium rounded-lg">
                                Siap Berangkat
                            </span>
                            <p class="text-blue-100 text-xs mt-1">{{ \Carbon\Carbon::parse('+7 days')->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <p class="font-medium">07:00 - 09:30</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <p class="font-medium">4 orang</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Kelas:</span>
                            <p class="font-medium">Economy</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <p class="font-medium">Rp 580.000</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                        <p class="text-sm text-blue-800">
                            🚢 Perjalanan dalam 7 hari. Jangan lupa bawa dokumen identitas yang valid.
                        </p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            <button onclick="setReminder('GHI11223')" class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                Set Reminder
                            </button>
                            <button onclick="viewRoute('GHI11223')" class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-colors">
                                Lihat Rute
                            </button>
                        </div>

                        <button onclick="downloadTicket('GHI11223')" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg font-medium transition-colors">
                            Download E-Tiket
                        </button>
                    </div>
                </div>
            </div>

            <!-- Completed Ticket -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden opacity-75 ticket-card" data-status="completed">
                <div class="bg-gray-500 px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">TKT-JKL44556</h3>
                            <p class="text-gray-100 text-sm">Sanur → Lembongan</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-gray-400 text-gray-900 text-sm font-medium rounded-lg">
                                Selesai
                            </span>
                            <p class="text-gray-100 text-xs mt-1">{{ \Carbon\Carbon::parse('-2 days')->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-center py-4">
                        <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm mb-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perjalanan selesai dengan sukses
                        </div>
                        <div class="flex justify-center space-x-3">
                            <button onclick="rateTrip('JKL44556')" class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                Beri Rating
                            </button>
                            <button onclick="bookAgain('JKL44556')" class="px-4 py-2 text-green-600 hover:bg-green-50 rounded-lg text-sm font-medium transition-colors">
                                Pesan Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="text-center py-12 hidden">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada tiket ditemukan</h3>
            <p class="mt-2 text-gray-500">Tiket dengan filter yang dipilih tidak tersedia.</p>
            <div class="mt-6">
                <a href="{{ route('wisatawan.dashboard') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    Pesan Tiket Baru
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
// Filter tickets function
function filterTickets(status) {
    const tickets = document.querySelectorAll('.ticket-card');
    const emptyState = document.getElementById('emptyState');
    let visibleCount = 0;

    tickets.forEach(ticket => {
        if (status === 'all' || ticket.dataset.status === status) {
            ticket.style.display = 'block';
            visibleCount++;
        } else {
            ticket.style.display = 'none';
        }
    });

    // Show/hide empty state
    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
}

// Ticket actions
function viewTicketDetails(ticketId) {
    showToast(`Melihat detail tiket ${ticketId}`, 'info');
}

function downloadTicket(ticketId) {
    showToast(`Mengunduh e-tiket ${ticketId}...`, 'success');
}

function shareTicket(ticketId) {
    if (navigator.share) {
        navigator.share({
            title: 'E-Tiket Fast Boat',
            text: `Lihat tiket perjalanan saya: ${ticketId}`,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            showToast('Link tiket berhasil disalin!', 'success');
        });
    }
}

function cancelTicket(ticketId) {
    if (confirm('Apakah Anda yakin ingin membatalkan tiket ini?')) {
        showToast(`Tiket ${ticketId} berhasil dibatalkan`, 'success');
        // Here you would make an API call to cancel the ticket
    }
}

function contactSupport(ticketId) {
    showToast(`Menghubungkan ke customer support untuk tiket ${ticketId}`, 'info');
}

function setReminder(ticketId) {
    showToast(`Reminder berhasil diatur untuk tiket ${ticketId}`, 'success');
}

function viewRoute(ticketId) {
    showToast(`Menampilkan rute perjalanan untuk tiket ${ticketId}`, 'info');
}

function rateTrip(ticketId) {
    showToast(`Membuka form rating untuk tiket ${ticketId}`, 'info');
}

function bookAgain(ticketId) {
    showToast(`Mengulangi pemesanan berdasarkan tiket ${ticketId}`, 'success');
}

function exportTickets() {
    showToast('Mengekspor data tiket...', 'success');
}

// Toast function (same as profile page)
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `
        flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg
        transform transition-all duration-300 ease-in-out translate-x-full opacity-0
    `;

    let icon = '';
    let colorClass = '';

    switch(type) {
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

    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 100);

    setTimeout(() => {
        if (toast.parentElement) {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }
    }, 4000);
}
</script>
@endpush
