@extends('layouts.wisatawan')

@section('title', 'Dashboard Wisatawan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? 'Wisatawan' }}! 👋</h1>
                        <p class="text-blue-100 text-lg">Kelola perjalanan Anda dengan mudah dan nyaman</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('wisatawan.pemesanan') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Pesan Tiket Baru</h3>
                        <p class="text-sm text-gray-600">Buat pemesanan perjalanan baru</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('wisatawan.pembayaran') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Kelola Pembayaran</h3>
                        <p class="text-sm text-gray-600">Cek status dan upload bukti bayar</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('wisatawan.konfirmasi') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">Konfirmasi Tiket</h3>
                        <p class="text-sm text-gray-600">Lihat dan konfirmasi tiket Anda</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Tiket Aktif</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeTickets ?? 100 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Perjalanan Selesai</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $completedTrips ?? 100 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Pembayaran Pending</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingPayments ?? 100 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Pengeluaran</h3>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalSpent ?? 100, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- My Recent Tickets -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Tiket Terbaru</h3>
                        <a href="{{ route('wisatawan.tiket') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Sample Recent Tickets -->
                        @forelse($recentTickets as $ticket)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $ticket['kode_pemesanan'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $ticket['rute_asal'] }} → {{ $ticket['rute_tujuan'] }}</p>
                                    <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($ticket['created_at'])->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="px-2 py-1 text-xs font-medium {{ $ticket['badge_class'] }} rounded-full">
                                        {{ $ticket['status'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-gray-500">Belum ada tiket</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Sample Recent Activities -->
                        @forelse($recentActivities as $activity)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-{{ $activity['color'] }}-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900">{{ $activity['title'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-gray-500">Belum ada aktivitas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Trips -->
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Perjalanan Mendatang</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sample Upcoming Trip -->
                        @forelse($upcomingTrips as $trip)
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-blue-600">{{ $trip['kode_pemesanan'] }}</span>
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Terverifikasi</span>
                                </div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-lg font-semibold text-gray-900">{{ $trip['rute_asal'] }}</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m-4-4H3" />
                                    </svg>
                                    <span class="text-lg font-semibold text-gray-900">{{ $trip['rute_tujuan'] }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($trip['tanggal'])->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $trip['waktu_berangkat'] }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $trip['jumlah_penumpang'] }} Penumpang
                                    </div>
                                </div>
                                {{-- <div class="mt-3 pt-3 border-t border-gray-100">
                                    <a href="{{ route('wisatawan.tiket') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Detail →</a>
                                </div> --}}
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <button onclick="viewTicketDetails('{{ $trip['id'] }}')" class="text-sm text-blue-600 hover:text-blue-800 font-medium cursor-pointer">
                                        Lihat Detail →
                                    </button>
                                </div>
                            </div>
                        @empty
                            <!-- Empty State or Add More Trips -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-300 transition-colors">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada perjalanan mendatang</h3>
                                <p class="mt-1 text-sm text-gray-500">Pesan tiket baru untuk perjalanan berikutnya</p>
                                <div class="mt-4">
                                    <a href="{{ route('search.tickets') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Pesan Tiket
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi untuk menampilkan modal detail tiket
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

    // Fungsi untuk menampilkan modal detail
    function showTicketDetailModal(ticket, qrCodeDataUri) {
        // Buat modal jika belum ada
        if (!document.getElementById('ticketDetailModal')) {
            const modalHTML = `
                <div id="ticketDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 overflow-hidden max-h-[90vh] overflow-y-auto">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-800" id="ticketDetailTitle">Detail Tiket</h3>
                            <button id="closeTicketDetailModal" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-6" id="ticketDetailContent">
                            <!-- Detail akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Tambahkan event listeners
            document.getElementById('closeTicketDetailModal').addEventListener('click', closeTicketDetailModal);

            document.getElementById('ticketDetailModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeTicketDetailModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeTicketDetailModal();
                }
            });
        }

        // Format tanggal
        const formattedDate = new Date(ticket.jadwal.tanggal).toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        // Daftar penumpang
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

        // Status pembayaran
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

        // QR Code Section
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

        // Isi konten modal
        document.getElementById('ticketDetailTitle').textContent = `Detail Tiket ${ticket.kode_pemesanan}`;
        document.getElementById('ticketDetailContent').innerHTML = `
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

        // Fungsi toggle untuk bukti pembayaran
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

        // Tampilkan modal
        document.getElementById('ticketDetailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup modal detail
    function closeTicketDetailModal() {
        const modal = document.getElementById('ticketDetailModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Fungsi helper untuk status
    function getStatusClass(status) {
        switch (status) {
            case 'menunggu': return 'bg-yellow-100 text-yellow-800';
            case 'diproses': return 'bg-blue-100 text-blue-800';
            case 'sukses':
            case 'terverifikasi': return 'bg-green-100 text-green-800';
            case 'dibatalkan':
            case 'ditolak': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    function getStatusText(status) {
        switch (status) {
            case 'menunggu': return 'Menunggu Pembayaran';
            case 'diproses': return 'Sedang Diproses';
            case 'sukses': return 'Terkonfirmasi';
            case 'terverifikasi': return 'Terverifikasi';
            case 'dibatalkan': return 'Dibatalkan';
            case 'ditolak': return 'Ditolak';
            default: return status;
        }
    }

    function getPaymentMethodText(method) {
        switch (method) {
            case 'transfer': return 'Transfer Bank';
            case 'qris': return 'QRIS';
            default: return method;
        }
    }

    // Fungsi untuk download tiket PDF
    function downloadTicket(ticketId) {
        window.location.href = `/wisatawan/tiket/${ticketId}/pdf`;
    }

    // Fungsi untuk menampilkan toast
    function showToast(message, type = 'info') {
        const container = document.getElementById('toast-container') || document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        if (!document.getElementById('toast-container')) {
            document.body.appendChild(container);
        }

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
