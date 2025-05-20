@extends('layouts.admin')

@section('title', 'Boat & Tiket')

@section('header', 'Manajemen Boat & Tiket')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800">Daftar Kapal</h3>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Tambah Kapal
                </button>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="Boat">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Ocean Explorer</div>
                                            <div class="text-sm text-gray-500">#BT001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Fast Boat</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">50 penumpang</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                        <button class="text-red-600 hover:text-red-900">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="Boat">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Island Hopper</div>
                                            <div class="text-sm text-gray-500">#BT002</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Fast Boat</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">30 penumpang</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                        <button class="text-red-600 hover:text-red-900">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="Boat">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Sea Voyager</div>
                                            <div class="text-sm text-gray-500">#BT003</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Luxury Boat</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">25 penumpang</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Maintenance
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                        <button class="text-red-600 hover:text-red-900">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Informasi Tiket</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-blue-800">Tiket Terjual Hari Ini</h4>
                        <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <p class="text-2xl font-bold text-blue-800">87</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-green-800">Pendapatan Hari Ini</h4>
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+8%</span>
                    </div>
                    <p class="text-2xl font-bold text-green-800">Rp 4,350,000</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-sm font-medium text-purple-800">Tiket Tersedia</h4>
                        <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">105</span>
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
    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
        <div>
            <p class="text-sm font-medium text-gray-800">Sanur → Nusa Penida</p>
            <p class="text-xs text-gray-500">Fast Boat</p>
        </div>
        <p class="text-sm font-medium text-gray-800">Rp 175,000</p>
    </div>
    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
        <div>
            <p class="text-sm font-medium text-gray-800">Sanur → Nusa Ceningan</p>
            <p class="text-xs text-gray-500">Fast Boat</p>
        </div>
        <p class="text-sm font-medium text-gray-800">Rp 185,000</p>
    </div>
    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
        <div>
            <p class="text-sm font-medium text-gray-800">Sanur → Nusa Lembongan</p>
            <p class="text-xs text-gray-500">Fast Boat</p>
        </div>
        <p class="text-sm font-medium text-gray-800">Rp 165,000</p>
    </div>
    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
        <div>
            <p class="text-sm font-medium text-gray-800">Sanur → Gili Trawangan</p>
            <p class="text-xs text-gray-500">Luxury Boat</p>
        </div>
        <p class="text-sm font-medium text-gray-800">Rp 350,000</p>
    </div>
</div>
                <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Kelola Harga Tiket
                </button>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-800">Penjualan Tiket</h3>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-md">Minggu Ini</button>
            <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Bulan Ini</button>
            <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md">Tahun Ini</button>
        </div>
    </div>
    <div class="p-6">
        <div class="h-80">
            <!-- Chart would go here - using a placeholder -->
            <div class="w-full h-full flex items-end space-x-2">
                @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $index => $day)
                    @php
                        $heights = [60, 75, 45, 80, 65, 90, 70];
                        $height = $heights[$index];
                    @endphp
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-blue-500 rounded-t" style="height: {{ $height }}%"></div>
                        <div class="text-xs text-gray-500 mt-2">{{ $day }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                <p class="text-2xl font-bold text-gray-800">Rp 28,750,000</p>
                <p class="text-sm text-green-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    15.3% dari minggu lalu
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-gray-500">Tiket Terjual</p>
                <p class="text-2xl font-bold text-gray-800">575</p>
                <p class="text-sm text-green-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    12.8% dari minggu lalu
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-gray-500">Rata-rata Harga</p>
                <p class="text-2xl font-bold text-gray-800">Rp 250,000</p>
                <p class="text-sm text-green-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    2.5% dari minggu lalu
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
