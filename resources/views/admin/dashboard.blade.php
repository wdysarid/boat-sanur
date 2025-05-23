@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="text-sm text-gray-500">
                {{ now()->format('d F Y') }}
            </span>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"></path>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                        <h3 class="text-2xl font-semibold text-gray-800" id="total-sales-amount">Rp 12,345,678</h3>
                        <p class="text-xs text-muted-foreground flex items-center">
                            <span id="total-sales-trend">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span id="total-sales-percentage" class="text-green-500">11.01%</span> dari bulan lalu
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other summary cards with similar styling -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                        <h3 class="text-2xl font-semibold text-gray-800">1,234</h3>
                        <p class="text-xs text-muted-foreground flex items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="text-green-500">8.5%</span> dari bulan lalu
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 0-3-3-9-3s-9 3-9 3"></path>
                            <path d="M3 10v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M12 7v6"></path>
                            <path d="M12 13l-3-3"></path>
                            <path d="M12 13l3-3"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Kapal</p>
                        <h3 class="text-2xl font-semibold text-gray-800">12</h3>
                        <p class="text-xs text-muted-foreground flex items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="text-green-500">2 kapal</span> baru bulan ini
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Destinasi</p>
                        <h3 class="text-2xl font-semibold text-gray-800">8</h3>
                        <p class="text-xs text-muted-foreground flex items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="text-green-500">1 destinasi</span> baru bulan ini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
        <div class="col-span-4 card">
            <div class="card-header">
                <h3 class="card-title">Penjualan Bulanan</h3>
                <div class="flex items-center space-x-2">
                    <button class="text-xs text-gray-500 hover:text-primary">Lihat Detail</button>
                </div>
            </div>
            <div class="card-body">
                <div class="h-[300px] sales-chart-container">
                    <div class="flex h-full items-end gap-2">
                        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $index => $month)
                            @php
                                $heights = [40, 90, 50, 70, 45, 50, 70, 30, 50, 80, 60, 30];
                                $height = $heights[$index];
                            @endphp
                            <div class="chart-bar bg-primary rounded-md w-full" style="height: {{ $height }}%"></div>
                        @endforeach
                    </div>
                    <div class="flex justify-between mt-2 text-xs text-gray-500">
                        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                            <div class="chart-label">{{ $month }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-3 card">
            <div class="card-header">
                <h3 class="card-title">Target Bulanan</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-xs text-gray-500">Mei 2025</span>
                </div>
            </div>
            <div class="card-body">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium">Penjualan Tiket</div>
                            <div class="text-sm font-medium">75%</div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium">Pendapatan</div>
                            <div class="text-sm font-medium">68%</div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 68%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium">Pelanggan Baru</div>
                            <div class="text-sm font-medium">82%</div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 82%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium">Rating</div>
                            <div class="text-sm font-medium">92%</div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 92%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-sm font-medium text-gray-500 mb-1">Target Pendapatan</div>
                        <div class="text-xl font-semibold text-gray-800">Rp 50,000,000</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-sm font-medium text-gray-500 mb-1">Pendapatan Saat Ini</div>
                        <div class="text-xl font-semibold text-primary">Rp 34,250,000</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    @vite('resources/js/dashboard.js')
@endpush
