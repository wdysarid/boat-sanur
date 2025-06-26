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

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Daftar Pembayaran</h3>
            <div class="flex space-x-2">
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
                    <button data-status="all" class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-md">Semua</button>
                    <button data-status="menunggu"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Menunggu</button>
                    <button data-status="terverifikasi"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Diverifikasi</button>
                    <button data-status="ditolak"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Ditolak</button>
                    <button data-status="dibatalkan"
                        class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Dibatalkan</button>
                </div>
            </div>
            <div class="overflow-x-auto">
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
                <button id="closeDetailModal" class="text-gray-500 hover:text-gray-700">
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin memverifikasi pembayaran ini?</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
                <button id="confirmApprovalBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Verifikasi</button>
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin menolak pembayaran ini?</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
                <button id="confirmRejectionBtn"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">Tolak</button>
                <button id="cancelRejectionBtn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let currentPaymentId = null;

        const elements = {
            alertContainer: document.getElementById('alertContainer'),
            alertMessage: document.getElementById('alertMessage'),
            alertText: document.getElementById('alertText')
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

            document.querySelectorAll('#status-filters button').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelector('#status-filters button.bg-blue-50').classList.remove(
                        'bg-blue-50', 'text-blue-600');
                    this.classList.add('bg-blue-50', 'text-blue-600');
                    loadPaymentData();
                });
            });

            document.getElementById('confirmApprovalBtn').addEventListener('click', function() {
                if (currentPaymentId) {
                    processPaymentStatus(currentPaymentId, 'verifikasi');
                }
                closeApprovalModal();
            });

            document.getElementById('cancelApprovalBtn').addEventListener('click', closeApprovalModal);

            document.getElementById('confirmRejectionBtn').addEventListener('click', function() {
                if (currentPaymentId) {
                    processPaymentStatus(currentPaymentId, 'tolak');
                }
                closeRejectionModal();
            });

            document.getElementById('cancelRejectionBtn').addEventListener('click', closeRejectionModal);

            document.getElementById('closeDetailModal').addEventListener('click', closeDetailModal);

            document.getElementById('paymentDetailContent').addEventListener('click', function(e) {
                if (e.target.closest('[onclick^="showApprovalModal"]')) {
                    const paymentId = e.target.closest('button').getAttribute('onclick').match(/'([^']+)'/)[1];
                    showApprovalModal(paymentId);
                } else if (e.target.closest('[onclick^="showRejectionModal"]')) {
                    const paymentId = e.target.closest('button').getAttribute('onclick').match(/'([^']+)'/)[1];
                    showRejectionModal(paymentId);
                }
            });
        });

        function loadPaymentData(page = 1) {
            const status = document.querySelector('#status-filters button.bg-blue-50').dataset.status;
            const search = document.getElementById('search-payment').value;

            fetch(`/admin/payments/data?status=${status}&search=${search}&page=${page}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updatePaymentTable(data.data || []);
                        updatePagination(data);
                    } else {
                        console.error('Error:', data.message);
                        alert('Gagal memuat data: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data pembayaran');
                });
        }

        function updatePaymentTable(payments) {
            const tbody = document.getElementById('payment-table-body');
            tbody.innerHTML = '';

            if (payments.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data pembayaran yang ditemukan
                    </td>
                </tr>
            `;
                return;
            }

            payments.forEach(payment => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${payment.id}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-8 w-8">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=${payment.user?.nama || 'User'}&background=0D8ABC&color=fff" alt="${payment.user?.nama || 'User'}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${payment.user?.nama || 'User'}</div>
                            <div class="text-sm text-gray-500">${payment.user?.email || '-'}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${payment.tiket?.jadwal?.rute_asal || '-'} → ${payment.tiket?.jadwal?.rute_tujuan || '-'}</div>
                    <div class="text-sm text-gray-500">${payment.tiket?.jumlah_penumpang || 0} tiket</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp ${formatCurrency(payment.jumlah_bayar)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${getPaymentMethodText(payment.metode_bayar)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(payment.created_at).toLocaleDateString()}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(payment.status)}">
                        ${getStatusText(payment.status)}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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

        function updatePagination(data) {
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            // Jika tidak ada data atau hanya 1 halaman, tidak perlu tampilkan pagination
            if (!data || data.last_page <= 1) {
                return;
            }

            // Text showing current range
            const showingText = `
        <div class="text-sm text-gray-700 hidden sm:block">
            Menampilkan <span class="font-medium">${data.from}</span> sampai <span class="font-medium">${data.to}</span> dari <span class="font-medium">${data.total}</span> pembayaran
        </div>
    `;

            // Previous button
            const prevButton = data.prev_page_url ?
                `<button onclick="loadPaymentData(${data.current_page - 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Sebelumnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Sebelumnya</button>`;

            // Next button
            const nextButton = data.next_page_url ?
                `<button onclick="loadPaymentData(${data.current_page + 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Selanjutnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Selanjutnya</button>`;

            // Page numbers
            let pageNumbers = '';
            const maxVisiblePages = 5;
            let startPage, endPage;

            if (data.last_page <= maxVisiblePages) {
                // Jika total halaman kurang dari maxVisiblePages, tampilkan semua
                startPage = 1;
                endPage = data.last_page;
            } else {
                // Hitung halaman yang akan ditampilkan
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

            // Generate page numbers
            for (let i = startPage; i <= endPage; i++) {
                pageNumbers += `
            <button onclick="loadPaymentData(${i})"
                class="px-3 py-1 border border-gray-300 rounded-md text-sm ${i === data.current_page ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'}">
                ${i}
            </button>
        `;
            }

            // Tambahkan ellipsis jika diperlukan
            if (startPage > 1) {
                pageNumbers = `
            <button onclick="loadPaymentData(1)" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">1</button>
            ${startPage > 2 ? '<span class="px-2">...</span>' : ''}
            ${pageNumbers}
        `;
            }

            if (endPage < data.last_page) {
                pageNumbers = `
            ${pageNumbers}
            ${endPage < data.last_page - 1 ? '<span class="px-2">...</span>' : ''}
            <button onclick="loadPaymentData(${data.last_page})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">${data.last_page}</button>
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
                    return method;
            }
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }

        function renderActionButtons(payment) {
            if (payment.status === 'terverifikasi') {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment text-blue-600 hover:text-blue-900">Lihat</button>
                </div>
            `;
            } else if (payment.status === 'ditolak' || payment.status === 'dibatalkan') {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment text-blue-600 hover:text-blue-900">Lihat</button>
                </div>
            `;
            } else {
                return `
                <div class="flex space-x-2">
                    <button data-id="${payment.id}" class="view-payment text-blue-600 hover:text-blue-900">Lihat</button>
                    <button data-id="${payment.id}" class="approve-payment text-green-600 hover:text-green-900">Verifikasi</button>
                    <button data-id="${payment.id}" class="reject-payment text-red-600 hover:text-red-900">Tolak</button>
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
        }

        function closeRejectionModal() {
            document.getElementById('rejectionConfirmModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentPaymentId = null;
        }

        function showPaymentDetail(paymentId) {
            fetch(`/api/pembayaran/${paymentId}`, { // Perbaikan endpoint
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
                    if (data.success) {
                        renderPaymentDetail(data.data);
                        document.getElementById('paymentDetailModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        currentPaymentId = paymentId; // Simpan paymentId untuk aksi verifikasi/tolak
                    } else {
                        alert(data.message || 'Gagal memuat detail pembayaran');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat detail pembayaran');
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
                passengerList = payment.tiket.penumpang.map(passenger => `
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
                            </div>

                            <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Informasi Tiket</h4>
                            <div class="space-y-3">
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
                                    <span class="text-sm text-gray-900">${payment.tiket?.jadwal?.tanggal ? new Date(payment.tiket.jadwal.tanggal).toLocaleDateString() : '-'}, ${payment.tiket?.jadwal?.waktu_berangkat || '-'}</span>
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
                                    <span class="text-sm text-gray-900">${payment.id}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Metode</span>
                                    <span class="text-sm text-gray-900">${getPaymentMethodText(payment.metode_bayar)}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                                    <span class="text-sm text-gray-900">${new Date(payment.created_at).toLocaleDateString()}</span>
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
                                    <span class="text-sm text-gray-900">Rp ${formatCurrency(payment.tiket?.total_harga || 0)}</span>
                                </div>
                                <div class="pt-2 border-t border-gray-200 flex justify-between">
                                    <span class="text-sm font-medium text-gray-900">Total</span>
                                    <span class="text-sm font-medium text-gray-900">Rp ${formatCurrency(payment.jumlah_bayar)}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger List Section -->
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-gray-500 mb-4">Daftar Penumpang</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            ${passengerList}
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Bukti Pembayaran</h4>
                    <div class="mb-4">
                        <img src="${payment.bukti_transfer_url || 'https://via.placeholder.com/400x500'}" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg">
                    </div>
                    ${payment.bukti_transfer_url ? `
                            <div class="flex justify-center">
                                <a href="${payment.bukti_transfer_url}" download class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Unduh Bukti Pembayaran
                                </a>
                            </div>
                            ` : ''}

                    <!-- Tambahkan tombol aksi jika status masih menunggu -->
                    ${payment.status === 'menunggu' ? `
                            <div class="mt-6 flex flex-col sm:flex-row gap-2">
                                <button onclick="showApprovalModal('${payment.id}')" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Verifikasi
                                </button>
                                <button onclick="showRejectionModal('${payment.id}')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    Tolak
                                </button>
                            </div>
                        ` : ''}
                </div>
            </div>
            `;
        }

        function processPaymentStatus(paymentId, action) {
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
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Close the modal first
                        if (action === 'verifikasi') {
                            closeApprovalModal();
                        } else {
                            closeRejectionModal();
                        }
                        closeDetailModal();

                        // Show success notification
                        showAlert(`Pembayaran berhasil ${action === 'verifikasi' ? 'diverifikasi' : 'ditolak'}`, 'success');

                        // Refresh the data
                        loadPaymentData();
                    } else {
                        showAlert(data.message || 'Gagal memperbarui status pembayaran', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat memperbarui status pembayaran: ' + (error.message || error), 'error');
                });
        }

        function showAlert(message, type = 'success') {
            if (!elements.alertContainer || !elements.alertMessage || !elements.alertText) {
                console.error('Alert elements not found');
                return;
            }

            const alertClasses = type === 'success'
                ? 'text-green-800 bg-green-50'
                : 'text-red-800 bg-red-50';

            elements.alertMessage.className = `p-4 text-sm rounded-lg ${alertClasses}`;
            elements.alertText.textContent = message;
            elements.alertContainer.classList.remove('hidden');

            setTimeout(() => {
                elements.alertContainer.classList.add('hidden');
            }, 5000);
        }
    </script>

    <style>
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
            }

            #payment-container td {
                border: none;
                border-bottom: 1px solid #e5e7eb;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
            }

            #payment-container td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                content: attr(data-title);
            }
        }
    </style>
@endsection
