@extends('layouts.admin')

@section('title', 'Manajemen Penumpang')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Penumpang</h1>
            <p class="text-gray-600">Kelola data penumpang dan status boarding</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6" id="stats-cards">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Total</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-total">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Booked</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-booked">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Checked In</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-checked-in">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Boarded</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-boarded">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Completed</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-completed">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Cancelled</p>
                        <p class="text-lg font-semibold text-gray-900" id="stat-cancelled">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Filter & Pencarian</h3>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                        <input type="text" id="search-passenger" placeholder="Nama, email, nomor tiket..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status-filter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="booked">Booked</option>
                            <option value="checked_in">Checked In</option>
                            <option value="boarded">Boarded</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" id="date-filter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Jadwal Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal</label>
                        <select id="jadwal-filter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Jadwal</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-end space-x-2">
                        <button id="apply-filter"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Filter
                        </button>
                        <button id="reset-filter"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Scanner Button -->
        <div class="mb-6">
            <button onclick="openQrScanner()"
                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01">
                    </path>
                </svg>
                Scan QR Code
            </button>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden text-center py-4">
            <div
                class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-blue-500 hover:bg-blue-400 transition ease-in-out duration-150 cursor-not-allowed">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Memuat data...
            </div>
        </div>

        <!-- Passengers Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penumpang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tiket</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jadwal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Boarding</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="passenger-table-body" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be loaded here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="pagination-container" class="px-6 py-3 border-t border-gray-200">
                <!-- Pagination will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Enhanced QR Scanner Modal - IMPROVED: Optimized for simple QR codes -->
    <div id="qrScannerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-lg w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Scan QR Code</h3>
                    <button onclick="closeQrScanner()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200 mb-4">
                    <button id="camera-tab" onclick="switchTab('camera')"
                        class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Kamera
                    </button>
                    <button id="manual-tab" onclick="switchTab('manual')"
                        class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Manual
                    </button>
                    <button id="upload-tab" onclick="switchTab('upload')"
                        class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Upload
                    </button>
                </div>

                <!-- Camera Tab Content -->
                <div id="camera-content" class="tab-content">
                    <div id="qr-reader"
                        class="mb-4 w-full h-64 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-500">Mengaktifkan kamera...</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 text-sm text-blue-800">
                        <p class="font-medium mb-1">Tips untuk scan optimal:</p>
                        <ul class="text-xs space-y-1">
                            <li>• Pastikan QR Code dalam frame</li>
                            <li>• Jaga jarak 10-30 cm dari kamera</li>
                            <li>• Pastikan pencahayaan cukup</li>
                        </ul>
                    </div>
                </div>

                <!-- Manual Tab Content -->
                <div id="manual-content" class="tab-content hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan Kode Pemesanan</label>
                        <input type="text" id="qrCodeInput" placeholder="Contoh: TKT-ABC123 atau ABC123"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="mt-2 text-xs text-gray-500">
                            <p class="font-medium mb-1">Format yang didukung:</p>
                            <ul class="space-y-1">
                                <li>• TKT-ABC123 (format lengkap)</li>
                                <li>• ABC123 (kode saja)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Upload Tab Content -->
                <div id="upload-content" class="tab-content hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar QR Code</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="qr-file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload gambar</span>
                                        <input id="qr-file-upload" name="qr-file-upload" type="file" accept="image/*"
                                            class="sr-only" onchange="handleFileUpload(event)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                            </div>
                        </div>
                        <div id="upload-preview" class="hidden mt-4">
                            <img id="uploaded-image" class="max-w-full h-auto rounded-lg border" alt="Uploaded QR Code">
                            <div id="upload-result" class="mt-2 text-sm"></div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3 mt-6">
                    <button onclick="processQrScan()" id="process-btn"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Proses Check-in
                    </button>
                    <button onclick="closeQrScanner()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
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

    <!-- Include libraries -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

    <script>
        let currentPage = 1;
        let html5QrCode;
        let currentTab = 'camera';

        document.addEventListener('DOMContentLoaded', function() {
            // Load initial data
            loadPassengerData();
            loadJadwalOptions();

            // Setup event listeners
            document.getElementById('search-passenger').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    loadPassengerData();
                }
            });

            // Debounce search input
            let searchTimeout;
            document.getElementById('search-passenger').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    loadPassengerData();
                }, 500);
            });

            // Filter event listeners
            document.getElementById('status-filter').addEventListener('change', loadPassengerData);
            document.getElementById('jadwal-filter').addEventListener('change', loadPassengerData);
            document.getElementById('date-filter').addEventListener('change', loadPassengerData);

            // Button event listeners
            document.getElementById('apply-filter').addEventListener('click', loadPassengerData);
            document.getElementById('reset-filter').addEventListener('click', resetFilters);
        });

        function switchTab(tab) {
            // Update tab buttons
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.querySelectorAll('[id$="-tab"]').forEach(button => {
                button.className =
                    'px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700';
            });

            // Show selected tab
            document.getElementById(`${tab}-content`).classList.remove('hidden');
            document.getElementById(`${tab}-tab`).className =
                'px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600';

            currentTab = tab;

            // Stop camera if switching away from camera tab
            if (tab !== 'camera' && html5QrCode && html5QrCode.isScanning) {
                html5QrCode.stop().catch(err => console.error("Error stopping scanner:", err));
            }
        }

        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('uploaded-image');
                const preview = document.getElementById('upload-preview');
                const result = document.getElementById('upload-result');

                img.src = e.target.result;
                preview.classList.remove('hidden');
                result.innerHTML = '<span class="text-blue-600">Memproses gambar...</span>';

                // Process QR code from image
                processImageQR(e.target.result);
            };
            reader.readAsDataURL(file);
        }

        function processImageQR(imageSrc) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');

                // Ukuran optimal untuk scanning
                canvas.width = Math.min(800, img.width);
                canvas.height = Math.min(800, img.height);

                context.drawImage(img, 0, 0, canvas.width, canvas.height);

                // Tambahkan preprocessing gambar
                const imageData = preprocessImage(context, canvas.width, canvas.height);

                const code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });

                const result = document.getElementById('upload-result');
                if (code) {
                    // IMPROVED: Handle simple QR code format
                    let qrContent = code.data.trim();

                    // Normalisasi format kode - QR Code sederhana hanya berisi kode pemesanan
                    if (!qrContent.startsWith('TKT-') && qrContent.match(/^[A-Z0-9]+$/)) {
                        qrContent = 'TKT-' + qrContent;
                    }

                    result.innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-green-800 font-medium">QR Code terdeteksi!</span>
                            </div>
                            <p class="text-green-700 text-sm mt-1">Kode: ${qrContent}</p>
                        </div>
                    `;
                    document.getElementById('qrCodeInput').value = qrContent;
                } else {
                    result.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span class="text-red-800 font-medium">QR Code tidak terdeteksi</span>
                                </div>
                                <button onclick="retryScan()" class="text-blue-600 text-sm hover:text-blue-800">Coba Lagi</button>
                            </div>
                            <p class="text-red-700 text-sm mt-1">Pastikan gambar jelas dan QR Code terlihat</p>
                        </div>
                    `;
                }
            };
            img.src = imageSrc;
        }

        // Fungsi preprocessing gambar untuk meningkatkan deteksi
        function preprocessImage(context, width, height) {
            // Konversi ke grayscale untuk meningkatkan deteksi
            const imageData = context.getImageData(0, 0, width, height);
            const data = imageData.data;

            for (let i = 0; i < data.length; i += 4) {
                const avg = (data[i] + data[i + 1] + data[i + 2]) / 3;
                data[i] = avg; // R
                data[i + 1] = avg; // G
                data[i + 2] = avg; // B
                // Alpha channel tetap
            }

            context.putImageData(imageData, 0, 0);
            return context.getImageData(0, 0, width, height);
        }

        function retryScan() {
            document.getElementById('upload-preview').classList.add('hidden');
            document.getElementById('qr-file-upload').value = '';
        }

        function loadPassengerData(page = 1) {
            const status = document.getElementById('status-filter').value;
            const search = document.getElementById('search-passenger').value;
            const jadwalId = document.getElementById('jadwal-filter').value;
            const date = document.getElementById('date-filter').value;

            showLoading();

            const params = new URLSearchParams({
                status: status,
                search: search,
                jadwal_id: jadwalId,
                date: date,
                page: page
            });

            fetch(`/api/penumpang/all?${params}`, {
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
                        updatePassengerTable(data.data.data || []);
                        updatePagination(data.data);
                        updateStats(data.stats || {});
                        currentPage = page;
                    } else {
                        showAlert('Error', data.message || 'Gagal memuat data penumpang', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading passenger data:', error);
                    showAlert('Error', 'Terjadi kesalahan saat memuat data penumpang', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
        }

        function updatePassengerTable(passengers) {
            const tbody = document.getElementById('passenger-table-body');
            tbody.innerHTML = '';

            if (passengers.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data penumpang yang ditemukan
                        </td>
                    </tr>
                `;
                return;
            }

            passengers.forEach(passenger => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';

                const boardingTime = calculateBoardingTime(passenger.tiket?.jadwal?.tanggal, passenger.tiket?.jadwal
                    ?.waktu_berangkat);

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-sm font-medium text-blue-600">${getInitials(passenger.nama_lengkap)}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${passenger.nama_lengkap}</div>
                                <div class="text-sm text-gray-500">${passenger.no_identitas}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${passenger.tiket?.kode_pemesanan || '-'}</div>
                        <div class="text-sm text-gray-500">Usia: ${passenger.usia} tahun</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${passenger.tiket?.jadwal?.rute_asal || '-'} → ${passenger.tiket?.jadwal?.rute_tujuan || '-'}</div>
                        <div class="text-sm text-gray-500">${formatDate(passenger.tiket?.jadwal?.tanggal)} ${passenger.tiket?.jadwal?.waktu_berangkat}</div>
                        <div class="text-xs text-gray-400">Boarding: ${boardingTime}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(passenger.status)}">
                            ${getStatusText(passenger.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${passenger.checked_in_at ? formatDateTime(passenger.checked_in_at) : '-'}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${boardingTime}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="/admin/passengers/${passenger.id}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                            ${passenger.status === 'booked' ?
                                `<button onclick="checkInPassenger(${passenger.tiket?.id})" class="text-green-600 hover:text-green-900">Check-in</button>` :
                                ''}
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function updatePagination(paginationData) {
            const container = document.getElementById('pagination-container');

            if (!paginationData || paginationData.last_page <= 1) {
                container.innerHTML = `
                    <div class="text-sm text-gray-700">
                        Menampilkan ${paginationData?.from || 0} - ${paginationData?.to || 0} dari ${paginationData?.total || 0} penumpang
                    </div>
                `;
                return;
            }

            let paginationHTML = `
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">${paginationData.from}</span> - <span class="font-medium">${paginationData.to}</span> dari <span class="font-medium">${paginationData.total}</span> penumpang
                    </div>
                    <div class="flex items-center space-x-2">
            `;

            // Previous button
            if (paginationData.current_page > 1) {
                paginationHTML += `
                    <button onclick="loadPassengerData(${paginationData.current_page - 1})"
                            class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                        Previous
                    </button>
                `;
            } else {
                paginationHTML += `
                    <button class="px-3 py-1 border border-gray-300 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed" disabled>
                        Previous
                    </button>
                `;
            }

            // Page numbers
            const startPage = Math.max(1, paginationData.current_page - 2);
            const endPage = Math.min(paginationData.last_page, paginationData.current_page + 2);

            for (let i = startPage; i <= endPage; i++) {
                if (i === paginationData.current_page) {
                    paginationHTML += `
                        <button class="px-3 py-1 border border-gray-300 rounded-md bg-blue-600 text-white min-w-[40px]">
                            ${i}
                        </button>
                    `;
                } else {
                    paginationHTML += `
                        <button onclick="loadPassengerData(${i})"
                                class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50 min-w-[40px]">
                            ${i}
                        </button>
                    `;
                }
            }

            // Next button
            if (paginationData.current_page < paginationData.last_page) {
                paginationHTML += `
                    <button onclick="loadPassengerData(${paginationData.current_page + 1})"
                            class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                        Next
                    </button>
                `;
            } else {
                paginationHTML += `
                    <button class="px-3 py-1 border border-gray-300 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed" disabled>
                        Next
                    </button>
                `;
            }

            paginationHTML += `
                    </div>
                </div>
            `;

            container.innerHTML = paginationHTML;
        }

        function updateStats(stats) {
            document.getElementById('stat-total').textContent = stats.total || 0;
            document.getElementById('stat-booked').textContent = stats.booked || 0;
            document.getElementById('stat-checked-in').textContent = stats.checked_in || 0;
            document.getElementById('stat-boarded').textContent = stats.boarded || 0;
            document.getElementById('stat-completed').textContent = stats.completed || 0;
            document.getElementById('stat-cancelled').textContent = stats.cancelled || 0;
        }

        function checkInPassenger(tiketId) {
            if (!tiketId) {
                showAlert('Error', 'ID tiket tidak valid', 'error');
                return;
            }

            if (confirm('Apakah Anda yakin ingin melakukan check-in penumpang ini?')) {
                showLoading();

                fetch(`/api/penumpang/checkin`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            tiket_id: tiketId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert('Success', 'Penumpang berhasil check-in', 'success');
                            loadPassengerData(currentPage);
                        } else {
                            showAlert('Error', data.message || 'Gagal melakukan check-in', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('Error', 'Terjadi kesalahan saat melakukan check-in', 'error');
                    })
                    .finally(() => {
                        hideLoading();
                    });
            }
        }

        function loadJadwalOptions() {
            fetch('/admin/jadwal-options', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const select = document.getElementById('jadwal-filter');
                        select.innerHTML = '<option value="">Semua Jadwal</option>';

                        data.data.forEach(jadwal => {
                            const option = document.createElement('option');
                            option.value = jadwal.id;
                            option.textContent =
                                `${jadwal.rute_asal} → ${jadwal.rute_tujuan} (${formatDate(jadwal.tanggal)} ${jadwal.waktu_berangkat})`;
                            select.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading jadwal options:', error);
                });
        }

        function resetFilters() {
            document.getElementById('search-passenger').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('jadwal-filter').value = '';
            document.getElementById('date-filter').value = '';
            loadPassengerData(1);
        }

        // QR Scanner Functions
        function openQrScanner() {
            const modal = document.getElementById('qrScannerModal');
            modal.classList.remove('hidden');

            // Reset to camera tab
            switchTab('camera');

            // Clear previous inputs
            document.getElementById('qrCodeInput').value = '';
            document.getElementById('upload-preview').classList.add('hidden');

            // Initialize camera scanner
            initializeCameraScanner();
        }

        function initializeCameraScanner() {
            if (currentTab !== 'camera') return;

            // Request camera permission first
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    // Permission granted, stop the stream and start QR scanner
                    stream.getTracks().forEach(track => track.stop());
                    startQrScanner();
                })
                .catch(function(err) {
                    console.error("Camera permission denied:", err);
                    showCameraPermissionError();
                });
        }

        function startQrScanner() {
            html5QrCode = new Html5Qrcode("qr-reader");

            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                // Stop scanning
                html5QrCode.stop().then(() => {
                    processQrScanResult(decodedText);
                    closeQrScanner();
                }).catch(err => {
                    console.error("Error stopping scanner:", err);
                });
            };

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            };

            // Start scanner
            html5QrCode.start({
                    facingMode: "environment"
                },
                config,
                qrCodeSuccessCallback
            ).catch(err => {
                console.error("Error starting scanner:", err);
                // Show error message in camera area
                document.getElementById('qr-reader').innerHTML = `
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <p class="text-sm text-red-500 mb-2">Kamera tidak dapat diakses</p>
                        <p class="text-xs text-gray-500 mb-3">Gunakan tab Manual atau Upload</p>
                        <button onclick="switchTab('manual')" class="px-3 py-1 bg-blue-600 text-white text-xs rounded">
                            Ke Manual Input
                        </button>
                    </div>
                `;
            });
        }

        function closeQrScanner() {
            if (html5QrCode && html5QrCode.isScanning) {
                html5QrCode.stop().catch(err => {
                    console.error("Error stopping scanner:", err);
                });
            }
            document.getElementById('qrScannerModal').classList.add('hidden');
        }

        function processQrScan() {
            let qrCode = '';

            if (currentTab === 'manual') {
                qrCode = document.getElementById('qrCodeInput').value.trim();
            } else if (currentTab === 'upload') {
                qrCode = document.getElementById('qrCodeInput').value.trim();
            }

            if (!qrCode) {
                showAlert('Error', 'Silakan masukkan kode QR atau upload gambar terlebih dahulu', 'error');
                return;
            }

            processQrScanResult(qrCode);
        }

        // IMPROVED: Process simple QR code format
        function processQrScanResult(qrCode) {
            showLoading();

            // Normalize QR code - simple format is just the booking code
            let normalizedCode = qrCode.trim();

            // If it doesn't start with TKT-, add it
            if (!normalizedCode.startsWith('TKT-') && normalizedCode.match(/^[A-Z0-9]+$/)) {
                normalizedCode = 'TKT-' + normalizedCode;
            }

            // Simple POST with QR code data
            fetch(`/api/penumpang/checkin`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        qr_code: normalizedCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Success', `Penumpang berhasil check-in! Kode: ${normalizedCode}`, 'success');
                        loadPassengerData(currentPage);
                        closeQrScanner();
                    } else {
                        showAlert('Error', data.message || 'Gagal melakukan check-in', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error', 'Terjadi kesalahan saat melakukan check-in', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
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

        function formatDate(dateString) {
            if (!dateString) return '-';
            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        function formatDateTime(dateTimeString) {
            if (!dateTimeString) return '-';
            const date = new Date(dateTimeString);
            return date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                }) +
                ' ' + date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
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

        function showCameraPermissionError() {
            document.getElementById('qr-reader').innerHTML = `
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>
                    </svg>
                    <p class="text-sm text-red-500 mb-2">Akses kamera ditolak</p>
                    <p class="text-xs text-gray-500 mb-3">Silakan izinkan akses kamera di browser Anda</p>
                    <div class="space-y-2">
                        <button onclick="requestCameraPermission()" class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                            Coba Lagi
                        </button>
                        <br>
                        <button onclick="switchTab('manual')" class="px-3 py-1 bg-gray-600 text-white text-xs rounded hover:bg-gray-700">
                            Input Manual
                        </button>
                    </div>
                </div>
            `;
        }

        function requestCameraPermission() {
            initializeCameraScanner();
        }
    </script>
@endsection
