@extends('layouts.admin')

@section('title', 'Feedback')

@section('header', 'Feedback Pelanggan')

@section('content')
    <div id="feedback-container">
        <!-- Statistik akan diisi oleh JavaScript -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Statistik Feedback</h3>
            </div>
            <div class="p-6" id="feedback-stats">
                <!-- Data statistik akan diisi di sini -->
            </div>
        </div>

        <!-- Tabel Feedback -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800">Daftar Feedback</h3>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input type="text" id="search-feedback"
                            class="pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Cari feedback...">
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
                            class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-md">Semua</button>
                        <button data-status="pending"
                            class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Pending</button>
                        <button data-status="disetujui"
                            class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Disetujui</button>
                        <button data-status="ditolak"
                            class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Ditolak</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Review
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rating
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="feedback-table-body">
                            <!-- Data feedback akan diisi di sini -->
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex items-center justify-between" id="pagination-container">
                    <!-- Pagination akan diisi di sini -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load initial data
            loadFeedbackData();

            // Setup event listeners
            document.getElementById('search-feedback').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    loadFeedbackData();
                }
            });

            document.querySelectorAll('#status-filters button').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelector('#status-filters button.bg-blue-50').classList.remove(
                        'bg-blue-50', 'text-blue-600');
                    this.classList.add('bg-blue-50', 'text-blue-600');
                    loadFeedbackData();
                });
            });
        });

        function loadFeedbackData(page = 1) {
            const status = document.querySelector('#status-filters button.bg-blue-50').dataset.status;
            const search = document.getElementById('search-feedback').value;

            fetch(`/api/feedback/semua?status=${status}&search=${search}&page=${page}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer {{ session('token') }}',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
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
                        // Ensure stats exists and has required properties
                        const safeStats = data.stats || {
                            average_rating: 0,
                            total: 0,
                            pending: 0,
                            approved: 0,
                            rejected: 0,
                            rating_distribution: {
                                1: 0,
                                2: 0,
                                3: 0,
                                4: 0,
                                5: 0
                            }
                        };

                        updateFeedbackStats(safeStats);
                        updateFeedbackTable(data.data || []);
                        updatePagination(data);
                    } else {
                        console.error('Error:', data.message);
                        alert('Gagal memuat data: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data feedback: ' + (error.message || error));
                })
                .finally(() => {
                    document.getElementById('feedback-container').classList.remove('opacity-50', 'pointer-events-none');
                });
        }

        function updateFeedbackStats(stats) {
            const statsContainer = document.getElementById('feedback-stats');

            const averageRating = typeof stats.average_rating === 'number' ? stats.average_rating : 0;
            const formattedRating = averageRating.toFixed(1);

            // Update stats HTML here based on the stats data
            // Contoh:
            statsContainer.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Rating Rata-rata -->
            <div class="text-center">
                <div class="flex items-center justify-center mb-2">
                    <div class="text-3xl font-bold text-gray-800 mr-2">${stats.average_rating.toFixed(1)}</div>
                    <div class="flex">
                        ${renderStars(stats.average_rating)}
                    </div>
                </div>
                <div class="text-sm font-medium text-gray-700">Rating Rata-rata</div>
                <div class="text-xs text-gray-500">Dari ${stats.total} feedback</div>
            </div>

            <!-- Status Summary -->
            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                <div class="text-3xl font-bold text-yellow-600">${stats.pending}</div>
                <div class="text-sm font-medium text-yellow-600">Pending Review</div>
                <div class="text-xs text-gray-500">Menunggu persetujuan</div>
            </div>

            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-3xl font-bold text-green-600">${stats.approved}</div>
                <div class="text-sm font-medium text-green-600">Review Disetujui</div>
                <div class="text-xs text-gray-500">Tampil di website</div>
            </div>

            <div class="text-center p-4 bg-red-50 rounded-lg">
                <div class="text-3xl font-bold text-red-600">${stats.rejected}</div>
                <div class="text-sm font-medium text-red-600">Review Ditolak</div>
                <div class="text-xs text-gray-500">Tidak tampil</div>
            </div>
        </div>

        <!-- Rating Distribution -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-4">Distribusi Rating</h4>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                ${Object.entries(stats.rating_distribution).map(([rating, percentage]) => `
                        <div class="flex items-center">
                            <div class="text-sm text-gray-700 w-8">${rating}★</div>
                            <div class="flex-1 h-3 bg-gray-200 rounded-full mx-2">
                                <div class="bg-yellow-400 h-3 rounded-full" style="width: ${percentage}%"></div>
                            </div>
                            <div class="text-sm text-gray-700 w-12">${percentage}%</div>
                        </div>
                    `).join('')}
            </div>
        </div>
    `;
        }

        function updateFeedbackTable(feedbacks) {
            const tbody = document.getElementById('feedback-table-body');
            tbody.innerHTML = '';

            feedbacks.forEach(feedback => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${feedback.user.nama}&background=0D8ABC&color=fff" alt="${feedback.user.nama}">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${feedback.user.nama}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">${feedback.user.email}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900 max-w-xs">
                    <p class="line-clamp-2">${feedback.pesan}</p>
                </div>
                <div class="text-xs text-gray-500 mt-1">${new Date(feedback.created_at).toLocaleDateString()}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex text-yellow-400 mr-2">
                        ${renderStars(feedback.rating)}
                    </div>
                    <span class="text-sm font-medium text-gray-900">${feedback.rating.toFixed(1)}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(feedback.status)}">
                    ${getStatusText(feedback.status)}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                ${renderActionButtons(feedback)}
            </td>
        `;
                tbody.appendChild(row);
            });

            // Add event listeners to action buttons
            document.querySelectorAll('.approve-feedback').forEach(button => {
                button.addEventListener('click', function() {
                    updateFeedbackStatus(this.dataset.id, 'approve');
                });
            });

            document.querySelectorAll('.reject-feedback').forEach(button => {
                button.addEventListener('click', function() {
                    updateFeedbackStatus(this.dataset.id, 'reject');
                });
            });
        }

        function renderStars(rating) {
            const numericRating = typeof rating === 'number' ? rating : 0;
            let stars = '';
            const fullStars = Math.floor(numericRating);
            const hasHalfStar = numericRating % 1 >= 0.5;

            for (let i = 1; i <= 5; i++) {
                if (i <= fullStars) {
                    stars += `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>`;
                } else if (i === fullStars + 1 && hasHalfStar) {
                    stars += `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>`;
                } else {
                    stars += `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>`;
                }
            }
            return stars;
        }

        function getStatusClass(status) {
            switch (status) {
                case 'pending':
                    return 'bg-yellow-100 text-yellow-800';
                case 'disetujui':
                    return 'bg-green-100 text-green-800';
                case 'ditolak':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'pending':
                    return 'Pending';
                case 'disetujui':
                    return 'Disetujui';
                case 'ditolak':
                    return 'Ditolak';
                default:
                    return status;
            }
        }

        function renderActionButtons(feedback) {
            if (feedback.status === 'disetujui') {
                return `
            <div class="flex space-x-2">
                <button class="text-gray-400 cursor-not-allowed px-3 py-1 bg-gray-50 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Disetujui
                </button>
                <button class="reject-feedback text-red-600 hover:text-red-900 px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-200" data-id="${feedback.id}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Tolak
                </button>
            </div>
        `;
            } else if (feedback.status === 'ditolak') {
                return `
            <div class="flex space-x-2">
                <button class="approve-feedback text-green-600 hover:text-green-900 px-3 py-1 bg-green-50 hover:bg-green-100 rounded-md transition-colors duration-200" data-id="${feedback.id}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Setujui
                </button>
                <button class="text-gray-400 cursor-not-allowed px-3 py-1 bg-gray-50 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Ditolak
                </button>
            </div>
        `;
            } else {
                return `
            <div class="flex space-x-2">
                <button class="approve-feedback text-green-600 hover:text-green-900 px-3 py-1 bg-green-50 hover:bg-green-100 rounded-md transition-colors duration-200" data-id="${feedback.id}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Setujui
                </button>
                <button class="reject-feedback text-red-600 hover:text-red-900 px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-200" data-id="${feedback.id}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Tolak
                </button>
            </div>
        `;
            }
        }

        function updatePagination(data) {
            const paginationContainer = document.getElementById('pagination-container');

            if (!data.prev_page_url && !data.next_page_url) {
                paginationContainer.innerHTML = '';
                return;
            }

            paginationContainer.innerHTML = `
        <div class="text-sm text-gray-700">
            Menampilkan <span class="font-medium">${data.from}</span> sampai <span class="font-medium">${data.to}</span> dari <span class="font-medium">${data.total}</span> feedback
        </div>
        <div class="flex space-x-2">
            ${data.prev_page_url ?
                `<button onclick="loadFeedbackData(${data.current_page - 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Sebelumnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Sebelumnya</button>`
            }

            ${Array.from({ length: data.last_page }, (_, i) => i + 1).map(page => ` <
                button onclick = "loadFeedbackData(${page})"
            class =
            "px-3 py-1 border border-gray-300 rounded-md text-sm ${page === data.current_page ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'}" >
            $ {
                page
            } <
            /button>
            `).join('')}

            ${data.next_page_url ?
                `<button onclick="loadFeedbackData(${data.current_page + 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Selanjutnya</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Selanjutnya</button>`
            }
        </div>
    `;
        }

        function updateFeedbackStatus(feedbackId, action) {
            fetch(`/api/feedback/${feedbackId}/${action}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer {{ session('token') }}',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
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
                        loadFeedbackData(); // Refresh data
                    } else {
                        alert(data.message || 'Gagal memperbarui status feedback');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status feedback: ' + (error.message || error));
                });
        }
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
