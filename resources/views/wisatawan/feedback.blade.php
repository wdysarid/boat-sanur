@extends('layouts.wisatawan')

@section('title', 'Feedback Saya')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Feedback Saya</h1>
                        <p class="text-gray-600">Kelola feedback dan review yang telah Anda berikan untuk layanan kami</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header dengan kondisi tombol -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Feedback Anda</h3>
                        <p class="text-sm text-gray-600 mt-1">Setiap pengguna hanya dapat memberikan satu feedback</p>
                    </div>
                    <!-- Tombol Add hanya muncul jika belum ada feedback -->
                    <div id="add-feedback-button" class="hidden">
                        <a href="{{ route('home') }}#feedback" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Berikan Feedback
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6" id="feedback-container">
                <!-- Loading State -->
                <div id="loading-state" class="text-center py-12">
                    <div class="inline-flex items-center px-6 py-3 font-semibold leading-6 text-sm shadow-sm rounded-xl text-blue-600 bg-blue-50 border border-blue-100">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat feedback Anda...
                    </div>
                </div>

                <!-- Feedback Item -->
                <div id="feedback-item" class="hidden">
                    <!-- Feedback akan dimuat di sini -->
                </div>

                <!-- Empty State - Belum ada feedback -->
                <div id="empty-state" class="hidden text-center py-16">
                    <div class="max-w-md mx-auto">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum Ada Feedback</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Anda belum memberikan feedback untuk layanan kami. Bagikan pengalaman Anda untuk membantu kami memberikan pelayanan yang lebih baik.
                        </p>

                        <!-- CTA Button -->
                        <a href="{{ route('home') }}#feedback" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Berikan Feedback Pertama
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-2xl p-6">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-blue-900 mb-1">Informasi Feedback</h4>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Setiap pengguna hanya dapat memberikan satu feedback. Anda dapat mengedit atau menghapus feedback yang telah diberikan kapan saja. Feedback yang telah disetujui akan ditampilkan di halaman utama website.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0" id="editModalContent">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Edit Feedback</h2>
                    <p class="text-sm text-gray-600 mt-1">Perbarui rating dan pesan feedback Anda</p>
                </div>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Edit Form -->
            <form id="editFeedbackForm">
                <!-- Star Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Rating Layanan</label>
                    <div class="flex items-center space-x-1" id="edit-star-rating">
                        <!-- Stars will be generated by JavaScript -->
                    </div>
                    <input type="hidden" id="edit-rating-value" name="rating" value="0">
                    <p class="text-xs text-gray-500 mt-2">Klik bintang untuk memberikan rating</p>
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="edit-pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan Feedback</label>
                    <textarea id="edit-pesan" name="pesan" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                        placeholder="Bagikan pengalaman Anda menggunakan layanan kami..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">Ceritakan pengalaman Anda secara detail</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium shadow-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden backdrop-blur-sm bg-black/30">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Hapus Feedback</h2>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Confirmation Message -->
            <div class="mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Yakin ingin menghapus?</h3>
                        <p class="text-sm text-gray-600 mt-1">Feedback yang dihapus tidak dapat dikembalikan. Anda dapat memberikan feedback baru setelah menghapus yang lama.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                    Batal
                </button>
                <button type="button" onclick="confirmDelete()"
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-medium shadow-lg">
                    Hapus Feedback
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let userFeedback = null;
let currentEditId = null;
let currentDeleteId = null;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, starting to load feedback...');
    loadUserFeedback();
});

async function loadUserFeedback() {
    console.log('Loading user feedback...');
    try {
        const response = await fetch('/api/feedback/saya', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        console.log('Response status:', response.status);

        if (!response.ok) {
            if (response.status === 401) {
                console.error('Unauthorized - redirecting to login');
                window.location.href = '/login';
                return;
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Feedback data received:', data);

        // Karena 1 user = 1 feedback, ambil feedback pertama jika ada
        const feedbacks = data.data || [];
        userFeedback = feedbacks.length > 0 ? feedbacks[0] : null;

        document.getElementById('loading-state').classList.add('hidden');

        if (userFeedback) {
            // User sudah punya feedback, tampilkan feedback
            renderUserFeedback();
            document.getElementById('feedback-item').classList.remove('hidden');
        } else {
            // User belum punya feedback, tampilkan empty state dan tombol add
            document.getElementById('empty-state').classList.remove('hidden');
            document.getElementById('add-feedback-button').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error loading feedback:', error);
        document.getElementById('loading-state').classList.add('hidden');
        document.getElementById('empty-state').classList.remove('hidden');
        document.getElementById('add-feedback-button').classList.remove('hidden');

        // Show error message
        showErrorMessage('Gagal memuat feedback: ' + error.message);
    }
}

function renderUserFeedback() {
    if (!userFeedback) return;

    const container = document.getElementById('feedback-item');
    const statusBadge = getStatusBadge(userFeedback.status);
    const stars = generateStars(userFeedback.rating);
    const formattedDate = new Date(userFeedback.created_at).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    container.innerHTML = `
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
            <!-- Header dengan status dan actions -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-1">
                        ${stars}
                    </div>
                    ${statusBadge}
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="editFeedback(${userFeedback.id})"
                        class="p-2 text-blue-600 hover:bg-blue-100 rounded-xl transition-colors group"
                        title="Edit Feedback">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="deleteFeedback(${userFeedback.id})"
                        class="p-2 text-red-600 hover:bg-red-100 rounded-xl transition-colors group"
                        title="Hapus Feedback">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Feedback content -->
            <div class="bg-white rounded-xl p-4 mb-4 border border-gray-200">
                <p class="text-gray-800 leading-relaxed">${userFeedback.pesan}</p>
            </div>

            <!-- Footer info -->
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Dikirim pada ${formattedDate}
                </span>
                ${userFeedback.updated_at !== userFeedback.created_at ?
                    `<span class="text-blue-600 font-medium">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Telah diedit
                    </span>` : ''
                }
            </div>
        </div>
    `;
}

function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            stars += '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
        } else {
            stars += '<svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
        }
    }
    return stars;
}

function getStatusBadge(status) {
    switch(status) {
        case 'disetujui':
            return '<span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full border border-green-200">✓ Disetujui</span>';
        case 'ditolak':
            return '<span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full border border-red-200">✗ Ditolak</span>';
        default:
            return '<span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full border border-yellow-200">⏳ Pending</span>';
    }
}

function editFeedback(id) {
    if (!userFeedback || userFeedback.id !== id) return;

    currentEditId = id;

    // Set form values
    document.getElementById('edit-pesan').value = userFeedback.pesan;
    document.getElementById('edit-rating-value').value = userFeedback.rating;

    // Generate star rating
    generateEditStars(userFeedback.rating);

    // Show modal
    showEditModal();
}

function generateEditStars(currentRating) {
    const container = document.getElementById('edit-star-rating');
    container.innerHTML = '';

    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('button');
        star.type = 'button';
        star.className = `text-2xl transition-all duration-200 ${i <= currentRating ? 'text-yellow-400' : 'text-gray-300'} hover:text-yellow-400 hover:scale-110`;
        star.innerHTML = '<svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
        star.onclick = () => setEditRating(i);
        container.appendChild(star);
    }
}

function setEditRating(rating) {
    document.getElementById('edit-rating-value').value = rating;
    generateEditStars(rating);
}

function showEditModal() {
    const modal = document.getElementById('editModal');
    const content = document.getElementById('editModalContent');

    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    const content = document.getElementById('editModalContent');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        currentEditId = null;
    }, 300);
}

function deleteFeedback(id) {
    currentDeleteId = id;
    showDeleteModal();
}

function showDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const content = document.getElementById('deleteModalContent');

    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const content = document.getElementById('deleteModalContent');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        currentDeleteId = null;
    }, 300);
}

async function confirmDelete() {
    if (!currentDeleteId) {
        console.error('No current delete ID');
        return;
    }

    console.log(`Making DELETE request to /api/feedback/${currentDeleteId}`);

    try {
        const response = await fetch(`/api/feedback/${currentDeleteId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        console.log('Delete response status:', response.status);

        if (!response.ok) {
            const errorData = await response.json();
            console.error('Delete error response:', errorData);
            throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log('Delete success:', result);

        // Reset state - user tidak punya feedback lagi
        userFeedback = null;

        // Update UI - tampilkan empty state dan tombol add
        document.getElementById('feedback-item').classList.add('hidden');
        document.getElementById('empty-state').classList.remove('hidden');
        document.getElementById('add-feedback-button').classList.remove('hidden');

        closeDeleteModal();
        showSuccessMessage('Feedback berhasil dihapus. Anda dapat memberikan feedback baru.');

    } catch (error) {
        console.error('Error deleting feedback:', error);
        showErrorMessage('Gagal menghapus feedback: ' + error.message);
    }
}

// Handle edit form submission
document.getElementById('editFeedbackForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (!currentEditId) {
        console.error('No current edit ID');
        return;
    }

    const formData = new FormData(this);
    const data = {
        rating: parseInt(formData.get('rating')),
        pesan: formData.get('pesan')
    };

    console.log('Submitting edit form:', data);

    if (data.rating === 0) {
        showErrorMessage('Silakan berikan rating');
        return;
    }

    if (!data.pesan.trim()) {
        showErrorMessage('Silakan tulis pesan feedback');
        return;
    }

    try {
        console.log(`Making PUT request to /api/feedback/${currentEditId}`);

        const response = await fetch(`/api/feedback/${currentEditId}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: JSON.stringify(data)
        });

        console.log('Update response status:', response.status);

        if (!response.ok) {
            const errorData = await response.json();
            console.error('Update error response:', errorData);
            throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log('Update success:', result);

        // Update local data
        userFeedback = { ...userFeedback, ...data, status: 'pending', updated_at: new Date().toISOString() };

        renderUserFeedback();
        closeEditModal();

        showSuccessMessage('Feedback berhasil diperbarui');

    } catch (error) {
        console.error('Error updating feedback:', error);
        showErrorMessage('Gagal memperbarui feedback: ' + error.message);
    }
});

// Utility functions for notifications
function showSuccessMessage(message) {
    showNotification(message, 'success');
}

function showErrorMessage(message) {
    showNotification(message, 'error');
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full ${
        type === 'success' ? 'bg-green-100 border border-green-200 text-green-800' :
        type === 'error' ? 'bg-red-100 border border-red-200 text-red-800' :
        'bg-blue-100 border border-blue-200 text-blue-800'
    }`;

    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ?
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>' :
                    type === 'error' ?
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                }
            </svg>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}

// Close modals when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endpush
