@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('header', 'Verifikasi Pembayaran')

@section('content')
<div class="bg-white rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-800">Daftar Pembayaran</h3>
        <div class="flex space-x-2">
            <div class="relative">
                <input type="text" class="pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Cari pembayaran...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <button class="p-2 text-gray-500 hover:text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-md">Semua</button>
                <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Menunggu</button>
                <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Diverifikasi</button>
                <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Ditolak</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pembayaran</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiket</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#PAY001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="John Doe">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">john@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Sanur → Nusa Penida</div>
                            <div class="text-sm text-gray-500">2 tiket</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 500,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Transfer Bank</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Mei 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Verifikasi</button>
                                <button class="text-red-600 hover:text-red-900">Tolak</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#PAY002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Jane+Smith&background=0D8ABC&color=fff" alt="Jane Smith">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                    <div class="text-sm text-gray-500">jane@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Lombok → Gili Trawangan</div>
                            <div class="text-sm text-gray-500">4 tiket</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 700,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">E-Wallet</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">19 Mei 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Diverifikasi
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Lihat</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#PAY003</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Robert+Johnson&background=0D8ABC&color=fff" alt="Robert Johnson">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Robert Johnson</div>
                                    <div class="text-sm text-gray-500">robert@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Bali → Nusa Penida</div>
                            <div class="text-sm text-gray-500">1 tiket</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 350,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kartu Kredit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18 Mei 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Lihat</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari <span class="font-medium">15</span> pembayaran
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Sebelumnya</button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm bg-blue-50 text-blue-600">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">3</button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Detail Pembayaran #PAY001</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Pelanggan</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Nama</span>
                            <span class="text-sm text-gray-900">John Doe</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Email</span>
                            <span class="text-sm text-gray-900">john@example.com</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Telepon</span>
                            <span class="text-sm text-gray-900">+62 812 3456 7890</span>
                        </div>
                    </div>

                    <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Informasi Tiket</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Rute</span>
                            <span class="text-sm text-gray-900">Sanur → Nusa Penida</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Kapal</span>
                            <span class="text-sm text-gray-900">Ocean Explorer</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                            <span class="text-sm text-gray-900">20 Mei 2025, 08:00</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Jumlah Tiket</span>
                            <span class="text-sm text-gray-900">2 tiket</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-4">Informasi Pembayaran</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">ID Pembayaran</span>
                            <span class="text-sm text-gray-900">#PAY001</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Metode</span>
                            <span class="text-sm text-gray-900">Transfer Bank</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Bank</span>
                            <span class="text-sm text-gray-900">BCA</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Tanggal</span>
                            <span class="text-sm text-gray-900">20 Mei 2025, 10:15</span>
                        </div>
                        <div class="flex">
                            <span class="text-sm font-medium text-gray-500 w-32">Status</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                        </div>
                    </div>

                    <h4 class="text-sm font-medium text-gray-500 mt-6 mb-4">Rincian Biaya</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Tiket (2 x Rp 250,000)</span>
                            <span class="text-sm text-gray-900">Rp 500,000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Biaya Layanan</span>
                            <span class="text-sm text-gray-900">Rp 10,000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Diskon</span>
                            <span class="text-sm text-green-600">- Rp 10,000</span>
                        </div>
                        <div class="pt-2 border-t border-gray-200 flex justify-between">
                            <span class="text-sm font-medium text-gray-900">Total</span>
                            <span class="text-sm font-medium text-gray-900">Rp 500,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Tolak
            </button>
            <button class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Verifikasi Pembayaran
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Bukti Pembayaran</h3>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <img src="https://via.placeholder.com/400x500" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg">
            </div>
            <div class="flex justify-center">
                <button class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Unduh Bukti Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
