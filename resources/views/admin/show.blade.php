@extends('layouts.admin')

@section('title', 'Detail Penumpang')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Penumpang</h1>
                <p class="text-gray-600">Informasi lengkap penumpang dan riwayat aktivitas</p>
            </div>
            <a href="{{ route('admin.passengers') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Passenger Info -->
        <div class="lg:col-span-2">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-lg font-medium text-blue-600">AS</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Andi Setiawan</h3>
                            <p class="text-sm text-gray-500">TKT-001-2025</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Penumpang</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">Andi Setiawan</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="mt-1 text-sm text-gray-900">andi.setiawan@email.com</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <p class="mt-1 text-sm text-gray-900">+62 812-3456-7890</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <p class="mt-1 text-sm text-gray-900">15/08/1990</p>
                            <p class="text-xs text-gray-500">34 tahun</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipe Penumpang</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Adult
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Kursi</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono">A12</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Information -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Pemesanan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pembeli Tiket</label>
                            <div class="mt-1">
                                <p class="text-sm text-gray-900">Andi Setiawan</p>
                                <p class="text-xs text-gray-500">andi.setiawan@email.com</p>
                                <p class="text-xs text-gray-500">+62 812-3456-7890</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Tiket</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">TKT-001-2025</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">QR Code</label>
                            <p class="mt-1 text-xs text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded break-all">QR-TKT001-2025-ABCD1234</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pemesanan</label>
                            <p class="mt-1 text-sm text-gray-900">20/01/2025 14:30:15</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Booking ID</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono">#BK-2025-001</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Paid
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Information -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Jadwal Perjalanan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rute Perjalanan</label>
                            <div class="mt-1 flex items-center">
                                <span class="text-sm text-gray-900 font-medium">Sanur</span>
                                <svg class="mx-2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                                <span class="text-sm text-gray-900 font-medium">Nusa Penida</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kapal</label>
                            <p class="mt-1 text-sm text-gray-900">Fast Boat Sanur Express</p>
                            <p class="text-xs text-gray-500">Kapasitas: 50 penumpang</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Keberangkatan</label>
                            <p class="mt-1 text-sm text-gray-900 font-medium">Sabtu, 25 Januari 2025</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu Keberangkatan</label>
                            <p class="mt-1 text-sm text-gray-900 font-medium">08:00 WITA</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estimasi Perjalanan</label>
                            <p class="mt-1 text-sm text-gray-900">45 menit</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estimasi Tiba</label>
                            <p class="mt-1 text-sm text-gray-900">08:45 WITA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Timeline Aktivitas</h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <!-- Booking -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-900">Tiket dipesan</p>
                                                <p class="text-xs text-gray-500">Pemesanan berhasil dibuat</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>20/01/2025 14:30</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Payment -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-900">Pembayaran dikonfirmasi</p>
                                                <p class="text-xs text-gray-500">Rp 150.000 - Transfer Bank</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>20/01/2025 15:45</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Check-in -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-900">Check-in berhasil</p>
                                                <p class="text-xs text-gray-500">QR Code discan - Admin: admin@sanurboat.com</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>25/01/2025 07:30</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Boarding -->
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center ring-8 ring-white">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-900">Boarding berhasil</p>
                                                <p class="text-xs text-gray-500">Penumpang naik kapal - Kursi A12</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time>25/01/2025 07:45</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Actions Sidebar -->
        <div class="lg:col-span-1">
            <!-- Current Status Card -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Status Saat Ini</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <span class="inline-flex px-4 py-2 text-lg font-semibold rounded-full bg-green-100 text-green-800">
                            Boarded
                        </span>
                        <p class="text-sm text-gray-500 mt-2">Penumpang sudah naik kapal</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Check-in:</span>
                            <span class="text-sm text-gray-900">07:30</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Boarding:</span>
                            <span class="text-sm text-gray-900">07:45</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Departure:</span>
                            <span class="text-sm text-gray-500">-</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Arrival:</span>
                            <span class="text-sm text-gray-500">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Aksi Cepat</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button onclick="updateStatus('completed')"
                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark as Completed
                    </button>

                    <button onclick="showQrCode()"
                            class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01"></path>
                        </svg>
                        Show QR Code
                    </button>

                    <button onclick="printTicket()"
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Ticket
                    </button>

                    <hr class="my-4">

                    <button onclick="updateStatus('cancelled')"
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel Ticket
                    </button>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Catatan Admin</h3>
                </div>
                <div class="p-6">
                    <textarea id="notesTextarea" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                              placeholder="Tambahkan catatan khusus untuk penumpang ini...">Penumpang sudah boarding tepat waktu. Tidak ada masalah khusus. Membawa 1 tas kecil.</textarea>
                    <button onclick="saveNotes()"
                            class="mt-3 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan Catatan
                    </button>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Kontak Darurat</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide">Email</label>
                            <a href="mailto:andi.setiawan@email.com" class="text-sm text-blue-600 hover:text-blue-800">
                                andi.setiawan@email.com
                            </a>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide">Telepon</label>
                            <a href="tel:+6281234567890" class="text-sm text-blue-600 hover:text-blue-800">
                                +62 812-3456-7890
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div id="qrCodeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-sm w-full p-6 text-center">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">QR Code Tiket</h3>
                <button onclick="closeQrCode()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mb-4">
                <div id="qrCodeContainer" class="flex justify-center">
                    <div class="w-40 h-40 bg-gray-200 flex items-center justify-center text-xs text-gray-500 border-2 border-dashed border-gray-300 rounded">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m6-4h.01M12 8h.01M12 8h4.01M12 8h-4.01"></path>
                            </svg>
                            <p>QR Code<br>TKT-001-2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-600 mb-4 font-mono bg-gray-50 p-2 rounded break-all">QR-TKT001-2025-ABCD1234</p>

            <div class="flex space-x-2">
                <button onclick="downloadQrCode()" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Download
                </button>
                <button onclick="closeQrCode()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(status) {
    const notes = document.getElementById('notesTextarea').value;

    if (confirm(`Apakah Anda yakin ingin mengubah status penumpang menjadi "${status}"?`)) {
        // Simulate API call
        alert(`Status berhasil diubah ke: ${status.toUpperCase()}`);
        // In real implementation, you would make an AJAX call here
        // location.reload();
    }
}

function saveNotes() {
    const notes = document.getElementById('notesTextarea').value;
    if (notes.trim()) {
        alert('Catatan berhasil disimpan');
        // In real implementation, make AJAX call to save notes
    } else {
        alert('Catatan kosong');
    }
}

function showQrCode() {
    document.getElementById('qrCodeModal').classList.remove('hidden');
}

function closeQrCode() {
    document.getElementById('qrCodeModal').classList.add('hidden');
}

function downloadQrCode() {
    alert('QR Code akan didownload');
    // In real implementation, generate and download QR code
}

function printTicket() {
    if (confirm('Apakah Anda ingin mencetak tiket penumpang?')) {
        alert('Tiket akan dicetak');
        // In real implementation, open print dialog or generate PDF
        window.print();
    }
}

// Auto-save notes every 30 seconds
setInterval(function() {
    const notes = document.getElementById('notesTextarea').value;
    if (notes.trim()) {
        // Auto-save notes silently
        console.log('Auto-saving notes...');
    }
}, 30000);
</script>
@endsection
