@extends('layouts.admin')

@section('title', 'Schedule Management')
@section('header', 'Manajemen Jadwal')

@section('content')
<!-- Success/Error Messages -->
<div id="alertContainer" class="mb-4 hidden">
    <div id="alertMessage" class="p-4 text-sm rounded-lg" role="alert">
        <span class="font-medium" id="alertText"></span>
    </div>
</div>

<div class="mb-6">
    <!-- Main Schedule List -->
    <div>
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-lg font-medium text-gray-800">Jadwal Perjalanan</h3>
                    <button id="openModalBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Tambah Jadwal
                    </button>
                </div>
            </div>

            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex flex-wrap gap-2" id="statusFilter">
                        <button data-status="semua" class="filter-btn px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-md font-medium transition-colors">Semua</button>
                        <button data-status="aktif" class="filter-btn px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Aktif</button>
                        <button data-status="selesai" class="filter-btn px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Selesai</button>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative flex-grow">
                            <input type="text" id="searchInput" class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Search" autocomplete="off">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <!-- Clear search button -->
                            <button type="button" id="clearSearchBtn" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden" title="Clear search">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <!-- Search results counter -->
                        <div id="searchResultsCounter" class="text-sm text-gray-500 hidden">
                            <span id="searchResultsCount">0</span> hasil
                        </div>
                    </div>
                </div>

                <!-- Schedule Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table id="schedulesTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KAPAL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RUTE</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TANGGAL & WAKTU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TIKET TERJUAL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="schedulesTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Table content will be loaded here -->
                        </tbody>
                    </table>

                    <!-- Loading State -->
                    <div id="loadingState" class="flex justify-center items-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <span class="ml-2 text-gray-600">Memuat data...</span>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="hidden text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-8 0h8m-8 0V7a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal ditemukan</h3>
                        <p class="mt-1 text-sm text-gray-500" id="emptyStateMessage">Mulai dengan menambahkan jadwal baru atau ubah kata kunci pencarian.</p>
                    </div>

                    <!-- Pagination -->
                    <div id="pagination" class="flex items-center justify-between px-6 py-4 border-t border-gray-200">
                        <div class="text-sm text-gray-700" id="pagination-info">
                            Menampilkan <span id="pagination-start">0</span> - <span id="pagination-end">0</span> dari <span id="pagination-total">0</span> jadwal
                        </div>
                        <div class="flex items-center space-x-2" id="pagination-controls">
                            <!-- Pagination controls will be generated here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Ticket Information Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Tiket</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-blue-800">Tiket Terjual Hari Ini</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-blue-800" id="ticketsSoldToday">87</p>
                    <p class="text-sm text-blue-600">Tiket terjual</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-green-800">Pendapatan Hari Ini</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-green-800" id="revenueToday">Rp 4,350,000</p>
                    <p class="text-sm text-green-600">Pendapatan hari ini</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-yellow-800">Jadwal Aktif</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-yellow-800" id="activeSchedules">12</p>
                    <p class="text-sm text-yellow-600">Jadwal berjalan</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-purple-800">Kapasitas Terisi</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-purple-800" id="capacityFilled">65%</p>
                    <p class="text-sm text-purple-600">Rata-rata terisi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Penjualan Tiket Mingguan</h3>
        </div>
        <div class="p-6">
            <div class="h-60">
                <!-- Simple Chart Placeholder -->
                <div class="w-full h-full flex items-end space-x-2">
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 60%"></div>
                        <div class="text-xs text-gray-500 mt-2">Sen</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 75%"></div>
                        <div class="text-xs text-gray-500 mt-2">Sel</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 45%"></div>
                        <div class="text-xs text-gray-500 mt-2">Rab</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 80%"></div>
                        <div class="text-xs text-gray-500 mt-2">Kam</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 65%"></div>
                        <div class="text-xs text-gray-500 mt-2">Jum</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 90%"></div>
                        <div class="text-xs text-gray-500 mt-2">Sab</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: 70%"></div>
                        <div class="text-xs text-gray-500 mt-2">Min</div>
                    </div>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Total Penjualan Minggu Ini</p>
                    <p class="text-2xl font-bold text-gray-800">Rp 28,750,000</p>
                    <p class="text-sm text-green-600 mt-1">+15.3% dari minggu lalu</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Tiket Terjual Minggu Ini</p>
                    <p class="text-2xl font-bold text-gray-800">575</p>
                    <p class="text-sm text-green-600 mt-1">+12.8% dari minggu lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Schedule Modal -->
<div id="addScheduleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl mx-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Tambah Jadwal Baru</h3>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-6 py-4">
            <form id="addScheduleForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label for="add_kapal_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kapal *</label>
                        <select id="add_kapal_id" name="kapal_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih kapal...</option>
                            <!-- Options will be loaded from API -->
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>

                        <!-- Selected Boat Preview -->
                        <div id="selectedBoatPreview" class="mt-3 p-3 bg-gray-50 rounded-md hidden">
                            <div class="flex items-center">
                                <img id="previewBoatImage" src="/placeholder.svg" alt="Boat" class="h-12 w-12 rounded-lg object-cover">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900" id="previewBoatName"></div>
                                    <div class="text-sm text-gray-500">Kapasitas: <span id="previewBoatCapacity"></span> penumpang</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="add_rute_asal" class="block text-sm font-medium text-gray-700 mb-1">Rute Asal *</label>
                        <select id="add_rute_asal" name="rute_asal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih asal...</option>
                            <option value="Sanur">Sanur</option>
                            <option value="Nusa Penida">Nusa Penida</option>
                            <option value="Nusa Lembongan">Nusa Lembongan</option>
                            <option value="Nusa Ceningan">Nusa Ceningan</option>
                            {{-- <option value="Gili Trawangan">Gili Trawangan</option> --}}
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="add_rute_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Rute Tujuan *</label>
                        <select id="add_rute_tujuan" name="rute_tujuan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih tujuan...</option>
                            <option value="Sanur">Sanur</option>
                            <option value="Nusa Penida">Nusa Penida</option>
                            <option value="Nusa Lembongan">Nusa Lembongan</option>
                            <option value="Nusa Ceningan">Nusa Ceningan</option>
                            {{-- <option value="Gili Trawangan">Gili Trawangan</option> --}}
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="add_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                        <input type="date" id="add_tanggal" name="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="add_waktu_berangkat" class="block text-sm font-medium text-gray-700 mb-1">Waktu Berangkat *</label>
                        <input type="time" id="add_waktu_berangkat" name="waktu_berangkat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="add_waktu_tiba" class="block text-sm font-medium text-gray-700 mb-1">Waktu Tiba *</label>
                        <input type="time" id="add_waktu_tiba" name="waktu_tiba" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="add_harga" class="block text-sm font-medium text-gray-700 mb-1">Harga Tiket *</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 rounded-l-md">Rp</span>
                            <input type="number" id="add_harga" name="harga" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="0" required>
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Jadwal</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" id="add_statusActive" name="status" value="aktif" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                <label for="add_statusActive" class="ml-2 text-sm text-gray-700">Aktif</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="add_statusInactive" name="status" value="tidak aktif" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <label for="add_statusInactive" class="ml-2 text-sm text-gray-700">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="add_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea id="add_keterangan" name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan tambahan (opsional)"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-2">
            <button id="cancelBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            <button id="saveScheduleBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Simpan</button>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div id="editScheduleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl mx-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Edit Jadwal</h3>
            <button id="closeEditModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-6 py-4">
            <form id="editScheduleForm">
                <input type="hidden" id="edit_schedule_id" name="schedule_id">
                <!-- Same form fields as add modal but with edit_ prefixes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label for="edit_kapal_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kapal *</label>
                        <select id="edit_kapal_id" name="kapal_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih kapal...</option>
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_rute_asal" class="block text-sm font-medium text-gray-700 mb-1">Rute Asal *</label>
                        <select id="edit_rute_asal" name="rute_asal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih asal...</option>
                            <option value="Sanur">Sanur</option>
                            <option value="Nusa Penida">Nusa Penida</option>
                            <option value="Nusa Lembongan">Nusa Lembongan</option>
                            <option value="Nusa Ceningan">Nusa Ceningan</option>
                            <option value="Gili Trawangan">Gili Trawangan</option>
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_rute_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Rute Tujuan *</label>
                        <select id="edit_rute_tujuan" name="rute_tujuan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih tujuan...</option>
                            <option value="Sanur">Sanur</option>
                            <option value="Nusa Penida">Nusa Penida</option>
                            <option value="Nusa Lembongan">Nusa Lembongan</option>
                            <option value="Nusa Ceningan">Nusa Ceningan</option>
                            <option value="Gili Trawangan">Gili Trawangan</option>
                        </select>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                        <input type="date" id="edit_tanggal" name="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_waktu_berangkat" class="block text-sm font-medium text-gray-700 mb-1">Waktu Berangkat *</label>
                        <input type="time" id="edit_waktu_berangkat" name="waktu_berangkat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_waktu_tiba" class="block text-sm font-medium text-gray-700 mb-1">Waktu Tiba *</label>
                        <input type="time" id="edit_waktu_tiba" name="waktu_tiba" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="edit_harga" class="block text-sm font-medium text-gray-700 mb-1">Harga Tiket *</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 rounded-l-md">Rp</span>
                            <input type="number" id="edit_harga" name="harga" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Jadwal</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" id="edit_statusActive" name="status" value="aktif" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="edit_statusActive" class="ml-2 text-sm text-gray-700">Aktif</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="edit_statusCompleted" name="status" value="selesai" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <label for="edit_statusCompleted" class="ml-2 text-sm text-gray-700">Selesai</label>
                            </div>

                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan tambahan (opsional)"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-2">
            <button id="cancelEditBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            <button id="updateScheduleBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Update</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
        <div class="px-6 py-4">
            <div class="flex items-center">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Jadwal</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500" id="deleteConfirmText">
                        Apakah Anda yakin ingin menghapus jadwal ini?
                    </p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">Hapus</button>
            <button id="cancelDeleteBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
        </div>
    </div>
</div>

<style>
    mark {
        background-color: #fef08a;
        padding: 0 2px;
        border-radius: 2px;
    }
    .search-loading {
        animation: spin 1s linear infinite;
    }
</style>

<script>
    // Configuration
    const API_BASE_URL = '{{ env("APP_API_URL", "http://boat-sanur.test/api") }}';
    const IMAGES_BASE_URL = '{{ url("") }}';
    const ITEMS_PER_PAGE = 10;

    // Global variables
    let schedules = [];
    let filteredSchedules = [];
    let boats = [];
    let currentDeleteId = null;
    let currentPage = 1;
    let totalPages = 1;
    let searchTimeout = null;

    // DOM Elements
    const elements = {
        // Modals
        addModal: document.getElementById('addScheduleModal'),
        editModal: document.getElementById('editScheduleModal'),
        deleteModal: document.getElementById('deleteConfirmModal'),

        // Buttons
        openModalBtn: document.getElementById('openModalBtn'),
        closeModalBtn: document.getElementById('closeModalBtn'),
        closeEditModalBtn: document.getElementById('closeEditModalBtn'),
        cancelBtn: document.getElementById('cancelBtn'),
        cancelEditBtn: document.getElementById('cancelEditBtn'),
        saveScheduleBtn: document.getElementById('saveScheduleBtn'),
        updateScheduleBtn: document.getElementById('updateScheduleBtn'),
        confirmDeleteBtn: document.getElementById('confirmDeleteBtn'),
        cancelDeleteBtn: document.getElementById('cancelDeleteBtn'),
        clearSearchBtn: document.getElementById('clearSearchBtn'),

        // Forms
        addScheduleForm: document.getElementById('addScheduleForm'),
        editScheduleForm: document.getElementById('editScheduleForm'),

        // Table
        schedulesTableBody: document.getElementById('schedulesTableBody'),
        loadingState: document.getElementById('loadingState'),
        emptyState: document.getElementById('emptyState'),
        emptyStateMessage: document.getElementById('emptyStateMessage'),

        // Search and Filter
        searchInput: document.getElementById('searchInput'),
        filterButtons: document.querySelectorAll('.filter-btn'),
        searchResultsCounter: document.getElementById('searchResultsCounter'),
        searchResultsCount: document.getElementById('searchResultsCount'),

        // Alert
        alertContainer: document.getElementById('alertContainer'),
        alertMessage: document.getElementById('alertMessage'),
        alertText: document.getElementById('alertText'),

        // Pagination
        pagination: document.getElementById('pagination'),
        paginationInfo: document.getElementById('pagination-info'),
        paginationStart: document.getElementById('pagination-start'),
        paginationEnd: document.getElementById('pagination-end'),
        paginationTotal: document.getElementById('pagination-total'),
        paginationControls: document.getElementById('pagination-controls'),

        // Boat selection
        boatSelect: document.getElementById('add_kapal_id'),
        editBoatSelect: document.getElementById('edit_kapal_id'),
        selectedBoatPreview: document.getElementById('selectedBoatPreview'),
        previewBoatImage: document.getElementById('previewBoatImage'),
        previewBoatName: document.getElementById('previewBoatName'),
        previewBoatCapacity: document.getElementById('previewBoatCapacity')
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        loadBoats();
        loadSchedules();
        setMinDate();
    });

    // Set minimum date to today
    function setMinDate() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('add_tanggal').min = today;
        document.getElementById('edit_tanggal').min = today;
    }

    // Event Listeners
    function setupEventListeners() {
        // Modal controls
        elements.openModalBtn.addEventListener('click', openAddModal);
        elements.closeModalBtn.addEventListener('click', closeAddModal);
        elements.closeEditModalBtn.addEventListener('click', closeEditModal);
        elements.cancelBtn.addEventListener('click', closeAddModal);
        elements.cancelEditBtn.addEventListener('click', closeEditModal);
        elements.cancelDeleteBtn.addEventListener('click', closeDeleteModal);

        // Form submissions
        elements.saveScheduleBtn.addEventListener('click', handleAddSchedule);
        elements.updateScheduleBtn.addEventListener('click', handleUpdateSchedule);
        elements.confirmDeleteBtn.addEventListener('click', handleConfirmDelete);

        // Search and filter - IMPROVED
        elements.searchInput.addEventListener('input', handleSearch);
        elements.searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                clearSearch();
            }
        });
        elements.searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleSearch();
            }
        });

        // Clear search button
        elements.clearSearchBtn.addEventListener('click', clearSearch);

        elements.filterButtons.forEach(btn => {
            btn.addEventListener('click', handleFilter);
        });

        // Boat selection
        elements.boatSelect.addEventListener('change', handleBoatSelection);

        // Close modals on backdrop click
        elements.addModal.addEventListener('click', (e) => {
            if (e.target === elements.addModal) closeAddModal();
        });
        elements.editModal.addEventListener('click', (e) => {
            if (e.target === elements.editModal) closeEditModal();
        });
        elements.deleteModal.addEventListener('click', (e) => {
            if (e.target === elements.deleteModal) closeDeleteModal();
        });
    }

    // Load boats from API
    async function loadBoats() {
        try {
            const response = await fetch(`${API_BASE_URL}/kapal`);
            const result = await response.json();

            if (result.success) {
                boats = result.data.filter(boat => boat.status === 'aktif'); // Only active boats
                populateBoatSelects();
            } else {
                showAlert('Gagal memuat data kapal', 'error');
            }
        } catch (error) {
            console.error('Error loading boats:', error);
            showAlert('Gagal memuat data kapal', 'error');
        }
    }

    // Populate boat select options
    function populateBoatSelects() {
        const addOptions = boats.map(boat =>
            `<option value="${boat.id}" data-name="${boat.nama_kapal}" data-capacity="${boat.kapasitas}" data-image="${boat.foto_kapal || ''}">${boat.id} - ${boat.nama_kapal}</option>`
        ).join('');

        elements.boatSelect.innerHTML = '<option value="">Pilih kapal...</option>' + addOptions;
        elements.editBoatSelect.innerHTML = '<option value="">Pilih kapal...</option>' + addOptions;
    }

    // Handle boat selection
    function handleBoatSelection(e) {
        const selectedOption = e.target.selectedOptions[0];
        if (selectedOption && selectedOption.value) {
            const boatName = selectedOption.dataset.name;
            const boatCapacity = selectedOption.dataset.capacity;
            const boatImage = selectedOption.dataset.image;

            elements.previewBoatName.textContent = boatName;
            elements.previewBoatCapacity.textContent = boatCapacity;

            if (boatImage) {
                elements.previewBoatImage.src = `${IMAGES_BASE_URL}/storage/${boatImage}`;
            } else {
                elements.previewBoatImage.src = '/placeholder.svg?height=48&width=48';
            }

            elements.selectedBoatPreview.classList.remove('hidden');
        } else {
            elements.selectedBoatPreview.classList.add('hidden');
        }
    }

    // Modal functions
    function openAddModal() {
        elements.addModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        clearForm(elements.addScheduleForm);
        elements.selectedBoatPreview.classList.add('hidden');
    }

    function closeAddModal() {
        elements.addModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        clearForm(elements.addScheduleForm);
    }

    function closeEditModal() {
        elements.editModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        clearForm(elements.editScheduleForm);
    }

    function closeDeleteModal() {
        elements.deleteModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentDeleteId = null;
    }

    function clearForm(form) {
        form.reset();
        clearErrors(form);
    }

    function clearErrors(form) {
        form.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
        });
        form.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
    }

    // API functions
    async function loadSchedules() {
        try {
            showLoading(true);
            const response = await fetch(`${API_BASE_URL}/jadwal`);
            const result = await response.json();

            if (result.success) {
                schedules = result.data;
                filteredSchedules = [...schedules];
                currentPage = 1;
                renderTable();
                updatePagination();
            } else {
                showAlert('Gagal memuat data jadwal', 'error');
            }
        } catch (error) {
            console.error('Error loading schedules:', error);
            showAlert('Gagal memuat data jadwal', 'error');
        } finally {
            showLoading(false);
        }
    }

    async function handleAddSchedule(e) {
        e.preventDefault();

        if (!validateFormInputs(elements.addScheduleForm)) {
            return;
        }

        const formData = {
            kapal_id: document.getElementById('add_kapal_id').value,
            rute_asal: document.getElementById('add_rute_asal').value,
            rute_tujuan: document.getElementById('add_rute_tujuan').value,
            tanggal: document.getElementById('add_tanggal').value,
            waktu_berangkat: document.getElementById('add_waktu_berangkat').value,
            waktu_tiba: document.getElementById('add_waktu_tiba').value,
            harga_tiket: document.getElementById('add_harga').value,
            keterangan: document.getElementById('add_keterangan').value,
            status: document.querySelector('input[name="status"]:checked').value
        };

        console.log('Data yang dikirim:', formData); // Debugging

        try {
            setLoadingButton(elements.saveScheduleBtn, true, 'Menyimpan...');

            const response = await fetch(`${API_BASE_URL}/jadwal`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Gagal menyimpan jadwal');
            }

            showAlert('Jadwal berhasil ditambahkan', 'success');
            closeAddModal();
            loadSchedules();
        } catch (error) {
            console.error('Error:', error);
            showAlert(error.message || 'Terjadi kesalahan saat menyimpan jadwal', 'error');
        } finally {
            setLoadingButton(elements.saveScheduleBtn, false, 'Simpan');
        }
    }

    async function handleUpdateSchedule(e) {
        e.preventDefault();

        if (!validateFormInputs(elements.editScheduleForm)) {
            return;
        }

        const scheduleId = document.getElementById('edit_schedule_id').value;
        const formData = {
            kapal_id: document.getElementById('edit_kapal_id').value,
            rute_asal: document.getElementById('edit_rute_asal').value,
            rute_tujuan: document.getElementById('edit_rute_tujuan').value,
            tanggal: document.getElementById('edit_tanggal').value,
            waktu_berangkat: document.getElementById('edit_waktu_berangkat').value,
            waktu_tiba: document.getElementById('edit_waktu_tiba').value,
            harga_tiket: document.getElementById('edit_harga').value,
            keterangan: document.getElementById('edit_keterangan').value,
            status: document.querySelector('#editScheduleForm input[name="status"]:checked').value
        };

        try {
            setLoadingButton(elements.updateScheduleBtn, true, 'Memperbaharui...');
            clearErrors(elements.editScheduleForm);

            const response = await fetch(`${API_BASE_URL}/jadwal/${scheduleId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
                if (result.errors) {
                    showFormErrors(elements.editScheduleForm, result.errors);
                    showAlert('Mohon periksa kembali input Anda', 'error');
                } else {
                    showAlert(result.message || 'Gagal mengupdate jadwal', 'error');
                }
                return;
            }

            showAlert('Jadwal berhasil diupdate', 'success');
            closeEditModal();
            loadSchedules();

        } catch (error) {
            console.error('Error updating schedule:', error);
            showAlert('Terjadi kesalahan sistem. Silakan coba lagi.', 'error');
        } finally {
            setLoadingButton(elements.updateScheduleBtn, false, 'Update');
        }
    }

    async function editSchedule(id) {
        try {
            const response = await fetch(`${API_BASE_URL}/jadwal/${id}`);
            const result = await response.json();

            if (result.success) {
                const schedule = result.data;

                // Fill form fields
                document.getElementById('edit_schedule_id').value = schedule.id;
                document.getElementById('edit_kapal_id').value = schedule.kapal_id;
                document.getElementById('edit_rute_asal').value = schedule.rute_asal;
                document.getElementById('edit_rute_tujuan').value = schedule.rute_tujuan;
                document.getElementById('edit_tanggal').value = schedule.tanggal.split('T')[0];
                document.getElementById('edit_waktu_berangkat').value = schedule.waktu_berangkat;
                document.getElementById('edit_waktu_tiba').value = schedule.waktu_tiba;
                document.getElementById('edit_harga').value = schedule.harga_tiket;
                document.getElementById('edit_keterangan').value = schedule.keterangan || '';

                // Set status radio button
                const statusRadios = {
                    'aktif': document.getElementById('edit_statusActive'),
                    'selesai': document.getElementById('edit_statusCompleted'),
                };

                Object.values(statusRadios).forEach(radio => {
                    radio.checked = false;
                });

                if (schedule.status && statusRadios[schedule.status]) {
                    statusRadios[schedule.status].checked = true;
                }

                elements.editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                showAlert(result.message || 'Gagal mengambil data jadwal', 'error');
            }
        } catch (error) {
            console.error('Error fetching schedule:', error);
            showAlert('Gagal mengambil data jadwal', 'error');
        }
    }

    function deleteSchedule(id, route) {
        currentDeleteId = id;
        document.getElementById('deleteConfirmText').textContent =
            `Apakah Anda yakin ingin menghapus jadwal "${route}"?`;
        elements.deleteModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    async function handleConfirmDelete() {
        if (!currentDeleteId) return;

        try {
            setLoadingButton(elements.confirmDeleteBtn, true, 'Menghapus...');

            const response = await fetch(`${API_BASE_URL}/jadwal/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                showAlert('Jadwal berhasil dihapus', 'success');
                closeDeleteModal();
                loadSchedules();
            } else {
                showAlert(result.message || 'Gagal menghapus jadwal', 'error');
            }
        } catch (error) {
            console.error('Error deleting schedule:', error);
            showAlert('Terjadi kesalahan sistem', 'error');
        } finally {
            setLoadingButton(elements.confirmDeleteBtn, false, 'Hapus');
        }
    }

    // Table rendering
    function renderTable() {
        const tbody = elements.schedulesTableBody;

        if (filteredSchedules.length === 0) {
            tbody.innerHTML = '';
            elements.emptyState.classList.remove('hidden');
            elements.pagination.classList.add('hidden');

            // Update empty state message based on search
            const searchTerm = elements.searchInput.value.trim();
            if (searchTerm) {
                elements.emptyStateMessage.textContent = `Tidak ada jadwal yang cocok dengan pencarian "${searchTerm}". Coba kata kunci lain.`;
            } else {
                elements.emptyStateMessage.textContent = 'Mulai dengan menambahkan jadwal baru.';
            }
            return;
        }

        elements.emptyState.classList.add('hidden');
        elements.pagination.classList.remove('hidden');

        // Calculate pagination
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = Math.min(startIndex + ITEMS_PER_PAGE, filteredSchedules.length);
        const paginatedSchedules = filteredSchedules.slice(startIndex, endIndex);

        tbody.innerHTML = paginatedSchedules.map(schedule => {
            const boat = boats.find(b => b.id === schedule.kapal_id);
            const boatName = boat ? boat.nama_kapal : 'Unknown';
            const boatImage = boat && boat.foto_kapal ? `${IMAGES_BASE_URL}/storage/${boat.foto_kapal}` : '/placeholder.svg?height=40&width=40';
            const tiketTerjual = schedule.tiket_terjual || 0;
            const kapasitas = schedule.kapasitas_kapal || schedule.kapal?.kapasitas || 0;
            const persentaseTerisi = kapasitas > 0 ? Math.min(100, Math.round((tiketTerjual / kapasitas) * 100)) : 0;

            return `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${schedule.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            ${boat.foto_kapal ?
                                `<img src="${IMAGES_BASE_URL}/storage/${boat.foto_kapal}" alt="Foto Kapal" class="h-12 w-12 rounded-lg object-cover">` :
                                `<div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>`
                            }
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${boatName}</div>
                                <div class="text-sm text-gray-500">${schedule.kapal_id}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${schedule.rute_asal} → ${schedule.rute_tujuan}</div>
                        <div class="text-sm text-gray-500">Rp ${parseInt(schedule.harga_tiket).toLocaleString('id-ID')}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${formatDate(schedule.tanggal)}</div>
                        <div class="text-sm text-gray-500">${schedule.waktu_berangkat} - ${schedule.waktu_tiba}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${tiketTerjual}/${kapasitas}</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${persentaseTerisi}%"></div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(schedule.status)}">
                            ${getStatusText(schedule.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button onclick="editSchedule('${schedule.id}')" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-md transition-colors" title="Edit Jadwal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="deleteSchedule('${schedule.id}', '${schedule.rute_asal} → ${schedule.rute_tujuan}')" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-md transition-colors" title="Hapus Jadwal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');

        updatePaginationInfo(startIndex, endIndex);

        // Highlight search terms if there's a search
        const searchTerm = elements.searchInput.value.trim();
        if (searchTerm) {
            highlightSearchTerms(searchTerm);
        }
    }

    // IMPROVED Search and filter functions
    function handleSearch() {
        const searchTerm = elements.searchInput.value.toLowerCase().trim();
        const activeFilter = getActiveFilter();

        // Show/hide clear button
        if (searchTerm.length > 0) {
            elements.clearSearchBtn.classList.remove('hidden');
        } else {
            elements.clearSearchBtn.classList.add('hidden');
        }

        // Debouncing for better performance
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterTable(searchTerm, activeFilter);
        }, 300);
    }

    function handleFilter(e) {
        elements.filterButtons.forEach(btn => {
            btn.classList.remove('bg-blue-50', 'text-blue-600');
            btn.classList.add('text-gray-600');
        });
        e.target.classList.add('bg-blue-50', 'text-blue-600');
        e.target.classList.remove('text-gray-600');

        const status = e.target.getAttribute('data-status');
        const searchTerm = elements.searchInput.value.toLowerCase().trim();
        filterTable(searchTerm, status);
    }

    function getActiveFilter() {
        const activeButton = document.querySelector('.filter-btn.bg-blue-50');
        return activeButton ? activeButton.getAttribute('data-status') : 'semua';
    }

    // IMPROVED filterTable function with comprehensive search
    function filterTable(searchTerm, status) {
        filteredSchedules = schedules.filter(schedule => {
            const boat = boats.find(b => b.id === schedule.kapal_id);
            const boatName = boat ? boat.nama_kapal.toLowerCase() : '';
            const route = `${schedule.rute_asal} ${schedule.rute_tujuan}`.toLowerCase();
            const formattedDate = formatDate(schedule.tanggal).toLowerCase();
            const price = parseInt(schedule.harga_tiket).toLocaleString('id-ID');

            // Enhanced search - multiple fields
            const matchesSearch = !searchTerm ||
                schedule.id.toString().includes(searchTerm) ||
                boatName.includes(searchTerm) ||
                schedule.rute_asal.toLowerCase().includes(searchTerm) ||
                schedule.rute_tujuan.toLowerCase().includes(searchTerm) ||
                route.includes(searchTerm) ||
                formattedDate.includes(searchTerm) ||
                price.includes(searchTerm) ||
                schedule.waktu_berangkat.includes(searchTerm) ||
                schedule.waktu_tiba.includes(searchTerm) ||
                (schedule.keterangan && schedule.keterangan.toLowerCase().includes(searchTerm));

            const matchesFilter = status === 'semua' || schedule.status === status;
            return matchesSearch && matchesFilter;
        });

        currentPage = 1;
        updatePagination();
        updateSearchResultsCounter();
    }

    // Clear search function
    function clearSearch() {
        elements.searchInput.value = '';
        elements.clearSearchBtn.classList.add('hidden');
        const activeFilter = getActiveFilter();
        filterTable('', activeFilter);
    }

    // Update search results counter
    function updateSearchResultsCounter() {
        const searchTerm = elements.searchInput.value.trim();
        if (searchTerm && filteredSchedules.length !== schedules.length) {
            elements.searchResultsCount.textContent = filteredSchedules.length;
            elements.searchResultsCounter.classList.remove('hidden');
        } else {
            elements.searchResultsCounter.classList.add('hidden');
        }
    }

    // Highlight search terms function
    function highlightSearchTerms(searchTerm) {
        const tableRows = document.querySelectorAll('#schedulesTableBody tr');
        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                // Skip cells with complex HTML (images, buttons, etc.)
                if (cell.querySelector('img, button, svg, div.w-full')) {
                    return;
                }

                const textNodes = getTextNodes(cell);
                textNodes.forEach(textNode => {
                    const text = textNode.textContent;
                    if (text.toLowerCase().includes(searchTerm)) {
                        const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
                        const highlightedText = text.replace(regex, '<mark>$1</mark>');

                        if (highlightedText !== text) {
                            const wrapper = document.createElement('span');
                            wrapper.innerHTML = highlightedText;
                            textNode.parentNode.replaceChild(wrapper, textNode);
                        }
                    }
                });
            });
        });
    }

    // Helper function to get text nodes
    function getTextNodes(element) {
        const textNodes = [];
        const walker = document.createTreeWalker(
            element,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );

        let node;
        while (node = walker.nextNode()) {
            if (node.textContent.trim()) {
                textNodes.push(node);
            }
        }
        return textNodes;
    }

    // Helper function to escape regex special characters
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Pagination functions
    function updatePagination() {
        totalPages = Math.ceil(filteredSchedules.length / ITEMS_PER_PAGE);

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        renderPaginationControls();
        renderTable();
    }

    function renderPaginationControls() {
        const controls = elements.paginationControls;

        if (totalPages <= 1) {
            controls.innerHTML = '';
            return;
        }

        let html = '';

        // Previous button
        html += `
            <button
                class="px-3 py-1 border border-gray-300 rounded-md ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}"
                ${currentPage === 1 ? 'disabled' : 'onclick="changePage(' + (currentPage - 1) + ')"'}
            >
                Previous
            </button>
        `;

        // Page numbers
        const maxVisiblePages = 5;
        const pages = getPageNumbers(totalPages, currentPage, maxVisiblePages);

        pages.forEach(page => {
            if (page === '...') {
                html += `<span class="px-3 py-1">...</span>`;
            } else {
                html += `
                    <button
                        class="px-3 py-1 border border-gray-300 rounded-md min-w-[40px] ${page === currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'}"
                        onclick="changePage(${page})"
                    >
                        ${page}
                    </button>
                `;
            }
        });

        // Next button
        html += `
            <button
                class="px-3 py-1 border border-gray-300 rounded-md ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}"
                ${currentPage === totalPages ? 'disabled' : 'onclick="changePage(' + (currentPage + 1) + ')"'}
            >
                Next
            </button>
        `;

        controls.innerHTML = html;
    }

    function getPageNumbers(totalPages, currentPage, maxVisiblePages) {
        const pages = [];

        if (totalPages <= maxVisiblePages) {
            for (let i = 1; i <= totalPages; i++) {
                pages.push(i);
            }
        } else {
            pages.push(1);

            let startPage = Math.max(2, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages - 1, startPage + maxVisiblePages - 3);

            if (startPage === 2) {
                endPage = Math.min(totalPages - 1, maxVisiblePages - 1);
            }

            if (endPage === totalPages - 1) {
                startPage = Math.max(2, totalPages - maxVisiblePages + 2);
            }

            if (startPage > 2) {
                pages.push('...');
            }

            for (let i = startPage; i <= endPage; i++) {
                pages.push(i);
            }

            if (endPage < totalPages - 1) {
                pages.push('...');
            }

            pages.push(totalPages);
        }

        return pages;
    }

    function updatePaginationInfo(startIndex, endIndex) {
        elements.paginationStart.textContent = startIndex + 1;
        elements.paginationEnd.textContent = endIndex;
        elements.paginationTotal.textContent = filteredSchedules.length;
    }

    function changePage(page) {
        currentPage = page;
        renderTable();
        renderPaginationControls();

        document.getElementById('schedulesTable').scrollIntoView({ behavior: 'smooth' });
    }

    // Utility functions
    function showLoading(show) {
        if (show) {
            elements.loadingState.classList.remove('hidden');
            elements.schedulesTableBody.innerHTML = '';
            elements.emptyState.classList.add('hidden');
            elements.pagination.classList.add('hidden');
        } else {
            elements.loadingState.classList.add('hidden');
        }
    }

    function setLoadingButton(button, loading, text) {
        if (loading) {
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${text}
            `;
        } else {
            button.disabled = false;
            button.innerHTML = text;
        }
    }

    function showFormErrors(form, errors) {
        Object.keys(errors).forEach(field => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('border-red-500');
                const errorDiv = input.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = errors[field][0];
                }
            }
        });
    }

    function getStatusBadgeClass(status) {
        switch(status) {
            case 'aktif': return 'bg-green-100 text-green-800';
            case 'selesai': return 'bg-gray-100 text-gray-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    function getStatusText(status) {
        switch(status) {
            case 'aktif': return 'Aktif';
            case 'selesai': return 'Selesai';
            default: return status;
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    function showAlert(message, type = 'success') {
        const alertClasses = type === 'success' ? 'text-green-800 bg-green-50' : 'text-red-800 bg-red-50';
        elements.alertMessage.className = `p-4 text-sm rounded-lg ${alertClasses}`;
        elements.alertText.textContent = message;
        elements.alertContainer.classList.remove('hidden');

        setTimeout(() => {
            elements.alertContainer.classList.add('hidden');
        }, 5000);
    }

    function validateFormInputs(form) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                const errorDiv = field.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Field ini wajib diisi';
                }
                isValid = false;
            }
        });

        // Validate route (asal and tujuan should be different)
        const asalField = form.querySelector('[name="rute_asal"]');
        const tujuanField = form.querySelector('[name="rute_tujuan"]');
        if (asalField && tujuanField && asalField.value && tujuanField.value && asalField.value === tujuanField.value) {
            tujuanField.classList.add('border-red-500');
            const errorDiv = tujuanField.parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.classList.remove('hidden');
                errorDiv.textContent = 'Rute tujuan harus berbeda dengan rute asal';
            }
            isValid = false;
        }

        // Validate time (departure should be before arrival)
        const departureField = form.querySelector('[name="waktu_berangkat"]');
        const arrivalField = form.querySelector('[name="waktu_tiba"]');
        if (departureField && arrivalField && departureField.value && arrivalField.value) {
            if (departureField.value >= arrivalField.value) {
                arrivalField.classList.add('border-red-500');
                const errorDiv = arrivalField.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Waktu tiba harus setelah waktu berangkat';
                }
                isValid = false;
            }
        }

        // Validate price
        const priceField = form.querySelector('[name="harga"]');
        if (priceField && priceField.value) {
            const price = parseInt(priceField.value);
            if (price < 1000) {
                priceField.classList.add('border-red-500');
                const errorDiv = priceField.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Harga minimal Rp 1.000';
                }
                isValid = false;
            }
        }

        return isValid;
    }

    // Make functions global for onclick handlers
    window.editSchedule = editSchedule;
    window.deleteSchedule = deleteSchedule;
    window.changePage = changePage;
    window.clearSearch = clearSearch;
</script>
@endsection
