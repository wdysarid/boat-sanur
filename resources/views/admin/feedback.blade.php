@extends('layouts.admin')

@section('title', 'Feedback')

@section('header', 'Feedback Wisatawan')

@section('content')
    <div id="feedback-container">
        <!-- Statistik Feedback -->
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
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-lg font-medium text-gray-800">Daftar Feedback</h3>
                <div class="w-full sm:w-auto">
                    <div class="relative">
                        <input type="text" id="search-feedback"
                            class="w-full sm:w-64 pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
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
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
                    <div class="flex flex-wrap gap-2" id="status-filters">
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

                <!-- Pagination -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4" id="pagination-container">
                    <!-- Pagination akan diisi di sini -->
                </div>
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="approvalModalTitle">
                        Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="approvalConfirmText">
                            Apakah Anda yakin ingin menyetujui review ini?
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex flex-row-reverse gap-2">
                <button id="confirmApprovalBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">Setujui</button>
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="rejectionModalTitle">
                        Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="rejectionConfirmText">
                            Apakah Anda yakin ingin menolak review ini?
                        </p>
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
        let currentFeedbackId = null;
        let currentFeedbackAction = null;

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

            document.getElementById('confirmApprovalBtn').addEventListener('click', function() {
                if (currentFeedbackId) {
                    processFeedbackStatus(currentFeedbackId, 'approve');
                }
                closeApprovalModal();
            });

            document.getElementById('cancelApprovalBtn').addEventListener('click', closeApprovalModal);

            document.getElementById('confirmRejectionBtn').addEventListener('click', function() {
                if (currentFeedbackId) {
                    processFeedbackStatus(currentFeedbackId, 'reject');
                }
                closeRejectionModal();
            });

            document.getElementById('cancelRejectionBtn').addEventListener('click', closeRejectionModal);
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

            if (feedbacks.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data feedback yang ditemukan
                        </td>
                    </tr>
                `;
                return;
            }

            feedbacks.forEach(feedback => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap" data-title="Nama">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${feedback.user.nama}&background=0D8ABC&color=fff" alt="${feedback.user.nama}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${feedback.user.nama}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap" data-title="Email">
                        <div class="text-sm text-gray-900">${feedback.user.email}</div>
                    </td>
                    <td class="px-6 py-4" data-title="Review">
                        <div class="text-sm text-gray-900 max-w-xs">
                            <p class="line-clamp-2">${feedback.pesan}</p>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">${new Date(feedback.created_at).toLocaleDateString()}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap" data-title="Rating">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400 mr-2">
                                ${renderStars(feedback.rating)}
                            </div>
                            <span class="text-sm font-medium text-gray-900">${feedback.rating.toFixed(1)}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap" data-title="Status">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(feedback.status)}">
                            ${getStatusText(feedback.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-title="Aksi">
                        ${renderActionButtons(feedback)}
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Add event listeners to action buttons
            document.querySelectorAll('.approve-feedback').forEach(button => {
                button.addEventListener('click', function() {
                    showApprovalModal(this.dataset.id);
                });
            });

            document.querySelectorAll('.reject-feedback').forEach(button => {
                button.addEventListener('click', function() {
                    showRejectionModal(this.dataset.id);
                });
            });
        }

        function updatePagination(data) {
            const paginationContainer = document.getElementById('pagination-container');

            if (!data.prev_page_url && !data.next_page_url) {
                paginationContainer.innerHTML = '';
                return;
            }

            // Text showing current range
            const showingText = `
                <div class="text-sm text-gray-700 hidden sm:block">
                    Menampilkan <span class="font-medium">${data.from}</span> sampai <span class="font-medium">${data.to}</span> dari <span class="font-medium">${data.total}</span> feedback
                </div>
            `;

            // Previous button
            const prevButton = data.prev_page_url ?
                `<button onclick="loadFeedbackData(${data.current_page - 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Previous</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Previous</button>`;

            // Next button
            const nextButton = data.next_page_url ?
                `<button onclick="loadFeedbackData(${data.current_page + 1})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Next</button>` :
                `<button disabled class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Next</button>`;

            // Page numbers - show limited numbers for mobile
            let pageNumbers = '';
            const maxVisiblePages = 5;
            let startPage, endPage;

            if (data.last_page <= maxVisiblePages) {
                startPage = 1;
                endPage = data.last_page;
            } else {
                const half = Math.floor(maxVisiblePages / 2);
                if (data.current_page <= half) {
                    startPage = 1;
                    endPage = maxVisiblePages;
                } else if (data.current_page + half >= data.last_page) {
                    startPage = data.last_page - maxVisiblePages + 1;
                    endPage = data.last_page;
                } else {
                    startPage = data.current_page - half;
                    endPage = data.current_page + half;
                }
            }

            for (let page = startPage; page <= endPage; page++) {
                pageNumbers += `
                    <button onclick="loadFeedbackData(${page})"
                        class="px-3 py-1 border border-gray-300 rounded-md text-sm ${page === data.current_page ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'}">
                        ${page}
                    </button>
                `;
            }

            // Ellipsis for first page if needed
            if (startPage > 1) {
                pageNumbers = `
                    <button onclick="loadFeedbackData(1)" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">1</button>
                    <span class="px-3 py-1">...</span>
                ` + pageNumbers;
            }

            // Ellipsis for last page if needed
            if (endPage < data.last_page) {
                pageNumbers += `
                    <span class="px-3 py-1">...</span>
                    <button onclick="loadFeedbackData(${data.last_page})" class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">${data.last_page}</button>
                `;
            }

            paginationContainer.innerHTML = `
                ${showingText}
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
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
                        <button data-id="${feedback.id}" class="reject-feedback text-red-600 hover:text-red-900 px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-200">
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
                        <button data-id="${feedback.id}" class="approve-feedback text-green-600 hover:text-green-900 px-3 py-1 bg-green-50 hover:bg-green-100 rounded-md transition-colors duration-200">
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
                        <button data-id="${feedback.id}" class="approve-feedback text-green-600 hover:text-green-900 px-3 py-1 bg-green-50 hover:bg-green-100 rounded-md transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Setujui
                        </button>
                        <button data-id="${feedback.id}" class="reject-feedback text-red-600 hover:text-red-900 px-3 py-1 bg-red-50 hover:bg-red-100 rounded-md transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Tolak
                        </button>
                    </div>
                `;
            }
        }

        function showApprovalModal(feedbackId) {
            currentFeedbackId = feedbackId;
            document.getElementById('approvalConfirmModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function showRejectionModal(feedbackId) {
            currentFeedbackId = feedbackId;
            document.getElementById('rejectionConfirmModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeApprovalModal() {
            document.getElementById('approvalConfirmModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentFeedbackId = null;
        }

        function closeRejectionModal() {
            document.getElementById('rejectionConfirmModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentFeedbackId = null;
        }

        function processFeedbackStatus(feedbackId, action) {
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

        @media (max-width: 640px) {
            #feedback-container .overflow-x-auto {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            #feedback-container table {
                display: block;
                width: 100%;
            }

            #feedback-container thead,
            #feedback-container tbody,
            #feedback-container th,
            #feedback-container td,
            #feedback-container tr {
                display: block;
            }

            #feedback-container thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #feedback-container tr {
                border: 1px solid #e5e7eb;
                margin-bottom: 1rem;
            }

            #feedback-container td {
                border: none;
                border-bottom: 1px solid #e5e7eb;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
            }

            #feedback-container td:before {
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
