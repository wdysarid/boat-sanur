@extends('layouts.admin')

@section('title', 'Detail Penumpang')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Penumpang</h1>
                    <p class="text-gray-600">Informasi lengkap penumpang dan riwayat aktivitas</p>
                </div>
                <a href="{{ route('admin.passengers') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden text-center py-8">
            <div
                class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-blue-500">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Memuat data...
            </div>
        </div>

        <div id="passenger-detail-content" class="hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Passenger Info -->
                <div class="lg:col-span-2">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span id="passenger-avatar" class="text-lg font-medium text-blue-600">--</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 id="passenger-name" class="text-lg font-medium text-gray-900">--</h3>
                                    <p id="passenger-code" class="text-sm text-gray-500">--</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Penumpang</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <p id="passenger-fullname" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                                    <p id="passenger-identity" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Usia</label>
                                    <p id="passenger-age" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <p id="passenger-gender" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status Pemesan</label>
                                    <span id="passenger-is-booker"
                                        class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        --
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Information -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Informasi Pemesanan</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nomor Tiket</label>
                                    <p id="ticket-code"
                                        class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">QR Code Data</label>
                                    <p id="ticket-qr"
                                        class="mt-1 text-xs text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded break-all">
                                        --</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Pemesanan</label>
                                    <p id="booking-date" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                                    <span id="payment-status"
                                        class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        --
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Information -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Informasi Jadwal Perjalanan</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Rute Perjalanan</label>
                                    <div id="route-info" class="mt-1 flex items-center">
                                        <span class="text-sm text-gray-900 font-medium">--</span>
                                        <svg class="mx-2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900 font-medium">--</span>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Kapal</label>
                                    <p id="ship-name" class="mt-1 text-sm text-gray-900">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Keberangkatan</label>
                                    <p id="departure-date" class="mt-1 text-sm text-gray-900 font-medium">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Waktu Keberangkatan</label>
                                    <p id="departure-time" class="mt-1 text-sm text-gray-900 font-medium">--</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Waktu Boarding</label>
                                    <p id="boarding-time" class="mt-1 text-sm text-gray-900 font-medium">--</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Timeline Aktivitas</h3>
                        </div>
                        <div class="p-6">
                            <div id="activity-timeline" class="flow-root">
                                <!-- Timeline will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status & Actions Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Current Status Card -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Status Saat Ini</h3>
                        </div>
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <span id="passenger-status"
                                    class="inline-flex px-4 py-2 text-lg font-semibold rounded-full bg-gray-100 text-gray-800">
                                    --
                                </span>
                                <p id="status-description" class="text-sm text-gray-500 mt-2">--</p>
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-700">Check-in:</span>
                                    <span id="checkin-time" class="text-sm text-gray-900">--</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-700">Boarding:</span>
                                    <span id="boarding-time-status" class="text-sm text-gray-900">--</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Aksi Cepat</h3>
                        </div>
                        <div id="action-buttons" class="p-6 space-y-3">
                            <!-- Action buttons will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrCodeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-sm w-full p-6 text-center">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">QR Code Tiket</h3>
                    <button onclick="closeQrCode()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <div id="qrCodeContainer" class="flex justify-center">
                        <img id="qr-code-image"
                            class="w-48 h-48 border-4 border-blue-300 rounded-lg p-2 bg-white shadow-lg" alt="QR Code"
                            style="display: none;">
                        <div id="qr-code-placeholder"
                            class="w-48 h-48 bg-gray-200 flex items-center justify-center text-xs text-gray-500 border-2 border-dashed border-gray-300 rounded-lg">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01">
                                    </path>
                                </svg>
                                <p id="qr-code-text">QR Code tidak tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-3 mb-4">
                    <p class="text-xs text-blue-800 font-medium mb-1">Kode Pemesanan:</p>
                    <p id="qr-code-value" class="text-sm text-blue-900 font-mono break-all">--</p>
                </div>

                <div class="flex space-x-2">
                    <button onclick="downloadQrCode()"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        Download
                    </button>
                    <button onclick="closeQrCode()"
                        class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Check-in Confirmation Modal -->
    <div id="checkinConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Konfirmasi Check-in
                        </h3>
                        <button id="closeCheckinConfirmModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-6 py-6">
                    <!-- Success Icon -->
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Passenger Info -->
                    <div id="checkinPassengerInfo" class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium text-gray-900 mb-2">Detail Penumpang:</h4>
                        <div class="space-y-1 text-sm text-gray-600">
                            <p><span class="font-medium">Nama:</span> <span id="checkinPassengerName">-</span></p>
                            <p><span class="font-medium">Kode Tiket:</span> <span id="checkinTicketCode">-</span></p>
                            <p><span class="font-medium">Rute:</span> <span id="checkinRoute">-</span></p>
                            <p><span class="font-medium">Tanggal:</span> <span id="checkinDate">-</span></p>
                        </div>
                    </div>

                    <!-- Confirmation Message -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-green-800 mb-1">Siap untuk Check-in!</h4>
                                <ul class="text-sm text-green-700 space-y-1">
                                    <li>• Penumpang akan terdaftar sebagai checked-in</li>
                                    <li>• Status tiket akan diperbarui secara otomatis</li>
                                    <li>• Penumpang dapat melanjutkan ke proses boarding</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmation Question -->
                    <p class="text-center text-gray-700 font-medium mb-6">
                        Apakah Anda yakin ingin melakukan check-in untuk penumpang ini?
                    </p>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button id="cancelCheckinConfirm"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </button>
                    <button id="confirmCheckin"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Ya, Check-in Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-sm w-full p-6">
                <div class="flex items-center mb-4">
                    <div id="alertIcon"
                        class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                        <!-- Icon will be inserted here -->
                    </div>
                    <h3 id="alertTitle" class="text-lg font-medium text-gray-900"></h3>
                </div>
                <p id="alertMessage" class="text-sm text-gray-500 mb-4"></p>
                <div class="flex justify-end">
                    <button onclick="closeAlert()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPassengerData = null;
        let currentTicketId = null;

        document.addEventListener('DOMContentLoaded', function() {
            const passengerId = window.location.pathname.split('/').pop();
            loadPassengerDetail(passengerId);

            // Check-in confirmation modal event listeners
            document.getElementById('closeCheckinConfirmModal').addEventListener('click', closeCheckinConfirmModal);
            document.getElementById('cancelCheckinConfirm').addEventListener('click', closeCheckinConfirmModal);
            document.getElementById('confirmCheckin').addEventListener('click', executeCheckin);

            // Close modal when clicking outside
            document.getElementById('checkinConfirmModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCheckinConfirmModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('checkinConfirmModal');
                    if (!modal.classList.contains('hidden')) {
                        closeCheckinConfirmModal();
                    }
                }
            });
        });

        function loadPassengerDetail(passengerId) {
            showLoading();

            fetch(`/admin/passengers/${passengerId}/detail`, {
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
                        renderPassengerDetail(data.data);
                    } else {
                        showAlert('Error', data.message || 'Gagal memuat detail penumpang', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading passenger detail:', error);
                    showAlert('Error', 'Terjadi kesalahan saat memuat detail penumpang', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
        }

        function renderPassengerDetail(passenger) {
            // Store passenger data globally
            currentPassengerData = passenger;
            currentTicketId = passenger.tiket?.id;

            // Show content
            document.getElementById('passenger-detail-content').classList.remove('hidden');

            // Render basic info
            document.getElementById('passenger-name').textContent = passenger.nama_lengkap;
            document.getElementById('passenger-code').textContent = passenger.tiket?.kode_pemesanan || '-';
            document.getElementById('passenger-avatar').textContent = getInitials(passenger.nama_lengkap);

            // Render passenger info
            document.getElementById('passenger-fullname').textContent = passenger.nama_lengkap;
            document.getElementById('passenger-identity').textContent = passenger.no_identitas;
            document.getElementById('passenger-age').textContent = `${passenger.usia} tahun`;
            document.getElementById('passenger-gender').textContent = passenger.jenis_kelamin === 'laki-laki' ?
                'Laki-laki' : 'Perempuan';

            const isBookerEl = document.getElementById('passenger-is-booker');
            isBookerEl.textContent = passenger.is_pemesan ? 'Pemesan Utama' : 'Penumpang';
            isBookerEl.className =
                `mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full ${passenger.is_pemesan ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'}`;

            // Render ticket info
            document.getElementById('ticket-code').textContent = passenger.tiket?.kode_pemesanan || '-';
            document.getElementById('ticket-qr').textContent = passenger.tiket?.kode_pemesanan || '-';
            document.getElementById('booking-date').textContent = passenger.tiket?.created_at ?
                formatDateTime(passenger.tiket.created_at) : '-';

            // Render payment status
            const paymentStatusEl = document.getElementById('payment-status');
            const paymentStatus = passenger.tiket?.pembayaran?.status || 'pending';
            paymentStatusEl.textContent = getPaymentStatusText(paymentStatus);
            paymentStatusEl.className =
                `mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getPaymentStatusClass(paymentStatus)}`;

            // Render schedule info
            const routeEl = document.getElementById('route-info');
            routeEl.innerHTML = `
        <span class="text-sm text-gray-900 font-medium">${passenger.tiket?.jadwal?.rute_asal || '-'}</span>
        <svg class="mx-2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
        <span class="text-sm text-gray-900 font-medium">${passenger.tiket?.jadwal?.rute_tujuan || '-'}</span>
    `;

            document.getElementById('ship-name').textContent = passenger.tiket?.jadwal?.kapal?.nama_kapal || '-';
            document.getElementById('departure-date').textContent = passenger.tiket?.jadwal?.tanggal ?
                formatDate(passenger.tiket.jadwal.tanggal) : '-';
            document.getElementById('departure-time').textContent = passenger.tiket?.jadwal?.waktu_berangkat || '-';

            // Calculate and display boarding time
            const boardingTime = calculateBoardingTime(passenger.tiket?.jadwal?.tanggal, passenger.tiket?.jadwal
                ?.waktu_berangkat);
            document.getElementById('boarding-time').textContent = boardingTime;

            // Render status
            const statusElement = document.getElementById('passenger-status');
            statusElement.textContent = getStatusText(passenger.status);
            statusElement.className =
                `inline-flex px-4 py-2 text-lg font-semibold rounded-full ${getStatusClass(passenger.status)}`;

            document.getElementById('status-description').textContent = getStatusDescription(passenger.status);

            // Render check-in time if available
            document.getElementById('checkin-time').textContent = passenger.checked_in_at ?
                formatDateTime(passenger.checked_in_at) : '-';

            document.getElementById('boarding-time-status').textContent = boardingTime;

            // Render action buttons based on status
            renderActionButtons(passenger);

            // Render activity timeline
            renderActivityTimeline(passenger);
        }

        function renderActionButtons(passenger) {
            const actionButtons = document.getElementById('action-buttons');
            actionButtons.innerHTML = '';

            if (passenger.status === 'booked') {
                actionButtons.innerHTML = `
            <button onclick="showCheckinConfirmModal()"
                class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Check-in
            </button>
        `;
            }

            // Always show QR code and print buttons
            actionButtons.innerHTML += `
        <button onclick="showQrCode('${passenger.tiket?.kode_pemesanan || ''}')"
                class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01"></path>
            </svg>
            Show QR Code
        </button>

        <button onclick="printTicket(${passenger.tiket?.id})"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Ticket
        </button>
    `;
        }

        function renderActivityTimeline(passenger) {
            const timeline = document.getElementById('activity-timeline');
            let timelineHTML = '<ul class="-mb-8">';

            // Booking activity
            if (passenger.tiket?.created_at) {
                timelineHTML += `
            <li>
                <div class="relative pb-8">
                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                            <div>
                                <p class="text-sm text-gray-900">Tiket dipesan</p>
                                <p class="text-xs text-gray-500">Pemesanan berhasil dibuat</p>
                            </div>
                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                <time>${formatDateTime(passenger.tiket.created_at)}</time>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;
            }

            // Payment activity
            if (passenger.tiket?.pembayaran?.updated_at) {
                timelineHTML += `
            <li>
                <div class="relative pb-8">
                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                            <div>
                                <p class="text-sm text-gray-900">Pembayaran dikonfirmasi</p>
                                <p class="text-xs text-gray-500">${getPaymentStatusText(passenger.tiket.pembayaran.status)}</p>
                            </div>
                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                <time>${formatDateTime(passenger.tiket.pembayaran.updated_at)}</time>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;
            }

            // Check-in activity
            if (passenger.checked_in_at) {
                timelineHTML += `
            <li>
                <div class="relative">
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                            <div>
                                <p class="text-sm text-gray-900">Check-in berhasil</p>
                                <p class="text-xs text-gray-500">QR Code discan - Admin</p>
                            </div>
                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                <time>${formatDateTime(passenger.checked_in_at)}</time>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;
            }

            timelineHTML += '</ul>';
            timeline.innerHTML = timelineHTML;
        }

        // Check-in confirmation modal functions
        function showCheckinConfirmModal() {
            if (!currentPassengerData || !currentTicketId) {
                showAlert('Error', 'Data penumpang tidak valid', 'error');
                return;
            }

            // Populate modal dengan data penumpang
            document.getElementById('checkinPassengerName').textContent = currentPassengerData.nama_lengkap;
            document.getElementById('checkinTicketCode').textContent = currentPassengerData.tiket?.kode_pemesanan || '-';
            document.getElementById('checkinRoute').textContent =
                `${currentPassengerData.tiket?.jadwal?.rute_asal || '-'} → ${currentPassengerData.tiket?.jadwal?.rute_tujuan || '-'}`;

            // Format tanggal
            if (currentPassengerData.tiket?.jadwal?.tanggal) {
                const ticketDate = new Date(currentPassengerData.tiket.jadwal.tanggal);
                document.getElementById('checkinDate').textContent = ticketDate.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            } else {
                document.getElementById('checkinDate').textContent = '-';
            }

            // Tampilkan modal
            const modal = document.getElementById('checkinConfirmModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Focus pada tombol batal untuk accessibility
            setTimeout(() => {
                document.getElementById('cancelCheckinConfirm').focus();
            }, 100);
        }

        function closeCheckinConfirmModal() {
            const modal = document.getElementById('checkinConfirmModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function executeCheckin() {
            if (!currentTicketId) {
                showAlert('Error', 'ID tiket tidak valid', 'error');
                return;
            }

            const confirmBtn = document.getElementById('confirmCheckin');
            const originalText = confirmBtn.innerHTML;

            // Disable button dan show loading
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = `
                <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;

            fetch(`/api/penumpang/checkin`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tiket_id: currentTicketId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeCheckinConfirmModal();
                        showAlert('Success', 'Penumpang berhasil check-in', 'success');
                        // Reload page data
                        const currentPassengerId = window.location.pathname.split('/').pop();
                        loadPassengerDetail(currentPassengerId);
                    } else {
                        showAlert('Error', data.message || 'Gagal melakukan check-in', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error', 'Terjadi kesalahan saat melakukan check-in', 'error');
                })
                .finally(() => {
                    // Restore button
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = originalText;
                });
        }

        // Show QR Code with simple format
        function showQrCode(kodePemesanan) {
            const modal = document.getElementById('qrCodeModal');
            const qrImage = document.getElementById('qr-code-image');
            const placeholder = document.getElementById('qr-code-placeholder');
            const qrValue = document.getElementById('qr-code-value');

            if (kodePemesanan) {
                // Generate QR code URL - assuming we have a route for this
                const qrUrl = `/admin/qr-code/generate?data=${encodeURIComponent(kodePemesanan)}`;

                qrImage.src = qrUrl;
                qrImage.style.display = 'block';
                placeholder.style.display = 'none';
                qrValue.textContent = kodePemesanan;

                // Add error handling for QR image
                qrImage.onerror = function() {
                    qrImage.style.display = 'none';
                    placeholder.style.display = 'flex';
                    document.getElementById('qr-code-text').textContent = 'QR Code tidak dapat dimuat';
                };
            } else {
                qrImage.style.display = 'none';
                placeholder.style.display = 'flex';
                qrValue.textContent = 'Tidak ada data';
            }

            modal.classList.remove('hidden');
        }

        function closeQrCode() {
            document.getElementById('qrCodeModal').classList.add('hidden');

            // Reset QR code display
            const qrImage = document.getElementById('qr-code-image');
            const placeholder = document.getElementById('qr-code-placeholder');

            qrImage.style.display = 'none';
            placeholder.style.display = 'flex';
            document.getElementById('qr-code-text').textContent = 'QR Code tidak tersedia';
        }

        function downloadQrCode() {
            const qrImage = document.getElementById('qr-code-image');
            const kodePemesanan = document.getElementById('qr-code-value').textContent;

            if (qrImage.src && kodePemesanan !== 'Tidak ada data') {
                const link = document.createElement('a');
                link.download = `qr-code-${kodePemesanan}.png`;
                link.href = qrImage.src;
                link.click();
            } else {
                showAlert('Error', 'QR Code tidak tersedia untuk didownload', 'error');
            }
        }

        function printTicket(tiketId) {
            if (!tiketId) {
                showAlert('Error', 'ID tiket tidak valid', 'error');
                return;
            }

            showAlert('Info', 'Memproses PDF tiket...', 'info');
            // FIXED: Use admin PDF route instead of wisatawan route
            window.open(`/admin/tiket/${tiketId}/pdf`, '_blank');
        }

        // Helper functions
        function getInitials(name) {
            if (!name) return 'NN';
            const parts = name.split(' ');
            return parts.length > 1 ?
                `${parts[0].charAt(0)}${parts[parts.length - 1].charAt(0)}` :
                parts[0].substring(0, 2);
        }

        function getStatusClass(status) {
            switch (status) {
                case 'checked_in':
                    return 'bg-green-100 text-green-800';
                case 'booked':
                    return 'bg-yellow-100 text-yellow-800';
                case 'boarded':
                    return 'bg-blue-100 text-blue-800';
                case 'completed':
                    return 'bg-gray-100 text-gray-800';
                case 'cancelled':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'checked_in':
                    return 'Checked In';
                case 'booked':
                    return 'Booked';
                case 'boarded':
                    return 'Boarded';
                case 'completed':
                    return 'Completed';
                case 'cancelled':
                    return 'Cancelled';
                default:
                    return status;
            }
        }

        function getStatusDescription(status) {
            switch (status) {
                case 'checked_in':
                    return 'Penumpang sudah check-in';
                case 'booked':
                    return 'Menunggu check-in';
                case 'boarded':
                    return 'Penumpang sudah naik kapal';
                case 'completed':
                    return 'Perjalanan selesai';
                case 'cancelled':
                    return 'Tiket dibatalkan';
                default:
                    return 'Status tidak diketahui';
            }
        }

        function getPaymentStatusClass(status) {
            switch (status) {
                case 'terverifikasi':
                    return 'bg-green-100 text-green-800';
                case 'menunggu':
                    return 'bg-yellow-100 text-yellow-800';
                case 'ditolak':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getPaymentStatusText(status) {
            switch (status) {
                case 'terverifikasi':
                    return 'Terverifikasi';
                case 'menunggu':
                    return 'Menunggu';
                case 'ditolak':
                    return 'Ditolak';
                default:
                    return status || 'Pending';
            }
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const options = {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        function formatDateTime(dateTimeString) {
            if (!dateTimeString) return '-';
            const date = new Date(dateTimeString);
            return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }) + ' ' +
                date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
        }

        function calculateBoardingTime(tanggal, waktuBerangkat) {
            if (!tanggal || !waktuBerangkat) return '-';

            try {
                const departureDateTime = new Date(`${tanggal} ${waktuBerangkat}`);
                const boardingDateTime = new Date(departureDateTime.getTime() - (30 * 60 * 1000)); // 30 minutes before

                return boardingDateTime.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (error) {
                return '-';
            }
        }

        function showLoading() {
            document.getElementById('loading-indicator').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loading-indicator').classList.add('hidden');
        }

        function showAlert(title, message, type = 'info') {
            const modal = document.getElementById('alertModal');
            const titleEl = document.getElementById('alertTitle');
            const messageEl = document.getElementById('alertMessage');
            const iconEl = document.getElementById('alertIcon');

            titleEl.textContent = title;
            messageEl.textContent = message;

            // Set icon based on type
            let iconHTML = '';
            let iconClass = '';

            switch (type) {
                case 'success':
                    iconClass = 'bg-green-100';
                    iconHTML = `
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            `;
                    break;
                case 'error':
                    iconClass = 'bg-red-100';
                    iconHTML = `
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            `;
                    break;
                default:
                    iconClass = 'bg-blue-100';
                    iconHTML = `
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            `;
            }

            iconEl.className = `flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-3 ${iconClass}`;
            iconEl.innerHTML = iconHTML;

            modal.classList.remove('hidden');
        }

        function closeAlert() {
            document.getElementById('alertModal').classList.add('hidden');
        }
    </script>
@endsection
