@extends('layouts.admin')

@section('title', 'Jadwal')

@section('header', 'Jadwal Perjalanan')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Main Schedule Table - Full width -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h3 class="text-lg font-medium text-gray-800">Jadwal Perjalanan</h3>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                Tambah Jadwal
            </button>
        </div>
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div class="flex flex-wrap gap-2">
                    <button class="px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-md font-medium transition-colors">Semua</button>
                    <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Aktif</button>
                    <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Selesai</button>
                    <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Dibatalkan</button>
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <div class="relative flex-grow">
                        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Cari jadwal...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <button class="p-2 text-gray-500 hover:text-gray-600 hover:bg-gray-100 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rute</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#SCH001</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover shadow-sm" src="https://via.placeholder.com/40" alt="Boat">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Ocean Explorer</div>
                                        <div class="text-sm text-gray-500">Fast Boat</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Sanur → Nusa Penida</div>
                                <div class="text-sm text-gray-500">45 menit perjalanan</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">20 Mei 2025</div>
                                <div class="text-sm text-gray-500">08:00 - 08:45</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">45/50</div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 90%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-900 transition-colors">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#SCH002</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover shadow-sm" src="https://via.placeholder.com/40" alt="Boat">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Island Hopper</div>
                                        <div class="text-sm text-gray-500">Fast Boat</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Sanur → Nusa Ceningan</div>
                                <div class="text-sm text-gray-500">50 menit perjalanan</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">21 Mei 2025</div>
                                <div class="text-sm text-gray-500">09:30 - 10:20</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">28/30</div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 93%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-900 transition-colors">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#SCH003</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover shadow-sm" src="https://via.placeholder.com/40" alt="Boat">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Sea Voyager</div>
                                        <div class="text-sm text-gray-500">Luxury Boat</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Sanur → Gili Trawangan</div>
                                <div class="text-sm text-gray-500">2.5 jam perjalanan</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">19 Mei 2025</div>
                                <div class="text-sm text-gray-500">10:00 - 12:30</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">25/25</div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Selesai
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-900 transition-colors">Lihat</button>
                                    <button class="text-gray-600 hover:text-gray-900 transition-colors">Arsip</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700 order-2 sm:order-1">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari <span class="font-medium">12</span> jadwal
                </div>
                <div class="flex space-x-1 order-1 sm:order-2">
                    <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Sebelumnya</button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm bg-blue-50 text-blue-600 font-medium">1</button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">2</button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">3</button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom section with Ticket Information and Sales side by side -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Ticket Information Card -->
        <div class="bg-white rounded-lg shadow h-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Informasi Tiket</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg transition-transform hover:scale-[1.02]">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-sm font-medium text-blue-800">Tiket Terjual Hari Ini</h4>
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2.5 py-1 rounded-full">+12%</span>
                        </div>
                        <p class="text-2xl font-bold text-blue-800">87</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg transition-transform hover:scale-[1.02]">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-sm font-medium text-green-800">Pendapatan Hari Ini</h4>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2.5 py-1 rounded-full">+8%</span>
                        </div>
                        <p class="text-2xl font-bold text-green-800">Rp 4,350,000</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg transition-transform hover:scale-[1.02]">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-sm font-medium text-purple-800">Tiket Tersedia</h4>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2.5 py-1 rounded-full">105</span>
                        </div>
                        <div class="w-full bg-purple-200 rounded-full h-2.5 mb-2">
                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="text-xs text-purple-800">65% kapasitas terisi</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Harga Tiket</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Sanur → Nusa Penida</p>
                                <p class="text-xs text-gray-500">Fast Boat</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp 175,000</p>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Sanur → Nusa Ceningan</p>
                                <p class="text-xs text-gray-500">Fast Boat</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp 185,000</p>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Sanur → Nusa Lembongan</p>
                                <p class="text-xs text-gray-500">Fast Boat</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp 165,000</p>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Sanur → Gili Trawangan</p>
                                <p class="text-xs text-gray-500">Luxury Boat</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp 350,000</p>
                        </div>
                    </div>
                    <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Kelola Harga Tiket
                    </button>
                </div>
            </div>
        </div>

        <!-- Sales Chart Card -->
        <div class="bg-white rounded-lg shadow h-full">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-lg font-medium text-gray-800">Penjualan Tiket</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-md font-medium transition-colors">Minggu Ini</button>
                    <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Bulan Ini</button>
                    <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 rounded-md transition-colors">Tahun Ini</button>
                </div>
            </div>
            <div class="p-6">
                <div class="h-60">
                    <!-- Chart would go here - using a placeholder -->
                    <div class="w-full h-full flex items-end space-x-1">
                        @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $index => $day)
                            @php
                                $heights = [60, 75, 45, 80, 65, 90, 70];
                                $height = $heights[$index];
                            @endphp
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-blue-500 hover:bg-blue-600 transition-colors rounded-t" style="height: {{ $height }}%"></div>
                                <div class="text-xs text-gray-500 mt-2">{{ $day }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                        <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 28,750,000</p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            15.3% dari minggu lalu
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                        <p class="text-sm font-medium text-gray-500">Tiket Terjual</p>
                        <p class="text-2xl font-bold text-gray-800">575</p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            12.8% dari minggu lalu
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors">
                        <p class="text-sm font-medium text-gray-500">Rata-rata Harga</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 250,000</p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                            </svg>
                            2.5% dari minggu lalu
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
