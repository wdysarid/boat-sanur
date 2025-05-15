@extends('admin.layouts.main')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg">Total Pengguna</h2>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>
        <!-- Tambahkan statistik lainnya -->
    </div>
@endsection
