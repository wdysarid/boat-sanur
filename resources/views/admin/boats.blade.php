@extends('layouts.admin')

@section('title', 'Boat Management')
@section('header', 'Manajemen Boat')

@section('content')



<!-- Statistics Section -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Statistik Kapal</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-sm font-medium text-blue-800">Total Kapal</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-blue-800" id="totalBoats">0</p>
                <p class="text-sm text-blue-600">Kapal terdaftar</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-sm font-medium text-green-800">Kapal Aktif</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-green-800" id="activeBoats">0</p>
                <p class="text-sm text-green-600">Siap beroperasi</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-sm font-medium text-yellow-800">Maintenance</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-yellow-800" id="maintenanceBoats">0</p>
                <p class="text-sm text-yellow-600">Dalam perbaikan</p>
            </div>
            <div class="bg-red-50 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-sm font-medium text-red-800">Tidak Aktif</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-red-800" id="inactiveBoats">0</p>
                <p class="text-sm text-red-600">Tidak beroperasi</p>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
<div id="alertContainer" class="mb-4 hidden">
    <div id="alertMessage" class="p-4 text-sm rounded-lg" role="alert">
        <span class="font-medium" id="alertText"></span>
    </div>
</div>

<div class="mb-6">
    <!-- Main Boat List -->
    <div>
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-lg font-medium text-gray-800">Daftar Kapal</h3>
                    <button id="openModalBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Tambah Kapal
                    </button>
                </div>
            </div>

            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex flex-wrap gap-2" id="statusFilter">
                        <button data-status="semua" class="filter-btn px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-md font-medium transition-colors">Semua</button>
                        <button data-status="aktif" class="filter-btn px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Aktif</button>
                        <button data-status="maintenance" class="filter-btn px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Maintenance</button>
                        <button data-status="tidak aktif" class="filter-btn px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Tidak Aktif</button>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative flex-grow">
                            <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Cari kapal...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boat Table -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table id="boatsTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">FOTO</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA KAPAL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KAPASITAS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="boatsTableBody" class="bg-white divide-y divide-gray-200">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kapal</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kapal baru.</p>
                    </div>

                    <!-- Pagination -->
                    <div id="pagination" class="flex items-center justify-between px-6 py-4 border-t border-gray-200">
                        <div class="text-sm text-gray-700" id="pagination-info">
                            Menampilkan <span id="pagination-start">0</span> - <span id="pagination-end">0</span> dari <span id="pagination-total">0</span> kapal
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


<!-- Add Boat Modal -->
<div id="addBoatModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Tambah Kapal Baru</h3>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-6 py-4">
            <form id="addBoatForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label for="add_nama_kapal" class="block text-sm font-medium text-gray-700 mb-1">Nama Kapal</label>
                        <input type="text" id="add_nama_kapal" name="nama_kapal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama kapal" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="add_id" class="block text-sm font-medium text-gray-700 mb-1">ID Kapal</label>
                        <input type="text" id="add_id" name="id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: BT006" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="add_kapasitas" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                        <div class="flex">
                            <input type="number" id="add_kapasitas" name="kapasitas" min="1" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Jumlah penumpang" required>
                            <span class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md">penumpang</span>
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Kapal</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" id="add_statusActive" name="status" value="aktif" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                <label for="add_statusActive" class="ml-2 text-sm text-gray-700">Aktif</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="add_statusMaintenance" name="status" value="maintenance" class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                <label for="add_statusMaintenance" class="ml-2 text-sm text-gray-700">Maintenance</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="add_statusInactive" name="status" value="tidak aktif" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <label for="add_statusInactive" class="ml-2 text-sm text-gray-700">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="add_foto_kapal" class="block text-sm font-medium text-gray-700 mb-1">Foto Kapal</label>
                        <input type="file" name="foto_kapal" id="add_foto_kapal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" accept=".png,.jpg,.jpeg,image/png,image/jpeg,image/jpg">
                        <div id="add_preview_container" class="mt-2 hidden">
                            <img id="add_image_preview" src="/placeholder.svg" alt="Preview" class="w-20 h-20 object-cover rounded">
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label for="add_deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="add_deskripsi" name="deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Deskripsi kapal (opsional)"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-2">
            <button id="cancelBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            <button id="saveBoatBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Simpan</button>
        </div>
    </div>
</div>

<!-- Edit Boat Modal -->
<div id="editBoatModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Edit Kapal</h3>
            <button id="closeEditModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-6 py-4">
            <form id="editBoatForm">
                <input type="hidden" id="edit_boat_id" name="boat_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label for="edit_nama_kapal" class="block text-sm font-medium text-gray-700 mb-1">Nama Kapal</label>
                        <input type="text" id="edit_nama_kapal" name="nama_kapal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="edit_id" class="block text-sm font-medium text-gray-700 mb-1">ID Kapal</label>
                        <input type="text" id="edit_id" name="id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="edit_kapasitas" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                        <div class="flex">
                            <input type="number" id="edit_kapasitas" name="kapasitas" min="1" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            <span class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md">penumpang</span>
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Kapal</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" id="edit_statusActive" name="status" value="aktif" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="edit_statusActive" class="ml-2 text-sm text-gray-700">Aktif</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="edit_statusMaintenance" name="status" value="maintenance" class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                <label for="edit_statusMaintenance" class="ml-2 text-sm text-gray-700">Maintenance</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="edit_statusInactive" name="status" value="tidak aktif" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                <label for="edit_statusInactive" class="ml-2 text-sm text-gray-700">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="edit_foto_kapal" class="block text-sm font-medium text-gray-700 mb-1">Foto Kapal</label>
                        <input type="file" name="foto_kapal" id="edit_foto_kapal" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" accept=".png,.jpg,.jpeg,image/png,image/jpeg,image/jpg">
                        <div id="edit_current_image_preview" class="mt-2 hidden">
                            <img id="edit_current_image" src="/placeholder.svg" alt="Current Image" class="w-20 h-20 object-cover rounded">
                        </div>
                        <div class="error-message text-red-500 text-xs mt-1 hidden"></div>
                    </div>

                    <div class="col-span-2">
                        <label for="edit_deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Deskripsi kapal (opsional)"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-2">
            <button id="cancelEditBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Batal</button>
            <button id="updateBoatBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Update</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
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
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Hapus Kapal
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500" id="deleteConfirmText">
                        Apakah Anda yakin ingin menghapus kapal ini?
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

<script>
    // Configuration
    const API_BASE_URL = '{{ env("APP_API_URL", "http://boat-sanur.test/api") }}';
    // const IMAGES_BASE_URL = '{{ env("APP_IMAGES_URL", "http://boat-sanur.test/images") }}';
    const IMAGES_BASE_URL = '{{ url("") }}';
    const ITEMS_PER_PAGE = 10; // Number of items per page

    // Global variables
    let boats = [];
    let filteredBoats = [];
    let currentDeleteId = null;
    let currentPage = 1;
    let totalPages = 1;

    // DOM Elements
    const elements = {
        // Modals
        addModal: document.getElementById('addBoatModal'),
        editModal: document.getElementById('editBoatModal'),
        deleteModal: document.getElementById('deleteConfirmModal'),

        // Buttons
        openModalBtn: document.getElementById('openModalBtn'),
        closeModalBtn: document.getElementById('closeModalBtn'),
        closeEditModalBtn: document.getElementById('closeEditModalBtn'),
        cancelBtn: document.getElementById('cancelBtn'),
        cancelEditBtn: document.getElementById('cancelEditBtn'),
        saveBoatBtn: document.getElementById('saveBoatBtn'),
        updateBoatBtn: document.getElementById('updateBoatBtn'),
        confirmDeleteBtn: document.getElementById('confirmDeleteBtn'),
        cancelDeleteBtn: document.getElementById('cancelDeleteBtn'),

        // Forms
        addBoatForm: document.getElementById('addBoatForm'),
        editBoatForm: document.getElementById('editBoatForm'),

        // Table
        boatsTableBody: document.getElementById('boatsTableBody'),
        loadingState: document.getElementById('loadingState'),
        emptyState: document.getElementById('emptyState'),

        // Search and Filter
        searchInput: document.getElementById('searchInput'),
        filterButtons: document.querySelectorAll('.filter-btn'),

        // Statistics
        totalBoats: document.getElementById('totalBoats'),
        activeBoats: document.getElementById('activeBoats'),
        maintenanceBoats: document.getElementById('maintenanceBoats'),
        inactiveBoats: document.getElementById('inactiveBoats'),

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
        paginationControls: document.getElementById('pagination-controls')
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        loadBoats();
        setupFilePreview();
    });

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
        elements.saveBoatBtn.addEventListener('click', handleAddBoat);
        elements.updateBoatBtn.addEventListener('click', handleUpdateBoat);
        elements.confirmDeleteBtn.addEventListener('click', handleConfirmDelete);

        // Search and filter
        elements.searchInput.addEventListener('input', handleSearch);
        elements.filterButtons.forEach(btn => {
            btn.addEventListener('click', handleFilter);
        });

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

    // File preview setup with validation
    function setupFilePreview() {
        const addFileInput = document.getElementById('add_foto_kapal');
        const editFileInput = document.getElementById('edit_foto_kapal');

        addFileInput.addEventListener('change', function() {
            if (validateFile(this)) {
                previewFile(this, 'add_image_preview', 'add_preview_container');
            }
        });

        editFileInput.addEventListener('change', function() {
            if (validateFile(this)) {
                previewFile(this, 'edit_current_image', 'edit_current_image_preview');
            }
        });
    }

    function validateFile(input) {
        const file = input.files[0];
        if (!file) return true;

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedTypes.includes(file.type) || !allowedExtensions.includes(fileExtension)) {
            showAlert('Format file harus PNG, JPG, atau JPEG', 'error');
            input.value = '';
            return false;
        }

        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            showAlert('Ukuran file maksimal 2MB', 'error');
            input.value = '';
            return false;
        }

        return true;
    }

    function previewFile(input, previewId, containerId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Modal functions
    function openAddModal() {
        elements.addModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        clearForm(elements.addBoatForm);
    }

    function closeAddModal() {
        elements.addModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        clearForm(elements.addBoatForm);
    }

    function closeEditModal() {
        elements.editModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        clearForm(elements.editBoatForm);
    }

    function closeDeleteModal() {
        elements.deleteModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentDeleteId = null;
    }

    function clearForm(form) {
        form.reset();
        clearErrors(form);
        // Hide preview images
        form.querySelectorAll('[id$="_preview_container"], [id$="_current_image_preview"]').forEach(el => {
            el.classList.add('hidden');
        });
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
    async function loadBoats() {
        try {
            showLoading(true);
            const response = await fetch(`${API_BASE_URL}/kapal`);
            const result = await response.json();

            if (result.success) {
                boats = result.data;
                filteredBoats = [...boats];
                currentPage = 1; // Reset to first page when loading new data
                renderTable();
                updateStatistics();
                updatePagination();
            } else {
                showAlert('Gagal memuat data kapal', 'error');
            }
        } catch (error) {
            console.error('Error loading boats:', error);
            showAlert('Gagal memuat data kapal', 'error');
        } finally {
            showLoading(false);
        }
    }

    async function handleAddBoat(e) {
        e.preventDefault();

        // Validasi form sebelum submit
        if (!validateFormInputs(elements.addBoatForm)) {
            return;
        }

        // Buat FormData object
        const formData = new FormData(elements.addBoatForm);

        try {
            // Tampilkan loading state
            setLoadingButton(elements.saveBoatBtn, true, 'Menyimpan...');
            clearErrors(elements.addBoatForm);

            // Kirim request ke API
            const response = await fetch(`${API_BASE_URL}/kapal`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (!response.ok) {
                // Jika response error (status bukan 2xx)
                if (result.errors) {
                    // Tampilkan error validasi
                    showFormErrors(elements.addBoatForm, result.errors);
                    showAlert('Mohon periksa kembali input Anda', 'error');
                } else {
                    // Tampilkan error umum
                    showAlert(result.message || 'Gagal menambahkan kapal', 'error');
                }
                return;
            }

            // Jika sukses
            showAlert('Kapal berhasil ditambahkan', 'success');
            closeAddModal();
            loadBoats(); // Refresh data kapal

        } catch (error) {
            console.error('Error adding boat:', error);
            showAlert('Terjadi kesalahan sistem. Silakan coba lagi.', 'error');
        } finally {
            // Reset loading state
            setLoadingButton(elements.saveBoatBtn, false, 'Simpan');
        }
    }

    async function handleUpdateBoat(e) {
        e.preventDefault();

        // Validate form before submission
        if (!validateFormInputs(elements.editBoatForm)) {
            return;
        }

        const formData = new FormData(elements.editBoatForm);
        const boatId = document.getElementById('edit_boat_id').value;

        // Add _method for Laravel to recognize as PUT request
        formData.append('_method', 'PUT');

        try {
            setLoadingButton(elements.updateBoatBtn, true, 'Memperbaharui...');
            clearErrors(elements.editBoatForm);

            const response = await fetch(`${API_BASE_URL}/kapal/${boatId}`, {
                method: 'POST', // Using POST with _method=PUT for file uploads
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (!response.ok) {
                // If response error (status bukan 2xx)
                if (result.errors) {
                    // Tampilkan error validasi
                    showFormErrors(elements.editBoatForm, result.errors);
                    showAlert('Mohon periksa kembali input Anda', 'error');
                } else {
                    // Tampilkan error umum
                    showAlert(result.message || 'Gagal mengupdate kapal', 'error');
                }
                return;
            }

            // Jika sukses
            showAlert('Kapal berhasil diupdate', 'success');
            closeEditModal();
            loadBoats(); // Refresh data kapal

        } catch (error) {
            console.error('Error updating boat:', error);
            showAlert('Terjadi kesalahan sistem. Silakan coba lagi.', 'error');
        } finally {
            // Reset loading state
            setLoadingButton(elements.updateBoatBtn, false, 'Update');
        }
    }

    async function editBoat(id) {
        try {
            const response = await fetch(`${API_BASE_URL}/kapal/${id}`);
            const result = await response.json();

            if (result.success) {
                const boat = result.data;

                // Fill form fields
                document.getElementById('edit_boat_id').value = boat.id;
                document.getElementById('edit_id').value = boat.id;
                document.getElementById('edit_nama_kapal').value = boat.nama_kapal;
                document.getElementById('edit_kapasitas').value = boat.kapasitas;
                document.getElementById('edit_deskripsi').value = boat.deskripsi || '';

                // Set status radio button based on boat status
                const statusRadios = {
                    'aktif': document.getElementById('edit_statusActive'),
                    'maintenance': document.getElementById('edit_statusMaintenance'),
                    'tidak aktif': document.getElementById('edit_statusInactive')
                };

                // Uncheck all radios first
                Object.values(statusRadios).forEach(radio => {
                    radio.checked = false;
                });

                // Check the appropriate radio based on boat status
                if (boat.status && statusRadios[boat.status]) {
                    statusRadios[boat.status].checked = true;
                } else {
                    // Default to 'aktif' if status is not set or invalid
                    statusRadios['aktif'].checked = true;
                }

                // Show current image if exists
                const currentImagePreview = document.getElementById('edit_current_image_preview');
                const currentImage = document.getElementById('edit_current_image');
                if (boat.foto_kapal) {
                    currentImage.src = `${IMAGES_BASE_URL}/storage/${boat.foto_kapal}`;
                    currentImagePreview.classList.remove('hidden');
                } else {
                    currentImagePreview.classList.add('hidden');
                }

                // Clear file input
                document.getElementById('edit_foto_kapal').value = '';

                elements.editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                showAlert(result.message || 'Gagal mengambil data kapal', 'error');
            }
        } catch (error) {
            console.error('Error fetching boat:', error);
            showAlert('Gagal mengambil data kapal', 'error');
        }
    }

    function deleteBoat(id, name) {
        currentDeleteId = id;
        document.getElementById('deleteConfirmText').textContent =
            `Apakah Anda yakin ingin menghapus kapal "${name}"?`;
        elements.deleteModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    async function handleConfirmDelete() {
        if (!currentDeleteId) return;

        try {
            setLoadingButton(elements.confirmDeleteBtn, true, 'Menghapus...');

            const response = await fetch(`${API_BASE_URL}/kapal/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                showAlert('Kapal berhasil dihapus', 'success');
                closeDeleteModal();
                loadBoats();
            } else {
                showAlert(result.message || 'Gagal menghapus kapal', 'error');
            }
        } catch (error) {
            console.error('Error deleting boat:', error);
            showAlert('Terjadi kesalahan sistem', 'error');
        } finally {
            setLoadingButton(elements.confirmDeleteBtn, false, 'Hapus');
        }
    }

    // Table rendering
    function renderTable() {
        const tbody = elements.boatsTableBody;

        if (filteredBoats.length === 0) {
            tbody.innerHTML = '';
            elements.emptyState.classList.remove('hidden');
            elements.pagination.classList.add('hidden');
            return;
        }

        elements.emptyState.classList.add('hidden');
        elements.pagination.classList.remove('hidden');

        // Calculate pagination
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = Math.min(startIndex + ITEMS_PER_PAGE, filteredBoats.length);
        const paginatedBoats = filteredBoats.slice(startIndex, endIndex);

        tbody.innerHTML = paginatedBoats.map(boat => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${boat.id}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${boat.foto_kapal ?
                        `<img src="${IMAGES_BASE_URL}/storage/${boat.foto_kapal}" alt="Foto Kapal" class="h-12 w-12 rounded-lg object-cover">` :
                        `<div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>`
                    }
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${boat.nama_kapal}</div>
                    ${boat.deskripsi ? `<div class="text-sm text-gray-500">${boat.deskripsi.substring(0, 50)}${boat.deskripsi.length > 50 ? '...' : ''}</div>` : ''}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${boat.kapasitas} penumpang</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(boat.status)}">
                        ${getStatusText(boat.status)}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        <button onclick="editBoat('${boat.id}')" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-md transition-colors" title="Edit Kapal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button onclick="deleteBoat('${boat.id}', '${boat.nama_kapal}')" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-md transition-colors" title="Hapus Kapal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        // Update pagination info
        updatePaginationInfo(startIndex, endIndex);
    }

    // Pagination functions
    function updatePagination() {
        totalPages = Math.ceil(filteredBoats.length / ITEMS_PER_PAGE);

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
            // Show all pages if total pages is less than or equal to max visible pages
            for (let i = 1; i <= totalPages; i++) {
                pages.push(i);
            }
        } else {
            // Always show first page
            pages.push(1);

            // Calculate start and end of visible pages
            let startPage = Math.max(2, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages - 1, startPage + maxVisiblePages - 3);

            // Adjust if we're near the beginning
            if (startPage === 2) {
                endPage = Math.min(totalPages - 1, maxVisiblePages - 1);
            }

            // Adjust if we're near the end
            if (endPage === totalPages - 1) {
                startPage = Math.max(2, totalPages - maxVisiblePages + 2);
            }

            // Add ellipsis after first page if needed
            if (startPage > 2) {
                pages.push('...');
            }

            // Add visible pages
            for (let i = startPage; i <= endPage; i++) {
                pages.push(i);
            }

            // Add ellipsis before last page if needed
            if (endPage < totalPages - 1) {
                pages.push('...');
            }

            // Always show last page
            pages.push(totalPages);
        }

        return pages;
    }

    function updatePaginationInfo(startIndex, endIndex) {
        elements.paginationStart.textContent = startIndex + 1;
        elements.paginationEnd.textContent = endIndex;
        elements.paginationTotal.textContent = filteredBoats.length;
    }

    function changePage(page) {
        currentPage = page;
        renderTable();
        renderPaginationControls();

        // Scroll to top of table
        document.getElementById('boatsTable').scrollIntoView({ behavior: 'smooth' });
    }

    // Search and filter
    function handleSearch() {
        const searchTerm = elements.searchInput.value.toLowerCase();
        const activeFilter = getActiveFilter();
        filterTable(searchTerm, activeFilter);
    }

    function handleFilter(e) {
        // Update active filter button
        elements.filterButtons.forEach(btn => {
            btn.classList.remove('bg-blue-50', 'text-blue-600');
            btn.classList.add('text-gray-600');
        });
        e.target.classList.add('bg-blue-50', 'text-blue-600');
        e.target.classList.remove('text-gray-600');

        const status = e.target.getAttribute('data-status');
        const searchTerm = elements.searchInput.value.toLowerCase();
        filterTable(searchTerm, status);
    }

    function getActiveFilter() {
        const activeButton = document.querySelector('.filter-btn.bg-blue-50');
        return activeButton ? activeButton.getAttribute('data-status') : 'semua';
    }

    function filterTable(searchTerm, status) {
        filteredBoats = boats.filter(boat => {
            const matchesSearch = boat.nama_kapal.toLowerCase().includes(searchTerm) ||
                                boat.id.toLowerCase().includes(searchTerm);
            const matchesFilter = status === 'semua' || boat.status === status;
            return matchesSearch && matchesFilter;
        });

        // Reset to first page when filtering
        currentPage = 1;
        updatePagination();
    }

    // Statistics
    function updateStatistics() {
        const total = boats.length;
        const active = boats.filter(b => b.status === 'aktif').length;
        const maintenance = boats.filter(b => b.status === 'maintenance').length;
        const inactive = boats.filter(b => b.status === 'tidak aktif').length;

        elements.totalBoats.textContent = total;
        elements.activeBoats.textContent = active;
        elements.maintenanceBoats.textContent = maintenance;
        elements.inactiveBoats.textContent = inactive;
    }

    // Utility functions
    function showLoading(show) {
        if (show) {
            elements.loadingState.classList.remove('hidden');
            elements.boatsTableBody.innerHTML = '';
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
            case 'maintenance': return 'bg-yellow-100 text-yellow-800';
            case 'tidak aktif': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }

    function getStatusText(status) {
        switch(status) {
            case 'aktif': return 'Aktif';
            case 'maintenance': return 'Maintenance';
            case 'tidak aktif': return 'Tidak Aktif';
            default: return status;
        }
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

        // Validasi ID format (contoh: BT001)
        const idField = form.querySelector('[name="id"]');
        if (idField && idField.value) {
            const idPattern = /^[A-Z]{2}\d{3}$/;
            if (!idPattern.test(idField.value)) {
                idField.classList.add('border-red-500');
                const errorDiv = idField.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Format ID harus seperti: BT001 (2 huruf besar + 3 angka)';
                }
                isValid = false;
            }
        }

        // Validasi kapasitas (1-100)
        const capacityField = form.querySelector('[name="kapasitas"]');
        if (capacityField && capacityField.value) {
            const capacity = parseInt(capacityField.value);
            if (capacity < 1 || capacity > 100) {
                capacityField.classList.add('border-red-500');
                const errorDiv = capacityField.parentNode.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Kapasitas maksimal penumpang adalah 100 orang';
                }
                isValid = false;
            }
        }

        // Validasi file upload (jika ada)
        const fileInput = form.querySelector('[name="foto_kapal"]');
        if (fileInput && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                showAlert('Format file harus JPG, JPEG, atau PNG', 'error');
                isValid = false;
            }

            if (file.size > maxSize) {
                showAlert('Ukuran file maksimal 2MB', 'error');
                isValid = false;
            }
        }

        return isValid;
    }

    // Make functions global for onclick handlers
    window.editBoat = editBoat;
    window.deleteBoat = deleteBoat;
    window.changePage = changePage;
</script>
@endsection
