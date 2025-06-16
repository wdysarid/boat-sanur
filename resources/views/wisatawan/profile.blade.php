@extends('layouts.wisatawan')

@section('title', 'Profile Saya')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('wisatawan.dashboard') }}" class="text-gray-500 hover:text-gray-700">
                                <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-900">Profile Saya</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-4">
                    <h1 class="text-3xl font-bold text-gray-900">Profile Saya</h1>
                    <p class="mt-2 text-gray-600">Kelola informasi akun dan preferensi Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="text-center">
                            <div
                                class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center overflow-hidden">
                                @if (Auth::user()->foto_user)
                                    <img src="{{ asset('storage/' . Auth::user()->foto_user) }}" alt="Foto Profil"
                                        class="w-full h-full object-cover">
                                @else
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->nama ?? 'John Doe' }}</h3>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email ?? 'john.doe@email.com' }}</p>
                            <div class="mt-4 flex items-center justify-center">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    Akun Terverifikasi
                                </span>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">12</p>
                                    <p class="text-xs text-gray-600">Total Perjalanan</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">3</p>
                                    <p class="text-xs text-gray-600">Perjalanan Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h4>
                        <div class="space-y-3">
                            <a href="{{ route('wisatawan.dashboard') }}"
                                class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm font-medium">Pesan Tiket Baru</span>
                            </a>
                            <a href="{{ route('wisatawan.konfirmasi') }}"
                                class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                <span class="text-sm font-medium">Lihat Tiket Saya</span>
                            </a>
                            <button onclick="downloadHistory()"
                                class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors w-full text-left">
                                <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm font-medium">Download Riwayat</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Personal Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                            <button onclick="editProfile()"
                                class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                Edit Profile
                            </button>
                        </div>

                        <form id="profileForm" action="{{ route('wisatawan.profile.update') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                                    <input type="file" name="foto_user" id="foto_user"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                    @if (Auth::user()->foto_user)
                                        <div class="mt-2" id="foto_preview_container">
                                            <img src="{{ asset('storage/' . Auth::user()->foto_user) }}" id="foto_preview"
                                                alt="Preview Foto" class="w-20 h-20 object-cover rounded-full">
                                        </div>
                                    @else
                                        <div class="mt-2" id="foto_preview_container" style="display: none;">
                                            <img id="foto_preview" src="#" alt="Preview Foto"
                                                class="w-20 h-20 object-cover rounded-full">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ Auth::user()->nama }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="text" name="no_telp" value="{{ Auth::user()->no_telp }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                </div>
                            </div>

                            <div class="hidden" id="profileActions">
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button type="button" onclick="cancelEdit()"
                                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Security Settings -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Keamanan Akun</h3>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Password</h4>
                                    <p class="text-sm text-gray-600">Terakhir diubah 3 bulan yang lalu</p>
                                </div>
                                <button onclick="changePassword()"
                                    class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                    Ubah Password
                                </button>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Verifikasi Email</h4>
                                    <p class="text-sm text-green-600">Email sudah terverifikasi</p>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    Aktif
                                </span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Verifikasi Nomor HP</h4>
                                    <p class="text-sm text-yellow-600">Nomor HP belum diverifikasi</p>
                                </div>
                                <button onclick="verifyPhone()"
                                    class="px-4 py-2 text-yellow-600 hover:bg-yellow-50 rounded-lg text-sm font-medium transition-colors">
                                    Verifikasi
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
    <script>
        function editProfile() {
            const form = document.getElementById('profileForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.disabled = false;
            });

            // Setup file preview
            document.getElementById('foto_user').addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('foto_preview').src = e.target.result;
                        document.getElementById('foto_preview_container').style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            document.getElementById('profileActions').classList.remove('hidden');
            showToast('Mode edit diaktifkan', 'info');
        }

        function cancelEdit() {
            const form = document.getElementById('profileForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.disabled = true;
            });

            document.getElementById('profileActions').classList.add('hidden');
            showToast('Edit dibatalkan', 'info');
        }

        function changePassword() {
            showToast('Fitur ubah password akan segera tersedia', 'info');
        }

        function verifyPhone() {
            showToast('Kode verifikasi akan dikirim ke nomor HP Anda', 'success');
        }

        function downloadHistory() {
            showToast('Mengunduh riwayat perjalanan...', 'success');
        }

        // Handle profile form submission
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            showToast('Menyimpan perubahan...', 'info');

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST', // Laravel will handle PATCH via method spoofing
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Profile berhasil diperbarui!', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showToast(data.message || 'Gagal memperbarui profil', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat memperbarui profil', 'error');
                });
        });

        // Improved Toast Function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');

            // Create toast element
            const toast = document.createElement('div');
            toast.className = `
        flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg
        transform transition-all duration-300 ease-in-out translate-x-full opacity-0
    `;

            // Icon based on type
            let icon = '';
            let colorClass = '';

            switch (type) {
                case 'success':
                    colorClass = 'text-green-500';
                    icon = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
            `;
                    break;
                case 'error':
                    colorClass = 'text-red-500';
                    icon = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            `;
                    break;
                case 'warning':
                    colorClass = 'text-yellow-500';
                    icon = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            `;
                    break;
                default:
                    colorClass = 'text-blue-500';
                    icon = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            `;
            }

            toast.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${colorClass} bg-opacity-20 rounded-lg">
            ${icon}
        </div>
        <div class="ml-3 text-sm font-medium text-gray-900">${message}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            // Auto remove after 4 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.remove();
                        }
                    }, 300);
                }
            }, 4000);
        }
    </script>
@endpush
