@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('header', 'Verifikasi Pembayaran')

@section('content')
    <!-- Success/Error Messages -->
    <div id="alertContainer" class="mb-4 hidden">
        <div id="alertMessage" class="p-4 text-sm rounded-lg" role="alert">
            <span class="font-medium" id="alertText"></span>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl p-6 flex items-center space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-700">Memproses...</span>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Statistik Pembayaran</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Total Pembayaran -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-blue-800">Total Pembayaran</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-blue-800" id="totalPayments">{{ $stats['total'] }}</p>
                    <p class="text-sm text-blue-600">Semua pembayaran</p>
                </div>

                <!-- Diverifikasi -->
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-green-800">Diverifikasi</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-green-800" id="verifiedPayments">{{ $stats['verified'] }}</p>
                    <p class="text-sm text-green-600">Sudah diverifikasi</p>
                </div>

                <!-- Menunggu -->
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-yellow-800">Menunggu</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-yellow-800" id="pendingPayments">{{ $stats['pending'] }}</p>
                    <p class="text-sm text-yellow-600">Menunggu verifikasi</p>
                </div>

                <!-- Ditolak -->
                <div class="bg-orange-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-orange-800">Ditolak</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-orange-800" id="rejectedPayments">{{ $stats['rejected'] }}</p>
                    <p class="text-sm text-orange-600">Pembayaran ditolak</p>
                </div>

                <!-- Dibatalkan -->
                <div class="bg-red-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-red-800">Dibatalkan</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-red-800" id="cancelledPayments">{{ $stats['cancelled'] }}</p>
                    <p class="text-sm text-red-600">Pembayaran dibatalkan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Daftar Pembayaran</h3>
            <div class="flex space-x-2">
                <button onclick="loadPaymentData()"
                    class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="h-4 w-4 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh
                </button>
                <div class="relative">
                    <input type="text" id="search-payment"
                        class="pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari pembayaran...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="flex space-x-2" id="status-filters">
                    <button data-status="all"
                        class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-md transition-colors">Semua</button>
                    <button data-status="menunggu"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Menunggu</button>
                    <button data-status="terverifikasi"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Diverifikasi</button>
                    <button data-status="ditolak"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Ditolak</button>
                    <button data-status="dibatalkan"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Dibatalkan</button>
                </div>
            </div>
            <div class="overflow-x-auto" id="payment-container">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                                Pembayaran</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelanggan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiket
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Metode</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="payment-table-body">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4" id="pagination-container">
                <!-- Pagination akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>

    <!-- Detail Pembayaran Modal -->
    <div id="paymentDetailModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 overflow-hidden max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800" id="paymentDetailTitle">Detail Pembayaran</h3>
                <button id="closeDetailModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6" id="paymentDetailContent">
                <!-- Detail akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>

    <!-- Approval Confirmation Modal -->
    <div id="approvalConfirmModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Verifikasi</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin memverifikasi pembayaran ini? E-tiket akan
                            dikirim ke email pelanggan.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
                <button id="confirmApprovalBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="btn-text">Verifikasi</span>
                    <span class="btn-loading hidden">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Memproses...
                    </span>
                </button>
                <button id="cancelApprovalBtn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            </div>
        </div>
    </div>

    <!-- Rejection Confirmation Modal -->
    <div id="rejectionConfirmModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Penolakan</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin menolak pembayaran ini? Tindakan ini tidak
                            dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
                <button id="confirmRejectionBtn"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="btn-text">Tolak</span>
                    <span class="btn-loading hidden">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Memproses...
                    </span>
                </button>
                <button id="cancelRejectionBtn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let currentPaymentId = null;
        let isProcessing = false;

        const elements = {
            alertContainer: document.getElementById('alertContainer'),
            alertMessage: document.getElementById('alertMessage'),
            alertText: document.getElementById('alertText'),
            loadingOverlay: document.getElementById('loadingOverlay')
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Load initial data
            loadPaymentData();

            // Setup event listeners
            document.getElementById('search-payment').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    loadPaymentData();
                }
            });

            // Debounce search input
            let searchTimeout;
            document.getElementById('search-payment').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    loadPaymentData();
                }, 500);
            });

            document.querySelectorAll('#status-filters button').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    document.querySelectorAll('#status-filters button').forEach(btn => {
                        btn.classList.remove('bg-blue-50', 'text-blue-600');
                        btn.classList.add('text-gray-600', 'hover:bg-gray-50');
                    });

                    // Add active class to clicked button
                    this.classList.remove('text-gray-600', 'hover:bg-gray-50');
                    this.classList.add('bg-blue-50', 'text-blue-600');

                    // Reload data with new filter
                    loadPaymentData(1); // Reset to page 1 when changing filter
                });
            });


            document.getElementById('confirmApprovalBtn').addEventListener('click', function() {
                if (currentPaymentId && !isProcessing) {
                    processPaymentStatus(currentPaymentId, 'verifikasi');
                }
            });

            document.getElementById('cancelApprovalBtn').addEventListener('click', closeApprovalModal);

            document.getElementById('confirmRejectionBtn').addEventListener('click', function() {
                if (currentPaymentId && !isProcessing) {
                    processPaymentStatus(currentPaymentId, 'tolak');
                }
            });

            document.getElementById('cancelRejectionBtn').addEventListener('click', closeRejectionModal);

            document.getElementById('closeDetailModal').addEventListener('click', closeDetailModal);

            // Handle clicks in payment detail content
            document.getElementById('paymentDetailContent').addEventListener('click', function(e) {
                if (e.target.closest('[data-action="approve"]')) {
                    const paymentId = e.target.closest('button').dataset.paymentId;
                    showApprovalModal(paymentId);
                } else if (e.target.closest('[data-action="reject"]')) {
                    const paymentId = e.target.closest('button').dataset.paymentId;
                    showRejectionModal(paymentId);
                }
            });

            // Close modals when clicking outside
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('backdrop-blur-sm')) {
                    closeDetailModal();
                    closeApprovalModal();
                    closeRejectionModal();
                }
            });

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDetailModal();
                    closeApprovalModal();
                    closeRejectionModal();
                }
            });
        });

        function showLoading() {
            elements.loadingOverlay.classList.remove('hidden');
        }

        function hideLoading() {
            elements.loadingOverlay.classList.add('hidden');
        }

        function loadPaymentData(page = 1) {
            const status = document.querySelector('#status-filters button.bg-blue-50').dataset.status;
            const search = document.getElementById('search-payment').value;

            showLoading();

            fetch(`/admin/payments/data?status=${status}&search=${search}&page=${page}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Payment data loaded:', data);
                    if (data.success) {
                        updatePaymentTable(data.data || []);
                        updatePagination(data, status, search);
                    } else {
                        console.error('Error:', data.message);
                        showAlert('Gagal memuat data: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading payment data:', error);
                    showAlert('Terjadi kesalahan saat memuat data pembayaran', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
        }

        function updatePaymentTable(payments) {
            const tbody = document.getElementById('payment-table-body');
            tbody.innerHTML = '';

            if (payments.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500" data-title="">
                        Tidak ada data pembayaran yang ditemukan
                    </td>
                </tr>
            `;
                return;
            }

            payments.forEach(payment => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';
                row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-title="ID Pembayaran">${payment.id}</td>
                <td class="px-6 py-4 whitespace-nowrap" data-title="Pelanggan">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-8 w-8">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(payment.user?.nama || 'User')}&background=0D8ABC&color=fff" alt="${payment.user?.nama || 'User'}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${payment.user?.nama || 'User'}</div>
                            <div class="text-sm text-gray-500">${payment.user?.email || '-'}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap" data-title="Tiket">
                    <div class="text-sm text-gray-900">${payment.tiket?.jadwal?.rute_asal || '-'} → ${payment.tiket?.jadwal?.rute_tujuan || '-'}</div>
                    <div class="text-sm text-gray-500">${payment.tiket?.jumlah_penumpang || 0} tiket</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-title="Jumlah">Rp ${formatCurrency(payment.jumlah_bayar)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-title="Metode">${getPaymentMethodText(payment.metode_bayar)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-title="Tanggal">${new Date(payment.created_at).toLocaleDateString('id-ID')}</td>
                <td class="px-6 py-4 whitespace-nowrap" data-title="Status">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(payment.status)}">
                        ${getStatusText(payment.status)}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-title="Aksi">
                    ${renderActionButtons(payment)}
                </td>
            `;
                tbody.appendChild(row);
            });

            // Add event listeners to action buttons
            document.querySelectorAll('.view-payment').forEach(button => {
                button.addEventListener('click', function() {
                    showPaymentDetail(this.dataset.id);
                });
            });

            document.querySelectorAll('.approve-payment').forEach(button => {
                button.addEventListener('click', function() {
                    showApprovalModal(this.dataset.id);
                });
            });

            document.querySelectorAll('.reject-payment').forEach(button => {
                button.addEventListener('click', function() {
                    showRejectionModal(this.dataset.id);
                });
            });
        }

        function updatePagination(data, status, search) {
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            if (!data || data.last_page <= 1) {
                return;
            }

            const showingText = `
        <div class="text-sm text-gray-700 hidden sm:block">
            Menampilkan <span class="font-medium">${data.from || 0}</span> sampai <span class="font-medium">${data.to || 0}</span> dari <span class="font-medium">${data.total || 0}</span> pembayaran
        </div>
    `;

            // Previous button - pertahankan filter saat berpindah halaman
            const prevButton = data.prev_page_url ?
                `<button onclick="loadPaymentData(${data.current_page - 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Sebelumnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Sebelumnya</button>`;

            // Next button - pertahankan filter saat berpindah halaman
            const nextButton = data.next_page_url ?
                `<button onclick="loadPaymentData(${data.current_page + 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Selanjutnya</button>`;

            let pageNumbers = '';
            const maxVisiblePages = 5;
            let startPage, endPage;

            if (data.last_page <= maxVisiblePages) {
                startPage = 1;
                endPage = data.last_page;
            } else {
                const half = Math.floor(maxVisiblePages / 2);
                if (data.current_page <= half + 1) {
                    startPage = 1;
                    endPage = maxVisiblePages;
                } else if (data.current_page >= data.last_page - half) {
                    startPage = data.last_page - maxVisiblePages + 1;
                    endPage = data.last_page;
                } else {
                    startPage = data.current_page - half;
                    endPage = data.current_page + half;
                }
            }

            // Generate page numbers dengan pertahankan filter
            for (let i = startPage; i <= endPage; i++) {
                pageNumbers += `
            <button onclick="loadPaymentData(${i})"
                class="px-3 py-1 border border-gray-300 rounded-md text-sm transition-colors ${i === data.current_page ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'}">
                ${i}
            </button>
        `;
            }

            // Tambahkan ellipsis jika diperlukan
            if (startPage > 1) {
                pageNumbers = `
            <button onclick="loadPaymentData(1)" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">1</button>
            ${startPage > 2 ? '<span class="px-2 text-gray-500">...</span>' : ''}
            ${pageNumbers}
        `;
            }

            if (endPage < data.last_page) {
                pageNumbers = `
            ${pageNumbers}
            ${endPage < data.last_page - 1 ? '<span class="px-2 text-gray-500">...</span>' : ''}
            <button onclick="loadPaymentData(${data.last_page})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">${data.last_page}</button>
        `;
            }

            paginationContainer.innerHTML = `
        ${showingText}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full sm:w-auto">
            <div class="flex items-center gap-2">
                ${prevButton}
                <div class="hidden sm:flex gap-2">
                    ${pageNumbers}
                </div>
                ${nextButton}
            </div>
        </div>
    `;
        }

        function getStatusClass(status) {
            switch (status) {
                case 'menunggu':
                    return 'bg-yellow-100 text-yellow-800';
                case 'terverifikasi':
                    return 'bg-green-100 text-green-800';
                case 'ditolak':
                    return 'bg-red-100 text-red-800';
                case 'dibatalkan':
                    return 'bg-gray-100 text-gray-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'menunggu':
                    return 'Menunggu';
                case 'terverifikasi':
                    return 'Terverifikasi';
                case 'ditolak':
                    return 'Ditolak';
                case 'dibatalkan':
                    return 'Dibatalkan';
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
                    return method || '-';
            }
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID').format(amount || 0);
        }

        function renderActionButtons(payment) {
            const baseClasses = "text-sm font-medium transition-colors";

            if (payment.status === 'terverifikasi') {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment ${baseClasses} text-blue-600 hover:text-blue-900">Lihat</button>
                </div>
            `;
            } else if (payment.status === 'ditolak' || payment.status === 'dibatalkan') {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment ${baseClasses} text-blue-600 hover:text-blue-900">Lihat</button>
                </div>
            `;
            } else {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment ${baseClasses} text-blue-600 hover:text-blue-900">Lihat</button>
                    <button data-id="${payment.id}" class="approve-payment ${baseClasses} text-green-600 hover:text-green-900">Verifikasi</button>
                    <button data-id="${payment.id}" class="reject-payment ${baseClasses} text-red-600 hover:text-red-900">Tolak</button>
                </div>
            `;
            }
        }

        function showApprovalModal(paymentId) {
            currentPaymentId = paymentId;
            document.getElementById('approvalConfirmModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function showRejectionModal(paymentId) {
            currentPaymentId = paymentId;
            document.getElementById('rejectionConfirmModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeApprovalModal() {
            document.getElementById('approvalConfirmModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentPaymentId = null;
            resetButtonState('confirmApprovalBtn');
        }

        function closeRejectionModal() {
            document.getElementById('rejectionConfirmModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentPaymentId = null;
            resetButtonState('confirmRejectionBtn');
        }

        function showPaymentDetail(paymentId) {
            fetch(`/api/pembayaran/${paymentId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Payment detail loaded:', data);
                    if (data.success) {
                        renderPaymentDetail(data.data);
                        document.getElementById('paymentDetailModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        currentPaymentId = paymentId;
                    } else {
                        showAlert(data.message || 'Gagal memuat detail pembayaran', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading payment detail:', error);
                    showAlert('Terjadi kesalahan saat memuat detail pembayaran', 'error');
                });
        }

        function closeDetailModal() {
            document.getElementById('paymentDetailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function renderPaymentDetail(payment) {
            document.getElementById('paymentDetailTitle').textContent = `Detail Pembayaran #${payment.id}`;

            // Prepare passenger list HTML
            let passengerList = '';
            if (payment.tiket?.penumpang?.length > 0) {
                passengerList = payment.tiket.penumpang.map((passenger, index) => `
                    <div class="border-b border-gray-200 py-3 ${index === payment.tiket.penumpang.length - 1 ? 'border-b-0' : ''}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-gray-900">${passenger.nama_lengkap}</span>
                                    ${passenger.is_pemesan ? '<span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Pemesan</span>' : ''}
                                </div>
                                <div class="mt-1 text-sm text-gray-600">
                                    <span>${passenger.jenis_kelamin === 'laki-laki' ? 'Laki-laki' : 'Perempuan'}, ${passenger.usia} tahun</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">${passenger.no_identitas}</div>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                passengerList = '<p class="text-sm text-gray-500 text-center py-4">Tidak ada data penumpang</p>';
            }

            const content = document.getElementById('paymentDetailContent');
            content.innerHTML = `
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Pelanggan</h4>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Nama</span>
                                    <span class="text-sm text-gray-900">${payment.user?.nama || '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Email</span>
                                    <span class="text-sm text-gray-900">${payment.user?.email || '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">No. HP</span>
                                    <span class="text-sm text-gray-900">${payment.user?.no_hp || '-'}</span>
                                </div>
                            </div>

                            <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Informasi Tiket</h4>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Kode Booking</span>
                                    <span class="text-sm text-gray-900 font-mono">${payment.tiket?.kode_pemesanan || '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Rute</span>
                                    <span class="text-sm text-gray-900">${payment.tiket?.jadwal?.rute_asal || '-'} → ${payment.tiket?.jadwal?.rute_tujuan || '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Kapal</span>
                                    <span class="text-sm text-gray-900">${payment.tiket?.jadwal?.kapal?.nama_kapal || '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                                    <span class="text-sm text-gray-900">${payment.tiket?.jadwal?.tanggal ? new Date(payment.tiket.jadwal.tanggal).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) : '-'}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Waktu</span>
                                    <span class="text-sm text-gray-900">${payment.tiket?.jadwal?.waktu_berangkat || '-'} - ${payment.tiket?.jadwal?.waktu_tiba || '-'} WITA</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Jumlah Tiket</span>
                                    <span class="text-sm text-gray-900">${payment.tiket?.jumlah_penumpang || 0} tiket</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Pembayaran</h4>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">ID Pembayaran</span>
                                    <span class="text-sm text-gray-900 font-mono">#${payment.id}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Metode</span>
                                    <span class="text-sm text-gray-900">${getPaymentMethodText(payment.metode_bayar)}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                                    <span class="text-sm text-gray-900">${new Date(payment.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Status</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(payment.status)}">
                                        ${getStatusText(payment.status)}
                                    </span>
                                </div>
                            </div>

                            <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Rincian Biaya</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Tiket (${payment.tiket?.jumlah_penumpang || 0} x Rp ${formatCurrency(payment.tiket?.jadwal?.harga_tiket || 0)})</span>
                                    <span class="text-sm text-gray-900">Rp ${formatCurrency((payment.tiket?.jumlah_penumpang || 0) * (payment.tiket?.jadwal?.harga_tiket || 0))}</span>
                                </div>
                                <div class="pt-2 border-t border-gray-200 flex justify-between">
                                    <span class="text-sm font-medium text-gray-900">Total Dibayar</span>
                                    <span class="text-sm font-medium text-gray-900">Rp ${formatCurrency(payment.jumlah_bayar)}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger List Section -->
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-500 mb-4">Daftar Penumpang (${payment.tiket?.jumlah_penumpang || 0} orang)</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            ${passengerList}
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Bukti Pembayaran</h4>
                    <div class="mb-4">
                        <img src="${payment.bukti_transfer_url || 'https://via.placeholder.com/400x500?text=Tidak+Ada+Gambar'}"
                             alt="Bukti Pembayaran"
                             class="w-full h-auto rounded-lg border border-gray-200 cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="window.open(this.src, '_blank')"
                             onerror="this.src='https://via.placeholder.com/400x500?text=Gambar+Tidak+Ditemukan'">
                    </div>
                    ${payment.bukti_transfer_url ? `
                                    <div class="flex justify-center mb-4">
                                        <a href="${payment.bukti_transfer_url}" target="_blank" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="h-4 w-4 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Unduh Bukti Pembayaran
                                        </a>
                                    </div>
                                    ` : ''}

                    <!-- Tambahkan tombol aksi jika status masih menunggu -->
                    ${payment.status === 'menunggu' ? `
                                    <div class="mt-6 flex flex-col gap-2">
                                        <button data-action="approve" data-payment-id="${payment.id}" class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                            <svg class="h-4 w-4 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Verifikasi Pembayaran
                                        </button>
                                        <button data-action="reject" data-payment-id="${payment.id}" class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                            <svg class="h-4 w-4 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak Pembayaran
                                        </button>
                                    </div>
                                ` : payment.status === 'terverifikasi' ? `
                                    <div class="mt-6 p-4 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-green-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm font-medium text-green-800">Pembayaran telah diverifikasi</span>
                                        </div>
                                        <p class="text-sm text-green-700 mt-1">E-tiket telah dikirim ke email pelanggan</p>
                                    </div>
                                ` : payment.status === 'ditolak' ? `
                                    <div class="mt-6 p-4 bg-red-50 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-red-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            <span class="text-sm font-medium text-red-800">Pembayaran ditolak</span>
                                        </div>
                                    </div>
                                ` : ''}
                </div>
            </div>
            `;
        }

        function setButtonLoading(buttonId, isLoading) {
            const button = document.getElementById(buttonId);
            const textSpan = button.querySelector('.btn-text');
            const loadingSpan = button.querySelector('.btn-loading');

            if (isLoading) {
                textSpan.classList.add('hidden');
                loadingSpan.classList.remove('hidden');
                button.disabled = true;
            } else {
                textSpan.classList.remove('hidden');
                loadingSpan.classList.add('hidden');
                button.disabled = false;
            }
        }

        function resetButtonState(buttonId) {
            setButtonLoading(buttonId, false);
        }

        function processPaymentStatus(paymentId, action) {
            if (isProcessing) return;

            isProcessing = true;
            const buttonId = action === 'verifikasi' ? 'confirmApprovalBtn' : 'confirmRejectionBtn';
            setButtonLoading(buttonId, true);

            console.log(`Processing payment ${paymentId} with action: ${action}`);

            fetch(`/api/pembayaran/${paymentId}/verifikasi`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: action === 'verifikasi' ? 'terverifikasi' : 'ditolak'
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json().then(data => {
                        if (!response.ok) {
                            throw new Error(data.message || 'Network response was not ok');
                        }
                        return data;
                    });
                })
                .then(data => {
                    console.log('Response data:', data);

                    if (data.success) {
                        // Close modals immediately
                        if (action === 'verifikasi') {
                            closeApprovalModal();
                        } else {
                            closeRejectionModal();
                        }
                        closeDetailModal();

                        // Show success notification immediately
                        const message = action === 'verifikasi' ?
                            'Pembayaran berhasil diverifikasi dan e-tiket telah dikirim ke email pelanggan' :
                            'Pembayaran berhasil ditolak';
                        showAlert(message, 'success');

                        // Refresh the data immediately
                        setTimeout(() => {
                            loadPaymentData();
                        }, 100);
                    } else {
                        throw new Error(data.message || 'Gagal memperbarui status pembayaran');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan: ' + error.message, 'error');
                })
                .finally(() => {
                    isProcessing = false;
                    setButtonLoading(buttonId, false);
                });
        }


        // Update the processPaymentStatus function to reload statistics
        function processPaymentStatus(paymentId, action) {
            if (isProcessing) return;

            isProcessing = true;
            const buttonId = action === 'verifikasi' ? 'confirmApprovalBtn' : 'confirmRejectionBtn';
            setButtonLoading(buttonId, true);

            fetch(`/api/pembayaran/${paymentId}/verifikasi`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: action === 'verifikasi' ? 'terverifikasi' : 'ditolak'
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (action === 'verifikasi') {
                        closeApprovalModal();
                    } else {
                        closeRejectionModal();
                    }
                    closeDetailModal();

                    const message = action === 'verifikasi' ?
                        'Pembayaran berhasil diverifikasi dan e-tiket telah dikirim ke email pelanggan' :
                        'Pembayaran berhasil ditolak';
                    showAlert(message, 'success');

                    // Refresh both the data and statistics
                    loadPaymentData();
                } else {
                    throw new Error(data.message || 'Gagal memperbarui status pembayaran');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                isProcessing = false;
                setButtonLoading(buttonId, false);
            });
        }

        function showAlert(message, type = 'success') {
            if (!elements.alertContainer || !elements.alertMessage || !elements.alertText) {
                console.error('Alert elements not found');
                return;
            }

            const alertClasses = type === 'success' ?
                'text-green-800 bg-green-50 border border-green-200' :
                'text-red-800 bg-red-50 border border-red-200';

            elements.alertMessage.className = `p-4 text-sm rounded-lg ${alertClasses}`;
            elements.alertText.textContent = message;
            elements.alertContainer.classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                elements.alertContainer.classList.add('hidden');
            }, 5000);

            // Scroll to top to show alert
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <style>
        /* Loading animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Responsive table styles */
        @media (max-width: 640px) {
            #payment-container .overflow-x-auto {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            #payment-container table {
                display: block;
                width: 100%;
            }

            #payment-container thead,
            #payment-container tbody,
            #payment-container th,
            #payment-container td,
            #payment-container tr {
                display: block;
            }

            #payment-container thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #payment-container tr {
                border: 1px solid #e5e7eb;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                padding: 1rem;
                background: white;
            }

            #payment-container td {
                border: none;
                border-bottom: 1px solid #e5e7eb;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            #payment-container td:last-child {
                border-bottom: none;
            }

            #payment-container td:before {
                position: absolute;
                top: 0.5rem;
                left: 0;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                content: attr(data-title) ":";
                color: #6b7280;
                font-size: 0.875rem;
            }
        }

        /* Modal improvements */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        /* Button hover effects */
        .transition-colors {
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        /* Custom scrollbar for modal */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection
