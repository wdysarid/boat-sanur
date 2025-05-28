import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    // Navbar background change on scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 10) {
            navbar.classList.remove("bg-transparent");
            navbar.classList.add("bg-[#30A2FF]", "shadow-md");
        } else {
            navbar.classList.remove("bg-[#30A2FF]", "shadow-md");
            navbar.classList.add("bg-transparent");
        }
    });

    // Toggle mobile menu
    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });

    window.Alpine = Alpine;

    Alpine.start();

    // Global utilities
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' :
                    type === 'error' ? 'bg-red-500' :
                    type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

        toast.className = `toast toast-${type} ${bgColor} translate-x-full`;
        toast.textContent = message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    };

    // Global error handler
    window.handleApiError = function(error, defaultMessage = 'Terjadi kesalahan sistem') {
        console.error('API Error:', error);

        if (error.response) {
            const data = error.response.data;
            if (data.message) {
                showToast(data.message, 'error');
            } else if (data.errors) {
                const firstError = Object.values(data.errors)[0];
                showToast(Array.isArray(firstError) ? firstError[0] : firstError, 'error');
            } else {
                showToast(defaultMessage, 'error');
            }
        } else {
            showToast(defaultMessage, 'error');
        }
    };

    // Form validation utilities
    window.validateForm = function(formElement) {
        const inputs = formElement.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });

        return isValid;
    };

    // Clear form errors
    window.clearFormErrors = function(formElement) {
        const inputs = formElement.querySelectorAll('.border-red-500');
        inputs.forEach(input => {
            input.classList.remove('border-red-500');
        });

        const errorMessages = formElement.querySelectorAll('.error-message');
        errorMessages.forEach(message => {
            message.remove();
        });
    };

    // File upload preview
    window.setupFilePreview = function(inputElement, previewElement) {
        inputElement.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    showToast('Format file harus JPEG, PNG, JPG, atau GIF', 'error');
                    this.value = '';
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran file maksimal 2MB', 'error');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                    previewElement.parentElement.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    };

    // Loading state management
    window.setLoadingState = function(button, isLoading, loadingText = 'Loading...') {
        if (isLoading) {
            button.disabled = true;
            button.dataset.originalText = button.innerHTML;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${loadingText}
            `;
        } else {
            button.disabled = false;
            button.innerHTML = button.dataset.originalText || button.innerHTML;
        }
    };

    // Confirmation dialog
    window.confirmAction = function(message, callback) {
        if (confirm(message)) {
            callback();
        }
    };

    // Format currency
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    };

    // Format date
    window.formatDate = function(date, options = {}) {
        const defaultOptions = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        return new Intl.DateTimeFormat('id-ID', { ...defaultOptions, ...options }).format(new Date(date));
    };
});

