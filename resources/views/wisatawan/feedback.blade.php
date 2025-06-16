@extends('layouts.wisatawan')

@section('title', 'Feedback Saya')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Feedback Saya</h1>
                        <p class="text-gray-600">Kelola feedback dan review yang telah Anda berikan</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback List -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Feedback</h3>
                    <a href="{{ route('home') }}#feedback" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Feedback
                    </a>
                </div>
            </div>

            <div class="p-6" id="feedback-container">
                <!-- Loading State -->
                <div id="loading-state" class="text-center py-8">
                    <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-blue-600 bg-blue-50">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat feedback...
                    </div>
                </div>

                <!-- Feedback Items akan dimuat di sini -->
                <div id="feedback-list" class="hidden space-y-4">
                    <!-- Feedback items will be loaded here -->
                </div>

                <!-- Empty State -->
                <div id="empty-state" class="hidden text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Feedback</h3>
                    <p class="mt-2 text-gray-600">Anda belum memberikan feedback apapun.</p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}#feedback" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Berikan Feedback Pertama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="editModalContent">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Edit Feedback</h2>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Edit Form -->
            <form id="editFeedbackForm">
                <!-- Star Rating -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Rating</label>
                    <div class="flex items-center space-x-1" id="edit-star-rating">
                        <!-- Stars will be generated by JavaScript -->
                    </div>
                    <input type="hidden" id="edit-rating-value" name="rating" value="0">
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="edit-pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan Feedback</label>
                    <textarea id="edit-pesan" name="pesan" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Bagikan pengalaman Anda..."></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900">Hapus Feedback</h2>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-sm text-gray-600 mt-1">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="button" onclick="confirmDelete()"
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let feedbacks = [];
let currentEditId = null;
let currentDeleteId = null;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, starting to load feedbacks...');
    loadFeedbacks();
});

async function loadFeedbacks() {
    console.log('Loading feedbacks...');
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
        console.log('Response headers:', response.headers);

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
        feedbacks = data.data || [];

        document.getElementById('loading-state').classList.add('hidden');

        if (feedbacks.length === 0) {
            document.getElementById('empty-state').classList.remove('hidden');
        } else {
            document.getElementById('feedback-list').classList.remove('hidden');
            renderFeedbacks();
        }
    } catch (error) {
        console.error('Error loading feedbacks:', error);
        document.getElementById('loading-state').classList.add('hidden');
        document.getElementById('empty-state').classList.remove('hidden');

        // Show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
        errorDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
        document.getElementById('feedback-container').prepend(errorDiv);
    }
}

function renderFeedbacks() {
    const container = document.getElementById('feedback-list');
    container.innerHTML = '';

    feedbacks.forEach(feedback => {
        const feedbackElement = createFeedbackElement(feedback);
        container.appendChild(feedbackElement);
    });
}

function createFeedbackElement(feedback) {
    const div = document.createElement('div');
    div.className = 'bg-gray-50 rounded-xl p-6 border border-gray-200';

    const statusBadge = getStatusBadge(feedback.status);
    const stars = generateStars(feedback.rating);
    const formattedDate = new Date(feedback.created_at).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    div.innerHTML = `
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-3">
                <div class="flex items-center">
                    ${stars}
                </div>
                ${statusBadge}
            </div>
            <div class="flex items-center space-x-2">
                <button onclick="editFeedback(${feedback.id})"
                    class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors"
                    title="Edit Feedback">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </button>
                <button onclick="deleteFeedback(${feedback.id})"
                    class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                    title="Hapus Feedback">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>
        <p class="text-gray-700 mb-3 leading-relaxed">${feedback.pesan}</p>
        <div class="text-sm text-gray-500">
            <span>Dikirim pada ${formattedDate}</span>
        </div>
    `;

    return div;
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
            return '<span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>';
        case 'ditolak':
            return '<span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>';
        default:
            return '<span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>';
    }
}

function editFeedback(id) {
    const feedback = feedbacks.find(f => f.id === id);
    if (!feedback) return;

    currentEditId = id;

    // Set form values
    document.getElementById('edit-pesan').value = feedback.pesan;
    document.getElementById('edit-rating-value').value = feedback.rating;

    // Generate star rating
    generateEditStars(feedback.rating);

    // Show modal
    showEditModal();
}

function generateEditStars(currentRating) {
    const container = document.getElementById('edit-star-rating');
    container.innerHTML = '';

    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('button');
        star.type = 'button';
        star.className = `text-2xl transition-colors ${i <= currentRating ? 'text-yellow-400' : 'text-gray-300'} hover:text-yellow-400`;
        star.innerHTML = '<svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
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

        // Remove from local array
        feedbacks = feedbacks.filter(f => f.id !== currentDeleteId);

        // Re-render
        if (feedbacks.length === 0) {
            document.getElementById('feedback-list').classList.add('hidden');
            document.getElementById('empty-state').classList.remove('hidden');
        } else {
            renderFeedbacks();
        }

        closeDeleteModal();
        alert('Feedback berhasil dihapus');

    } catch (error) {
        console.error('Error deleting feedback:', error);
        alert('Gagal menghapus feedback: ' + error.message);
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
        alert('Silakan berikan rating');
        return;
    }

    if (!data.pesan.trim()) {
        alert('Silakan tulis pesan feedback');
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

        // Update local array
        const index = feedbacks.findIndex(f => f.id === currentEditId);
        if (index !== -1) {
            feedbacks[index] = { ...feedbacks[index], ...data, status: 'pending' };
        }

        renderFeedbacks();
        closeEditModal();

        alert('Feedback berhasil diperbarui');

    } catch (error) {
        console.error('Error updating feedback:', error);
        alert('Gagal memperbarui feedback: ' + error.message);
    }
});

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
