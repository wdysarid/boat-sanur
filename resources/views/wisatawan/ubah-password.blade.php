@extends('layouts.wisatawan')

@section('title', 'Ubah Password')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                                <a href="{{ route('wisatawan.profile') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Profile</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-900">Ubah Password</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-4">
                    <h1 class="text-3xl font-bold text-gray-900">Ubah Password</h1>
                    <p class="mt-2 text-gray-600">Pastikan akun Anda tetap aman dengan password yang kuat</p>
                </div>
            </div>

            <!-- Change Password Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <!-- Google Account Notice -->
                @if (Auth::user()->google_id && !Auth::user()->password)
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-blue-700">
                                <strong>Akun Google:</strong> Anda login menggunakan Google. Untuk mengubah password, silakan lakukan melalui akun Google Anda.
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Validation Error Display -->
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

                <form id="changePasswordForm" action="{{ route('wisatawan.profile.change-password.post') }}" method="POST" class="space-y-6" novalidate>
                    @csrf

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                placeholder="Masukkan password saat ini">
                            <button type="button" onclick="togglePassword('current_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-1 text-sm text-red-600 hidden" id="current_password-error"></div>
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="new_password" id="new_password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                placeholder="Masukkan password baru">
                            <button type="button" onclick="togglePassword('new_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-1 text-sm text-red-600 hidden" id="new_password-error"></div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="text-xs text-gray-600 mb-1">Kekuatan Password:</div>
                            <div class="flex space-x-1">
                                <div class="h-2 w-1/4 bg-gray-200 rounded" id="strength-1"></div>
                                <div class="h-2 w-1/4 bg-gray-200 rounded" id="strength-2"></div>
                                <div class="h-2 w-1/4 bg-gray-200 rounded" id="strength-3"></div>
                                <div class="h-2 w-1/4 bg-gray-200 rounded" id="strength-4"></div>
                            </div>
                            <div class="text-xs mt-1" id="strength-text">Masukkan password</div>
                        </div>
                    </div>

                    <!-- Confirm New Password -->
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                placeholder="Ulangi password baru">
                            <button type="button" onclick="togglePassword('new_password_confirmation')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-1 text-sm text-red-600 hidden" id="new_password_confirmation-error"></div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Syarat Password:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Minimal 6 karakter
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Mengandung huruf besar dan kecil
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Mengandung angka
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Mengandung simbol (!@#$%^&*)
                            </li>
                        </ul>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('wisatawan.profile') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            @if(Auth::user()->google_id && !Auth::user()->password) disabled @endif>
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
    <script>
        // Password visibility toggle
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = [];

            if (password.length >= 6) strength++;
            else feedback.push('Minimal 6 karakter');

            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            else feedback.push('Huruf besar dan kecil');

            if (/\d/.test(password)) strength++;
            else feedback.push('Angka');

            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
            else feedback.push('Simbol');

            return { strength, feedback };
        }

        // Update password strength indicator
        function updatePasswordStrength() {
            const password = document.getElementById('new_password').value;
            const { strength, feedback } = checkPasswordStrength(password);

            // Reset all strength indicators
            for (let i = 1; i <= 4; i++) {
                const indicator = document.getElementById(`strength-${i}`);
                indicator.className = 'h-2 w-1/4 bg-gray-200 rounded';
            }

            // Update strength indicators
            const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
            for (let i = 1; i <= strength; i++) {
                const indicator = document.getElementById(`strength-${i}`);
                indicator.className = `h-2 w-1/4 ${colors[strength - 1]} rounded`;
            }

            // Update strength text
            const strengthText = document.getElementById('strength-text');
            const strengthLabels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat'];
            if (password.length === 0) {
                strengthText.textContent = 'Masukkan password';
                strengthText.className = 'text-xs mt-1 text-gray-500';
            } else {
                strengthText.textContent = strengthLabels[strength - 1] || 'Sangat Lemah';
                const textColors = ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-green-600'];
                strengthText.className = `text-xs mt-1 ${textColors[strength - 1] || 'text-red-600'}`;
            }
        }

        // Validation functions
        function validateForm() {
            const errors = [];
            let isValid = true;

            clearValidationErrors();

            const currentPassword = document.getElementById('current_password');
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('new_password_confirmation');

            // Validate current password
            if (!currentPassword.value.trim()) {
                errors.push('Password saat ini wajib diisi');
                showFieldError('current_password', 'Password saat ini wajib diisi');
                isValid = false;
            }

            // Validate new password
            if (!newPassword.value.trim()) {
                errors.push('Password baru wajib diisi');
                showFieldError('new_password', 'Password baru wajib diisi');
                isValid = false;
            } else {
                const { strength } = checkPasswordStrength(newPassword.value);
                if (strength < 4) {
                    errors.push('Password baru tidak memenuhi syarat keamanan');
                    showFieldError('new_password', 'Password tidak memenuhi syarat keamanan');
                    isValid = false;
                }
            }

            // Validate password confirmation
            if (!confirmPassword.value.trim()) {
                errors.push('Konfirmasi password wajib diisi');
                showFieldError('new_password_confirmation', 'Konfirmasi password wajib diisi');
                isValid = false;
            } else if (newPassword.value !== confirmPassword.value) {
                errors.push('Konfirmasi password tidak cocok');
                showFieldError('new_password_confirmation', 'Konfirmasi password tidak cocok');
                isValid = false;
            }

            // Check if new password is same as current
            if (currentPassword.value === newPassword.value && newPassword.value.trim()) {
                errors.push('Password baru tidak boleh sama dengan password saat ini');
                showFieldError('new_password', 'Password baru tidak boleh sama dengan password saat ini');
                isValid = false;
            }

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
            const fields = ['current_password', 'new_password', 'new_password_confirmation'];
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
            errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const newPasswordField = document.getElementById('new_password');
            const confirmPasswordField = document.getElementById('new_password_confirmation');

            // Password strength checker
            newPasswordField.addEventListener('input', updatePasswordStrength);

            // Real-time validation
            confirmPasswordField.addEventListener('blur', function() {
                const newPassword = newPasswordField.value;
                const confirmPassword = this.value;

                if (confirmPassword && newPassword !== confirmPassword) {
                    showFieldError('new_password_confirmation', 'Konfirmasi password tidak cocok');
                } else if (confirmPassword) {
                    this.classList.remove('border-red-500', 'ring-red-500');
                    this.classList.add('border-gray-300');
                    document.getElementById('new_password_confirmation-error').classList.add('hidden');
                }
            });
        });

        // Form submission
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                showToast('Mohon perbaiki kesalahan pada form', 'error');
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengubah Password...';

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Password berhasil diubah!', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("wisatawan.profile") }}';
                    }, 1500);
                } else {
                    if (data.errors) {
                        // Show field-specific errors
                        Object.keys(data.errors).forEach(field => {
                            showFieldError(field, data.errors[field][0]);
                        });
                        showValidationErrors(Object.values(data.errors).flat());
                    } else {
                        showToast(data.message || 'Gagal mengubah password', 'error');
                    }
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Ubah Password';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan saat mengubah password', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ubah Password';
            });
        });

        // Toast function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `
                flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg
                transform transition-all duration-300 ease-in-out translate-x-full opacity-0
            `;

            let icon = '';
            let colorClass = '';

            switch (type) {
                case 'success':
                    colorClass = 'text-green-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>`;
                    break;
                case 'error':
                    colorClass = 'text-red-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>`;
                    break;
                default:
                    colorClass = 'text-blue-500';
                    icon = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>`;
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

            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100);

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
