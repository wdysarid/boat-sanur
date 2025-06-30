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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" data-stat="total">0</p>
                            <p class="text-sm text-gray-600">Total Tiket</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" data-stat="upcoming">0</p>
                            <p class="text-sm text-gray-600">Akan Datang</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" data-stat="pending">0</p>
                            <p class="text-sm text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-2xl font-bold text-gray-900" data-stat="completed">0</p>
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
                            :class="activeTab === 'all' ? 'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                            Semua Tiket
                        </button>
                        <button @click="activeTab = 'upcoming'; filterTickets('upcoming')"
                            :class="activeTab === 'upcoming' ? 'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                            Akan Datang
                        </button>
                        <button @click="activeTab = 'pending'; filterTickets('pending')"
                            :class="activeTab === 'pending' ? 'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                            Pending
                        </button>
                        <button @click="activeTab = 'completed'; filterTickets('completed')"
                            :class="activeTab === 'completed' ? 'border-blue-500 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                            Selesai
                        </button>
                    </nav>

                    <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" id="search-ticket" placeholder="Cari tiket..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets List -->
            <div class="space-y-6" id="ticketsList">
                <!-- Tiket akan dimuat di sini melalui JavaScript -->
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada tiket ditemukan</h3>
                <p class="mt-2 text-gray-500">Tiket dengan filter yang dipilih tidak tersedia.</p>
                <div class="mt-6">
                    <a href="{{ route('wisatawan.pemesanan') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Pesan Tiket Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Tiket Modal -->
    <div id="ticketDetailModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800" id="ticketDetailTitle">Detail Tiket</h3>
                <button id="closeTicketDetailModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6" id="ticketDetailContent">
                <!-- Detail akan diisi oleh JavaScript -->
            </div>
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

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Global variables
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
                        // Refresh list tiket
                        filterTickets('all');
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

        function filterTickets(status) {
            showLoading();

            const url = `/wisatawan/tiket/status/${status}`;

            fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const tickets = Array.isArray(data.data) ? data.data : [];
                        renderTickets(tickets);
                        updateStats(data.stats);
                    } else {
                        throw new Error(data.message || 'Gagal memuat data tiket');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast(error.message || 'Terjadi kesalahan saat memuat tiket', 'error');
                    document.getElementById('emptyState').classList.remove('hidden');
                    document.getElementById('ticketsList').classList.add('hidden');
                })
                .finally(() => {
                    hideLoading();
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

        function renderTickets(tickets) {
            const container = document.getElementById('ticketsList');
            const emptyState = document.getElementById('emptyState');

            container.innerHTML = '';

            if (!tickets || tickets.length === 0) {
                emptyState.classList.remove('hidden');
                container.classList.add('hidden');
                return;
            }

            const validTickets = tickets.filter(ticket => {
                if (!ticket.id) {
                    console.warn('Invalid ticket skipped:', ticket);
                    return false;
                }
                return true;
            });

            if (validTickets.length === 0) {
                emptyState.classList.remove('hidden');
                container.classList.add('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            container.classList.remove('hidden');

            validTickets.forEach(ticket => {
                const ticketElement = createTicketElement(ticket);
                container.appendChild(ticketElement);
            });
        }

        function createTicketElement(ticket) {
            let status, bgColor, textColor, statusText, badgeClass, statusMessage;

            if (ticket.status === 'sukses') {
                if (ticket.pembayaran?.status === 'terverifikasi') {
                    const today = new Date();
                    const ticketDate = new Date(ticket.jadwal.tanggal);

                    if (ticketDate >= today) {
                        status = 'upcoming';
                        bgColor = 'bg-green-500';
                        textColor = 'text-green-100';
                        statusText = 'Dikonfirmasi';
                        badgeClass = 'bg-green-400 text-green-900';
                        statusMessage = '✅ Tiket sudah dikonfirmasi. Tiba di pelabuhan 30 menit sebelum keberangkatan.';
                    } else {
                        status = 'completed';
                        bgColor = 'bg-gray-500';
                        textColor = 'text-gray-100';
                        statusText = 'Selesai';
                        badgeClass = 'bg-gray-400 text-gray-900';
                        statusMessage = 'Perjalanan selesai dengan sukses';
                    }
                } else if (ticket.pembayaran?.status === 'menunggu') {
                    status = 'pending';
                    bgColor = 'bg-yellow-500';
                    textColor = 'text-yellow-100';
                    statusText = 'Menunggu Konfirmasi';
                    badgeClass = 'bg-yellow-400 text-yellow-900';
                    statusMessage = '⏳ Pembayaran sedang diverifikasi. Estimasi konfirmasi: 1-2 jam kerja.';
                } else if (ticket.pembayaran?.status === 'ditolak') {
                    status = 'completed';
                    bgColor = 'bg-red-500';
                    textColor = 'text-red-100';
                    statusText = 'Pembayaran Ditolak';
                    badgeClass = 'bg-red-400 text-red-900';
                    statusMessage = '❌ Pembayaran ditolak. Silakan hubungi customer service atau lakukan pemesanan ulang.';
                } else {
                    status = 'pending';
                    bgColor = 'bg-yellow-500';
                    textColor = 'text-yellow-100';
                    statusText = 'Menunggu Pembayaran';
                    badgeClass = 'bg-yellow-400 text-yellow-900';
                    statusMessage = '⚠️ Silakan lakukan pembayaran untuk memproses tiket Anda.';
                }
            } else if (ticket.status === 'diproses') {
                status = 'pending';
                bgColor = 'bg-yellow-500';
                textColor = 'text-yellow-100';
                statusText = 'Sedang Diproses';
                badgeClass = 'bg-yellow-400 text-yellow-900';
                statusMessage = '⏳ Tiket sedang diproses. Mohon tunggu konfirmasi.';
            } else if (ticket.status === 'menunggu') {
                status = 'pending';
                bgColor = 'bg-yellow-500';
                textColor = 'text-yellow-100';
                statusText = 'Menunggu Pembayaran';
                badgeClass = 'bg-yellow-400 text-yellow-900';
                statusMessage = '⚠️ Silakan lakukan pembayaran untuk memproses tiket Anda.';
            } else if (ticket.status === 'dibatalkan') {
                status = 'completed';
                bgColor = 'bg-red-500';
                textColor = 'text-red-100';
                statusText = 'Dibatalkan';
                badgeClass = 'bg-red-400 text-red-900';
                statusMessage = 'Tiket ini telah dibatalkan.';
            } else {
                status = 'pending';
                bgColor = 'bg-gray-500';
                textColor = 'text-gray-100';
                statusText = 'Status Tidak Diketahui';
                badgeClass = 'bg-gray-400 text-gray-900';
                statusMessage = 'Status tiket tidak diketahui. Silakan hubungi customer service.';
            }

            const ticketDate = new Date(ticket.jadwal.tanggal);
            const formattedDate = ticketDate.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });

            const totalHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(ticket.total_harga);

            const ticketDiv = document.createElement('div');
            ticketDiv.className =
                `bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ticket-card ${status === 'completed' ? 'opacity-75' : ''}`;
            ticketDiv.dataset.status = status;

            ticketDiv.innerHTML = `
                <div class="${bgColor} px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-lg font-semibold">${ticket.kode_pemesanan}</h3>
                            <p class="${textColor} text-sm">${ticket.jadwal.rute_asal} → ${ticket.jadwal.rute_tujuan}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 ${badgeClass} text-sm font-medium rounded-lg">
                                ${statusText}
                            </span>
                            <p class="${textColor} text-xs mt-1">${formattedDate}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <span class="text-gray-600">Waktu:</span>
                            <p class="font-medium">${ticket.jadwal.waktu_berangkat} - ${ticket.jadwal.waktu_tiba}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Penumpang:</span>
                            <p class="font-medium">${ticket.jumlah_penumpang} orang</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Kapal:</span>
                            <p class="font-medium">${ticket.jadwal.kapal.nama_kapal}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Total:</span>
                            <p class="font-medium">${totalHarga}</p>
                        </div>
                    </div>

                    <div class="${status === 'pending' ? 'bg-yellow-50 border border-yellow-200' : status === 'upcoming' ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-gray-200'} rounded-lg p-3 mb-4">
                        <p class="text-sm ${status === 'pending' ? 'text-yellow-800' : status === 'upcoming' ? 'text-green-800' : 'text-gray-800'}">
                            ${statusMessage}
                        </p>
                    </div>

                    <div class="flex justify-between items-center">
                        ${renderTicketActions(ticket, status)}
                    </div>
                </div>
            `;

            return ticketDiv;
        }

        function renderTicketActions(ticket, status) {
            if (!ticket.id) {
                console.error('Invalid ticket data in renderTicketActions:', ticket);
                return '';
            }

            let actions = '';

            if (status === 'pending') {
                actions = `
                    <div class="flex space-x-3">
                        <button onclick="viewTicketDetails('${ticket.id}')"
                            class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                            Lihat Detail
                        </button>
                        ${ticket.status === 'menunggu' ? `
                                <a href="{{ route('wisatawan.pembayaran') }}?tiket_id=${ticket.id}"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg font-medium transition-colors">
                                    Bayar Sekarang
                                </a>
                            ` : ''}
                    </div>
                    ${ticket.status === 'menunggu' || ticket.status === 'diproses' ? `
                            <button onclick="cancelTicket('${ticket.id}')"
                                class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                Batalkan
                            </button>
                        ` : ''}
                `;
            } else if (status === 'upcoming') {
                actions = `
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
                        <button onclick="viewTicketDetails('${ticket.id}')"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg font-medium transition-colors">
                            Lihat Detail
                        </button>
                        <button onclick="downloadTicket('${ticket.id}')"
                            class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm rounded-lg font-medium transition-colors">
                            Cetak E-Tiket
                        </button>
                    </div>
                `;
            } else if (status === 'completed') {
                actions = `
                    <div class="flex justify-center space-x-3">
                        <button onclick="viewTicketDetails('${ticket.id}')"
                            class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                `;
            }

            return actions;
        }

        function updateStats(stats) {
            document.querySelector('[data-stat="total"]').textContent = stats.total;
            document.querySelector('[data-stat="upcoming"]').textContent = stats.upcoming;
            document.querySelector('[data-stat="pending"]').textContent = stats.pending;
            document.querySelector('[data-stat="completed"]').textContent = stats.completed;
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

        function showTicketDetailModal(ticket, qrCodeDataUri) {
            const modal = document.getElementById('ticketDetailModal');
            const title = document.getElementById('ticketDetailTitle');
            const content = document.getElementById('ticketDetailContent');

            const formattedDate = new Date(ticket.jadwal.tanggal).toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            let passengerList = '';
            if (ticket.penumpang && ticket.penumpang.length > 0) {
                passengerList = ticket.penumpang.map(passenger => `
                        <div class="border-b border-gray-200 py-2">
                            <div class="flex justify-between">
                                <span class="font-medium">${passenger.nama_lengkap}</span>
                                <span class="text-sm text-gray-500">${passenger.no_identitas}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>${passenger.jenis_kelamin === 'laki-laki' ? 'Laki-laki' : 'Perempuan'}, ${passenger.usia} tahun</span>
                                ${passenger.is_pemesan ? '<span class="text-blue-600">Pemesan</span>' : ''}
                            </div>
                        </div>
                    `).join('');
            } else {
                passengerList = '<p class="text-sm text-gray-500">Tidak ada data penumpang</p>';
            }

            let paymentStatus = '';
            if (ticket.pembayaran) {
                paymentStatus = `
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Status Pembayaran</span>
                            <span class="text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(ticket.pembayaran.status)}">
                                    ${getStatusText(ticket.pembayaran.status)}
                                </span>
                            </span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Metode Pembayaran</span>
                            <span class="text-sm text-gray-900">${getPaymentMethodText(ticket.pembayaran.metode_bayar)}</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Jumlah Bayar</span>
                            <span class="text-sm text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(ticket.pembayaran.jumlah_bayar)}</span>
                        </div>
                    `;
            } else {
                paymentStatus = '<p class="text-sm text-gray-500">Belum ada data pembayaran</p>';
            }

            // QR Code Section - Optimized untuk format sederhana
            let qrCodeSection = '';
            if (qrCodeDataUri && ticket.status === 'sukses' && ticket.pembayaran?.status === 'terverifikasi') {
                qrCodeSection = `
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
            <div class="text-center">
                <h4 class="text-lg font-semibold text-blue-800 mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    QR Code Boarding Pass
                </h4>
                <div class="bg-white rounded-xl p-6 shadow-lg inline-block border-4 border-blue-300">
                    <img src="${qrCodeDataUri}" alt="QR Code Tiket" class="w-48 h-48 mx-auto mb-4 border border-gray-200 rounded-lg" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div style="display:none;" class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-gray-500 text-sm">QR Code tidak tersedia</span>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-gray-800 mb-1">Tunjukkan QR Code ini saat boarding</p>
                        <p class="text-xs text-gray-500 mb-2">Kode: ${ticket.kode_pemesanan}</p>
                        <div class="bg-gray-100 rounded-lg p-2 mb-4">
                            <p class="text-xs text-gray-600 font-mono">${ticket.kode_pemesanan}</p>
                        </div>
                        <button onclick="downloadTicket('${ticket.id}')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-md">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Cetak E-Tiket PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
            }

            title.textContent = `Detail Tiket ${ticket.kode_pemesanan}`;
            content.innerHTML = `
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Perjalanan</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Rute</span>
                            <span class="text-sm text-gray-900">${ticket.jadwal.rute_asal} → ${ticket.jadwal.rute_tujuan}</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                            <span class="text-sm text-gray-900">${formattedDate}</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Waktu</span>
                            <span class="text-sm text-gray-900">${ticket.jadwal.waktu_berangkat} - ${ticket.jadwal.waktu_tiba}</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Kapal</span>
                            <span class="text-sm text-gray-900">${ticket.jadwal.kapal.nama_kapal}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Tiket</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Kode Pemesanan</span>
                            <span class="text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">${ticket.kode_pemesanan}</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Status Tiket</span>
                            <span class="text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(ticket.status)}">
                                    ${getStatusText(ticket.status)}
                                </span>
                            </span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Jumlah Penumpang</span>
                            <span class="text-sm text-gray-900">${ticket.jumlah_penumpang} orang</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Total Harga</span>
                            <span class="text-sm text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(ticket.total_harga)}</span>
                        </div>
                    </div>

                    <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Informasi Pembayaran</h4>
                    <div class="space-y-3">
                        ${paymentStatus}
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-500 mb-4">Daftar Penumpang</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    ${passengerList}
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-4">
                <h4 class="text-sm font-medium text-gray-500 mb-4 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2v12a2 2 0 002 2z"/>
                    </svg>
                    Bukti Pembayaran
                </h4>
                ${ticket.pembayaran?.bukti_transfer_url ? `
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="p-3 bg-gray-50 border-b border-gray-200">
                                <button onclick="togglePaymentProof()" class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 hover:text-gray-900">
                                    <span>Lihat Bukti Transfer</span>
                                    <svg id="paymentProofIcon" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                            </div>
                            <div id="paymentProofContent" class="hidden p-3">
                                <img src="${ticket.pembayaran.bukti_transfer_url}" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg border mb-3">
                                <div class="flex justify-center">
                                    <a href="${ticket.pembayaran.bukti_transfer_url}" download class="px-3 py-2 border border-gray-300 rounded-md text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    ` : '<p class="text-sm text-gray-500 bg-gray-50 rounded-lg p-4">Tidak ada bukti pembayaran</p>'}
            </div>
        </div>
    </div>
    ${qrCodeSection}
`;

            window.togglePaymentProof = function() {
                const content = document.getElementById('paymentProofContent');
                const icon = document.getElementById('paymentProofIcon');

                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    content.classList.add('hidden');
                    icon.style.transform = 'rotate(0deg)';
                }
            };

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeTicketDetailModal() {
            const modal = document.getElementById('ticketDetailModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function getStatusClass(status) {
            switch (status) {
                case 'menunggu':
                    return 'bg-yellow-100 text-yellow-800';
                case 'diproses':
                    return 'bg-blue-100 text-blue-800';
                case 'sukses':
                case 'terverifikasi':
                    return 'bg-green-100 text-green-800';
                case 'dibatalkan':
                case 'ditolak':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'menunggu':
                    return 'Menunggu Pembayaran';
                case 'diproses':
                    return 'Sedang Diproses';
                case 'sukses':
                    return 'Terkonfirmasi';
                case 'terverifikasi':
                    return 'Terverifikasi';
                case 'dibatalkan':
                    return 'Dibatalkan';
                case 'ditolak':
                    return 'Ditolak';
                default:
                    return status;
            }
        }

        function getPaymentMethodText(method) {
            switch (method) {
                case 'transfer':
                    return 'Transfer Bank';
                case 'qris':
                    return 'QRIS';
                default:
                    return method;
            }
        }

        function downloadTicket(ticketId) {
            showToast('Memproses unduhan PDF...', 'info');
            window.location.href = `/wisatawan/tiket/${ticketId}/pdf`;
        }

        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className =
                `flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;

            let icon = '';
            let colorClass = '';

            switch (type) {
                case 'success':
                    colorClass = 'text-green-500';
                    icon =
                        `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>`;
                    break;
                case 'error':
                    colorClass = 'text-red-500';
                    icon =
                        `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>`;
                    break;
                default:
                    colorClass = 'text-blue-500';
                    icon =
                        `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>`;
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

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal buttons
            document.getElementById('closeCancelTicketModal').addEventListener('click', closeCancelTicketModal);
            document.getElementById('cancelCancelTicket').addEventListener('click', closeCancelTicketModal);

            // Confirm cancellation button
            document.getElementById('confirmCancelTicket').addEventListener('click', confirmTicketCancellation);

            // Close modal when clicking outside
            document.getElementById('cancelTicketModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCancelTicketModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('cancelTicketModal');
                    if (!modal.classList.contains('hidden')) {
                        closeCancelTicketModal();
                    }
                }
            });

            // Detail modal event listeners
            const closeButton = document.getElementById('closeTicketDetailModal');
            if (closeButton) {
                closeButton.addEventListener('click', closeTicketDetailModal);
            }

            const modal = document.getElementById('ticketDetailModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeTicketDetailModal();
                    }
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeTicketDetailModal();
                }
            });

            // Load initial tickets
            filterTickets('all');
        });
    </script>
@endpush
