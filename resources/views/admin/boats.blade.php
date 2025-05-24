@extends('layouts.admin')

@section('title', 'Boat')

@section('header', 'Manajemen Boat')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Main Boat List - Takes 2/3 of the screen -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div
                    class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-lg font-medium text-gray-800">Daftar Kapal</h3>
                    <button id="openModalBtn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Tambah Kapal
                    </button>
                </div>
                <div class="p-6">
                    <!-- Search and Filter Section -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div class="flex flex-wrap gap-2" id="statusFilter">
                            <button data-status="semua"
                                class="px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-md font-medium transition-colors">Semua</button>
                            <button data-status="aktif"
                                class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Aktif</button>
                            <button data-status="maintenance"
                                class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Maintenance</button>
                            <button data-status="tidak aktif"
                                class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Tidak
                                Aktif</button>
                        </div>
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <div class="relative flex-grow">
                                <input type="text" id="searchInput"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Cari kapal...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boat Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        KAPAL</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        KAPASITAS</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STATUS</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="boatList">
                                <!-- Data akan diisi via JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-700 order-2 sm:order-1" id="paginationInfo">
                            <!-- Info paginasi -->
                        </div>
                        <div class="flex space-x-1 order-1 sm:order-2" id="paginationButtons">
                            <!-- Tombol paginasi -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar content... -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-800">Statistik Kapal</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg transition-transform hover:scale-[1.02]">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-sm font-medium text-blue-800">Total Kapal</h4>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-blue-800" id="totalBoats">0</p>
                            <p class="text-sm text-blue-600">Kapal terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding a New Boat -->
    <div id="addBoatModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-xs">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800">Tambah Kapal Baru</h3>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="addBoatForm" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Boat Name -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="nama_kapal" class="block text-sm font-medium text-gray-700 mb-1">Nama Kapal</label>
                            <input type="text" id="nama_kapal" name="nama_kapal"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama kapal" required>
                        </div>

                        <!-- Boat ID -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="id" class="block text-sm font-medium text-gray-700 mb-1">ID Kapal</label>
                            <input type="text" id="id" name="id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Contoh: BT006" required>
                        </div>

                        <!-- Boat Type -->
                        {{-- <div class="col-span-2 md:col-span-1">
                            <label for="boatType" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kapal</label>
                            <select id="boatType" name="boatType"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="" disabled selected>Pilih tipe kapal</option>
                                <option value="fast">Fast Boat</option>
                                <option value="luxury">Luxury Boat</option>
                                <option value="regular">Regular Boat</option>
                            </select>
                        </div> --}}

                        <!-- Capacity -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                            <div class="flex">
                                <input type="number" id="kapasitas" name="kapasitas" min="1" max="100"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Jumlah penumpang" required>
                                <span
                                    class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md">
                                    penumpang
                                </span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Kapal</label>
                            <div class="flex space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="statusActive" name="status" value="aktif"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                    <label for="statusActive" class="ml-2 text-sm text-gray-700">Aktif</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="statusMaintenance" name="status" value="maintenance"
                                        class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                    <label for="statusMaintenance" class="ml-2 text-sm text-gray-700">Maintenance</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="statusInactive" name="status" value="tidak aktif"
                                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                    <label for="statusInactive" class="ml-2 text-sm text-gray-700">Tidak Aktif</label>
                                </div>
                            </div>
                        </div>

                        <!-- Boat Image -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Kapal</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="foto_kapal"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk
                                                upload</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Maks. 2MB)</p>
                                    </div>
                                    <input id="foto_kapal" name="foto_kapal" type="file" class="hidden"
                                        accept="image/*" />
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-2 hidden">
                                <div class="relative w-full h-32 bg-gray-100 rounded-lg overflow-hidden">
                                    <img id="previewImg" src="#" alt="Preview"
                                        class="w-full h-full object-cover">
                                    <button type="button" id="removeImage"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Deskripsi kapal (opsional)"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-2">
                <button id="cancelBtn"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Batal
                </button>
                <button id="saveBoatBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal Functionality -->
    <script>
        // Get modal elements
        const modal = document.getElementById('addBoatModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveBoatBtn = document.getElementById('saveBoatBtn');
        const boatImageInput = document.getElementById('boatImage');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImage');

        // Open modal
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });

        // Close modal functions
        const closeModal = () => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Re-enable scrolling
            document.getElementById('addBoatForm').reset(); // Reset form
            imagePreview.classList.add('hidden'); // Hide image preview
        };

        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Image preview functionality
        boatImageInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            }
        });

        // Remove image
        removeImageBtn.addEventListener('click', () => {
            boatImageInput.value = '';
            imagePreview.classList.add('hidden');
        });

        // Form submission (you would add your AJAX submission here)
        saveBoatBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const form = document.getElementById('addBoatForm');
            const formData = new FormData(form);

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            try {
                const response = await fetch('/api/kapal', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }

                alert('Kapal berhasil ditambahkan!');
                closeModal();
                loadData(); // Reload data setelah berhasil tambah
            } catch (error) {
                console.error('Error:', error);
                alert(`Gagal menambahkan kapal: ${error.message}`);
            }
        });

        let currentPage = 1;
        let currentStatus = 'semua';
        let currentSearch = '';

        // Fungsi memuat data
        async function loadData(page = 1, status = currentStatus, search = currentSearch) {
            try {
                const response = await fetch(`/api/kapal?page=${page}&status=${status}&search=${search}`);
                const data = await response.json();

                // Update tampilan
                renderBoats(data.data);
                renderPagination(data);
                updateStatistics(data.total);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Fungsi render data kapal
        function renderBoats(boats) {
            const container = document.getElementById('boatList');
            container.innerHTML = '';

            boats.forEach(boat => {
                const row = `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full object-cover shadow-sm" src="${boat.foto_kapal || 'https://via.placeholder.com/40'}" alt="${boat.nama_kapal}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${boat.nama_kapal}</div>
                            <div class="text-sm text-gray-500">${boat.id}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${boat.kapasitas} penumpang</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusColor(boat.status)}">
                        ${boat.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <div class="flex space-x-3">
                        <button class="text-blue-600 hover:text-blue-900 transition-colors edit-btn" data-id="${boat.id}">Edit</button>
                        <button class="text-red-600 hover:text-red-900 transition-colors delete-btn" data-id="${boat.id}">Hapus</button>
                    </div>
                </td>
            </tr>
        `;
                container.insertAdjacentHTML('beforeend', row);
            });
        }

        // Fungsi warna status
        function getStatusColor(status) {
            switch (status) {
                case 'aktif':
                    return 'bg-green-100 text-green-800';
                case 'maintenance':
                    return 'bg-yellow-100 text-yellow-800';
                case 'tidak aktif':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        // Fungsi pagination
        function renderPagination(data) {
            const paginationInfo = document.getElementById('paginationInfo');
            const paginationButtons = document.getElementById('paginationButtons');

            // Info halaman
            paginationInfo.innerHTML = `
        Menampilkan <span class="font-medium">${data.from}</span> sampai 
        <span class="font-medium">${data.to}</span> dari 
        <span class="font-medium">${data.total}</span> kapal
    `;

            // Tombol pagination
            let buttons = '';
            if (data.prev_page_url) {
                buttons +=
                    `<button onclick="loadData(${data.current_page - 1})" class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Sebelumnya</button>`;
            }
            buttons +=
                `<button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm bg-blue-50 text-blue-600 font-medium">${data.current_page}</button>`;
            if (data.next_page_url) {
                buttons +=
                    `<button onclick="loadData(${data.current_page + 1})" class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya</button>`;
            }

            paginationButtons.innerHTML = buttons;
        }

        // Fungsi update statistik
        function updateStatistics(total) {
            document.getElementById('totalBoats').textContent = total;
        }

        // Event Listeners
        document.getElementById('statusFilter').addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                currentStatus = e.target.dataset.status;
                document.querySelectorAll('#statusFilter button').forEach(btn => {
                    btn.classList.remove('bg-blue-50', 'text-blue-600');
                });
                e.target.classList.add('bg-blue-50', 'text-blue-600');
                loadData(1);
            }
        });

        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', (e) => {
            currentSearch = e.target.value;
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => loadData(1), 500);
        });

        // Inisialisasi pertama
        loadData();
    </script>
@endsection
