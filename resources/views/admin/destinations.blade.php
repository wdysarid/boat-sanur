@extends('layouts.admin')

@section('title', 'Destination')

@section('header', 'Manajemen Destinasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800">Daftar Destinasi</h3>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Tambah Destinasi
                </button>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destinasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rute Tersedia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Bali">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Bali</div>
                                            <div class="text-sm text-gray-500">#DST001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Denpasar, Indonesia</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">5 rute</div>
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
                                            <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Lombok">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Lombok</div>
                                            <div class="text-sm text-gray-500">#DST002</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Mataram, Indonesia</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">4 rute</div>
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
                                            <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Gili Trawangan">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Gili Trawangan</div>
                                            <div class="text-sm text-gray-500">#DST003</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Lombok Utara, Indonesia</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">3 rute</div>
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
                                            <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/40" alt="Nusa Penida">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Nusa Penida</div>
                                            <div class="text-sm text-gray-500">#DST004</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Klungkung, Bali, Indonesia</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">2 rute</div>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Detail Destinasi</h3>
        </div>
        <div class="p-6">
            <div class="mb-6">
                <img src="https://via.placeholder.com/400x200" alt="Bali" class="w-full h-40 object-cover rounded-lg">
            </div>
            <div class="space-y-4">
                <div>
                    <h4 class="text-lg font-medium text-gray-800">Bali</h4>
                    <p class="text-sm text-gray-500">Denpasar, Indonesia</p>
                </div>
                <p class="text-sm text-gray-600">
                    Bali adalah sebuah pulau di Indonesia yang dikenal karena memiliki pegunungan berapi yang hijau, terasering sawah yang unik, pantai, dan terumbu karang yang cantik. Terdapat banyak tempat wisata religi seperti Pura Uluwatu yang berdiri di atas tebing.
                </p>
                <div>
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Rute Tersedia</h5>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded-md">
                            <div class="text-sm">Sanur → Nusa Penida</div>
                            <div class="text-xs text-gray-500">45 menit</div>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded-md">
                            <div class="text-sm">Sanur → Nusa Ceningan</div>
                            <div class="text-xs text-gray-500">50 menit</div>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded-md">
                            <div class="text-sm">Sanur → Nusa Lembongan</div>
                            <div class="text-xs text-gray-500">40 menit</div>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-gray-50 rounded-md">
                            <div class="text-sm">Sanur → Gili Trawangan</div>
                            <div class="text-xs text-gray-500">2.5 jam</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Statistik</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="text-xs text-blue-600 mb-1">Total Perjalanan</div>
                            <div class="text-lg font-semibold text-blue-800">245</div>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <div class="text-xs text-green-600 mb-1">Tiket Terjual</div>
                            <div class="text-lg font-semibold text-green-800">1,245</div>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <div class="text-xs text-purple-600 mb-1">Rating</div>
                            <div class="text-lg font-semibold text-purple-800">4.8/5</div>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <div class="text-xs text-yellow-600 mb-1">Pendapatan</div>
                            <div class="text-lg font-semibold text-yellow-800">Rp 62.2jt</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex space-x-3">
                <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Edit Destinasi
                </button>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-800">Rute Perjalanan</h3>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Tambah Rute
        </button>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rute</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jarak</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RT001</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Sanur → Nusa Penida</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">45 menit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20 km</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 175,000</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RT002</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Sanur → Nusa Ceningan</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">50 menit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">22 km</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 185,000</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RT003</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Sanur → Nusa Lembongan</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">40 menit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">18 km</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 165,000</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RT004</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Sanur → Gili Trawangan</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2.5 jam</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">85 km</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 350,000</td>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
