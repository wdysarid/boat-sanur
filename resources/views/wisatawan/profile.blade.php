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
                                @elseif (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Foto Profil"
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

                            <!-- DYNAMIC EMAIL VERIFICATION STATUS -->
                            <div class="mt-4 flex items-center justify-center">
                                @if (Auth::user()->email_verified_at)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Akun Terverifikasi
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Belum Terverifikasi
                                    </span>
                                @endif
                            </div>

                            <!-- SHOW VERIFICATION NOTICE IF NOT VERIFIED -->
                            @if (!Auth::user()->email_verified_at)
                                <div class="mt-3">
                                    <a href="{{ route('verification.notice') }}"
                                       class="text-xs text-blue-600 hover:text-blue-700 underline">
                                        Verifikasi Email Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">{{ $total_trips ?? 200 }}</p>
                                    <p class="text-xs text-gray-600">Total Perjalanan</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">{{ $monthly_trips ?? 100 }}</p>
                                    <p class="text-xs text-gray-600">Perjalanan Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h4>
                        <div class="space-y-3">
                            <a href="{{ route('search.tickets') }}"
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

                        <!-- VALIDATION ERROR DISPLAY -->
                        <div id="validationErrors" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h4>
                                    <ul id="errorList" class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <form id="profileForm" action="{{ route('wisatawan.profile.update') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-4" novalidate>
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- FOTO PROFIL (OPTIONAL) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Foto Profil
                                        <span class="text-gray-500 text-xs">(Opsional)</span>
                                    </label>
                                    <input type="file" name="foto_user" id="foto_user"
                                        accept="image/jpeg,image/png,image/jpg,image/gif"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                    <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</p>

                                    <div class="mt-2 flex items-center space-x-4" id="foto_preview_container"
                                        style="display: none;">
                                        <div
                                            class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
                                            <img id="foto_preview" src="#" alt="Preview Foto"
                                                class="w-full h-full object-cover hidden">
                                            <svg id="foto_placeholder" class="w-12 h-12 text-blue-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <button type="button" id="removePhotoBtn"
                                            class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                    </div>
                                </div>

                                <!-- NAMA LENGKAP (REQUIRED) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" id="nama" value="{{ Auth::user()->nama }}"
                                        required
                                        minlength="2"
                                        maxlength="255"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent invalid:border-red-500 invalid:ring-red-500"
                                        disabled>
                                    <div class="mt-1 text-sm text-red-600 hidden" id="nama-error"></div>
                                </div>

                                <!-- EMAIL (REQUIRED) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                        required
                                        maxlength="255"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent invalid:border-red-500 invalid:ring-red-500"
                                        disabled>
                                    <div class="mt-1 text-sm text-red-600 hidden" id="email-error"></div>
                                </div>

                                <!-- NOMOR TELEPON (OPTIONAL) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor Telepon
                                        <span class="text-gray-500 text-xs">(Opsional)</span>
                                    </label>
                                    <input type="tel" name="no_telp" id="no_telp" value="{{ Auth::user()->no_telp }}"
                                        maxlength="20"
                                        pattern="[0-9+\-\s]+"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        disabled>
                                    <p class="mt-1 text-xs text-gray-500">Contoh: 08123456789 atau +62812345678</p>
                                    <div class="mt-1 text-sm text-red-600 hidden" id="no_telp-error"></div>
                                </div>
                            </div>


                            <div class="hidden" id="profileActions">
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button type="button" onclick="cancelEdit()"
                                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit" id="submitBtn"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
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
                                    <p class="text-sm text-gray-600">Ubah password anda untuk keamanan akun</p>
                                </div>
                                <a href="{{ route('wisatawan.profile.change-password') }}"
                                    class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition-colors">
                                    Ubah Password
                                </a>
                            </div>

                            <!-- DYNAMIC EMAIL VERIFICATION STATUS IN SECURITY SECTION -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Verifikasi Email</h4>
                                    @if (Auth::user()->email_verified_at)
                                        <p class="text-sm text-green-600">
                                            Email sudah terverifikasi pada {{ Auth::user()->email_verified_at->format('d M Y, H:i') }}
                                        </p>
                                    @else
                                        <p class="text-sm text-red-600">Email belum diverifikasi</p>
                                    @endif
                                </div>
                                @if (Auth::user()->email_verified_at)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        Aktif
                                    </span>
                                @else
                                    <a href="{{ route('verification.notice') }}"
                                       class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                        Verifikasi Sekarang
                                    </a>
                                @endif
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
        // VALIDATION FUNCTIONS
        function validateForm() {
            const errors = [];
            let isValid = true;

            // Clear previous errors
            clearValidationErrors();

            // Validate Nama (Required)
            const nama = document.getElementById('nama');
            if (!nama.value.trim()) {
                errors.push('Nama lengkap wajib diisi');
                showFieldError('nama', 'Nama lengkap wajib diisi');
                isValid = false;
            } else if (nama.value.trim().length < 2) {
                errors.push('Nama lengkap minimal 2 karakter');
                showFieldError('nama', 'Nama lengkap minimal 2 karakter');
                isValid = false;
            }

            // Validate Email (Required)
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim()) {
                errors.push('Email wajib diisi');
                showFieldError('email', 'Email wajib diisi');
                isValid = false;
            } else if (!emailRegex.test(email.value.trim())) {
                errors.push('Format email tidak valid');
                showFieldError('email', 'Format email tidak valid');
                isValid = false;
            }

            // Validate Phone (Optional, but if filled must be valid)
            const noTelp = document.getElementById('no_telp');
            if (noTelp.value.trim()) {
                const phoneRegex = /^[0-9+\-\s]+$/;
                if (!phoneRegex.test(noTelp.value.trim())) {
                    errors.push('Format nomor telepon tidak valid');
                    showFieldError('no_telp', 'Format nomor telepon tidak valid (hanya angka, +, -, dan spasi)');
                    isValid = false;
                }
            }

            // Validate Photo (Optional, but if uploaded must be valid)
            const fotoUser = document.getElementById('foto_user');
            if (fotoUser.files && fotoUser.files[0]) {
                const file = fotoUser.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    errors.push('Format foto tidak didukung (hanya JPG, PNG, GIF)');
                    isValid = false;
                }

                if (file.size > maxSize) {
                    errors.push('Ukuran foto maksimal 2MB');
                    isValid = false;
                }
            }

            // Show validation errors
            if (errors.length > 0) {
                showValidationErrors(errors);
            }

            return isValid;
        }

        function showFieldError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.getElementById(fieldId + '-error');

            field.classList.add('border-red-500', 'ring-red-500');
            field.classList.remove('border-gray-300');

            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.remove('hidden');
            }
        }

        function clearValidationErrors() {
            // Clear field errors
            const fields = ['nama', 'email', 'no_telp'];
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                const errorDiv = document.getElementById(fieldId + '-error');

                field.classList.remove('border-red-500', 'ring-red-500');
                field.classList.add('border-gray-300');

                if (errorDiv) {
                    errorDiv.classList.add('hidden');
                    errorDiv.textContent = '';
                }
            });

            // Hide validation errors container
            document.getElementById('validationErrors').classList.add('hidden');
        }

        function showValidationErrors(errors) {
            const errorContainer = document.getElementById('validationErrors');
            const errorList = document.getElementById('errorList');

            errorList.innerHTML = '';
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });

            errorContainer.classList.remove('hidden');

            // Scroll to error container
            errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // PROFILE EDITING FUNCTIONS
        function editProfile() {
            const form = document.getElementById('profileForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.disabled = false;
            });

            // Clear any previous validation errors
            clearValidationErrors();

            // Setup file preview elements
            const fotoInput = document.getElementById('foto_user');
            const fotoPreview = document.getElementById('foto_preview');
            const fotoPlaceholder = document.getElementById('foto_placeholder');
            const fotoContainer = document.getElementById('foto_preview_container');
            const removePhotoBtn = document.getElementById('removePhotoBtn');
            const removePhotoInput = document.getElementById('remove_photo');

            // Show current photo if exists
            if ('{{ Auth::user()->foto_user }}' || '{{ Auth::user()->avatar }}') {
                const photoSrc = '{{ Auth::user()->foto_user }}' ?
                    '{{ asset('storage/' . Auth::user()->foto_user) }}' :
                    '{{ Auth::user()->avatar }}';
                fotoPreview.src = photoSrc;
                fotoPreview.classList.remove('hidden');
                fotoPlaceholder.classList.add('hidden');
                fotoContainer.style.display = 'flex';
            } else {
                fotoPlaceholder.classList.remove('hidden');
                fotoContainer.style.display = 'flex';
            }

            // File input change handler
            fotoInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Validate file
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!allowedTypes.includes(file.type)) {
                        showToast('Format foto tidak didukung. Gunakan JPG, PNG, atau GIF.', 'error');
                        this.value = '';
                        return;
                    }

                    if (file.size > maxSize) {
                        showToast('Ukuran foto terlalu besar. Maksimal 2MB.', 'error');
                        this.value = '';
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fotoPreview.src = e.target.result;
                        fotoPreview.classList.remove('hidden');
                        fotoPlaceholder.classList.add('hidden');
                        fotoContainer.style.display = 'flex';
                        removePhotoInput.value = '0'; // Reset remove photo flag
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle remove photo button
            removePhotoBtn.addEventListener('click', function() {
                fotoPreview.src = '#';
                fotoPreview.classList.add('hidden');
                fotoPlaceholder.classList.remove('hidden');
                fotoInput.value = '';
                removePhotoInput.value = '1'; // Set flag to remove photo
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

            // Clear validation errors
            clearValidationErrors();

            document.getElementById('foto_preview_container').style.display = 'none';

            // Reset photo removal flag
            document.getElementById('remove_photo').value = '0';

            document.getElementById('profileActions').classList.add('hidden');
            showToast('Edit dibatalkan', 'info');
        }

        function changePassword() {
            showToast('Fitur ubah password akan segera tersedia', 'info');
        }

        // Handle profile form submission
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate form before submission
            if (!validateForm()) {
                showToast('Mohon perbaiki kesalahan pada form', 'error');
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';

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
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Simpan Perubahan';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat memperbarui profil', 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Simpan Perubahan';
                });
        });

        // Real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            const namaField = document.getElementById('nama');
            const emailField = document.getElementById('email');
            const noTelpField = document.getElementById('no_telp');

            // Real-time validation for nama
            namaField.addEventListener('blur', function() {
                if (!this.disabled) {
                    const errorDiv = document.getElementById('nama-error');
                    if (!this.value.trim()) {
                        showFieldError('nama', 'Nama lengkap wajib diisi');
                    } else if (this.value.trim().length < 2) {
                        showFieldError('nama', 'Nama lengkap minimal 2 karakter');
                    } else {
                        this.classList.remove('border-red-500', 'ring-red-500');
                        this.classList.add('border-gray-300');
                        errorDiv.classList.add('hidden');
                    }
                }
            });

            // Real-time validation for email
            emailField.addEventListener('blur', function() {
                if (!this.disabled) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const errorDiv = document.getElementById('email-error');
                    if (!this.value.trim()) {
                        showFieldError('email', 'Email wajib diisi');
                    } else if (!emailRegex.test(this.value.trim())) {
                        showFieldError('email', 'Format email tidak valid');
                    } else {
                        this.classList.remove('border-red-500', 'ring-red-500');
                        this.classList.add('border-gray-300');
                        errorDiv.classList.add('hidden');
                    }
                }
            });

            // Real-time validation for phone (optional)
            noTelpField.addEventListener('blur', function() {
                if (!this.disabled && this.value.trim()) {
                    const phoneRegex = /^[0-9+\-\s]+$/;
                    const errorDiv = document.getElementById('no_telp-error');
                    if (!phoneRegex.test(this.value.trim())) {
                        showFieldError('no_telp', 'Format nomor telepon tidak valid');
                    } else {
                        this.classList.remove('border-red-500', 'ring-red-500');
                        this.classList.add('border-gray-300');
                        errorDiv.classList.add('hidden');
                    }
                }
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
