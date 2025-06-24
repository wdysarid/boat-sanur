@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h class="text-2xl font-bold text-gray-900">Dashboard</h>
        <p class="text-gray-600">{{ now()->format('d F Y') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-900">Rp 12.5M</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Penumpang</p>
                    <p class="text-2xl font-bold text-gray-900">1,234</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Jadwal Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 bg-orange-100 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 0-3-3-9-3s-9 3-9 3"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Kapal Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">6/12</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Aktivitas Hari Ini -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Hari Ini</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600">45</div>
                        <p class="text-sm text-gray-500">Penumpang Hari Ini</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">23</div>
                        <p class="text-sm text-gray-500">Booking Baru</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600">Rp 850K</div>
                        <p class="text-sm text-gray-500">Pendapatan Hari Ini</p>
                    </div>
                </div>

                <!-- Status Penumpang -->
                <div class="mt-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Status Penumpang</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-600">Completed</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">28</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-600">Boarded</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                <span class="text-sm text-gray-600">Checked In</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">5</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Cepat -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Menu Cepat</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.passengers') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-blue-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Kelola Penumpang</span>
                </a>

                <a href="{{ route('admin.schedule') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Jadwal & Tiket</span>
                </a>

                <a href="{{ route('admin.boats') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-purple-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 0-3-3-9-3s-9 3-9 3"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Kelola Kapal</span>
                </a>

                <a href="{{ route('admin.payments') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-orange-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Verifikasi Pembayaran</span>
                </a>

                <a href="{{ route('admin.feedback') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-gray-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Feedback</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Waktu</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Rute</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Kapal</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Penumpang</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">08:00</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Sanur - Nusa Penida</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Fast Boat 1</td>
                            <td class="py-3 px-4 text-sm text-gray-900">45/50</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Berangkat
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">09:30</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Sanur - Nusa Lembongan</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Ocean Star</td>
                            <td class="py-3 px-4 text-sm text-gray-900">32/40</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Boarding
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">11:00</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Nusa Penida - Sanur</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Island Express</td>
                            <td class="py-3 px-4 text-sm text-gray-900">28/50</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-900">14:00</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Sanur - Gili Trawangan</td>
                            <td class="py-3 px-4 text-sm text-gray-900">Gili Express</td>
                            <td class="py-3 px-4 text-sm text-gray-900">15/35</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Terjadwal
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
