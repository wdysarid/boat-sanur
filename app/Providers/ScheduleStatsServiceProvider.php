<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tiket;
use App\Models\Kapal;
use App\Models\Jadwal;
use App\Models\Pembayaran;
use Carbon\Carbon;

class ScheduleStatsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('admin.schedule', function ($view) {
            $view->with([
                'ticketsSoldToday' => $this->getTicketsSoldToday(),
                'revenueToday' => $this->getRevenueToday(),
                'activeSchedules' => $this->getActiveSchedules(),
                'capacityFilled' => $this->getCapacityFilled(),
                'weeklySales' => $this->getWeeklySalesData(),
            ]);
        });
    }

    private function getTicketsSoldToday()
    {
        return Tiket::whereDate('created_at', today())
            ->where('status', 'sukses')
            ->sum('jumlah_penumpang');
    }

    private function getRevenueToday()
    {
        return Pembayaran::where('status', 'terverifikasi')
            ->whereDate('created_at', today())
            ->sum('jumlah_bayar');
    }

    private function getActiveSchedules()
    {
        return Jadwal::where('status', 'aktif')
            ->whereDate('tanggal', '>=', today())
            ->count();
    }

    private function getCapacityFilled()
    {
        $totalCapacity = Kapal::sum('kapasitas');
        $totalSold = Tiket::whereHas('jadwal', function($q) {
                $q->where('status', 'aktif')
                  ->whereDate('tanggal', '>=', today());
            })
            ->where('status', 'sukses')
            ->sum('jumlah_penumpang');

        return $totalCapacity > 0 ? round(($totalSold / $totalCapacity) * 100) : 0;
    }

    private function getWeeklySalesData()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        // Data penjualan minggu ini
        $currentWeekSales = Tiket::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 'sukses')
            ->selectRaw('DAYOFWEEK(created_at) as day, SUM(jumlah_penumpang) as tickets, SUM(total_harga) as revenue')
            ->groupBy('day')
            ->get()
            ->keyBy('day');

        // Data penjualan minggu lalu
        $lastWeekStart = now()->subWeek()->startOfWeek();
        $lastWeekEnd = now()->subWeek()->endOfWeek();

        $lastWeekSales = Tiket::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->where('status', 'sukses')
            ->selectRaw('SUM(jumlah_penumpang) as tickets, SUM(total_harga) as revenue')
            ->first();

        // Format data untuk chart - PERBAIKAN: Pastikan urutan hari sesuai
        $daysOrder = [
            1 => ['name' => 'Min', 'sales' => 0],
            2 => ['name' => 'Sen', 'sales' => 0],
            3 => ['name' => 'Sel', 'sales' => 0],
            4 => ['name' => 'Rab', 'sales' => 0],
            5 => ['name' => 'Kam', 'sales' => 0],
            6 => ['name' => 'Jum', 'sales' => 0],
            7 => ['name' => 'Sab', 'sales' => 0]
        ];

        // Isi data aktual
        foreach ($currentWeekSales as $day) {
            $daysOrder[$day->day]['sales'] = $day->revenue;
        }

        // Hitung nilai maksimum untuk scaling
        $maxValue = max(array_column($daysOrder, 'sales')) ?: 1;

        // Format untuk view
        $weeklyData = [];
        foreach ($daysOrder as $day) {
            $weeklyData[] = [
                'day' => $day['name'],
                'revenue' => $day['sales'],
                'percentage' => round(($day['sales'] / $maxValue) * 100)
            ];
        }

        // Hitung total dan pertumbuhan
        $currentWeekTotal = $currentWeekSales->sum('revenue');
        $lastWeekTotal = $lastWeekSales ? $lastWeekSales->revenue : 0;
        $growth = $lastWeekTotal > 0 ? round((($currentWeekTotal - $lastWeekTotal) / $lastWeekTotal) * 100) : ($currentWeekTotal > 0 ? 100 : 0);

        $currentWeekTickets = $currentWeekSales->sum('tickets');
        $lastWeekTickets = $lastWeekSales ? $lastWeekSales->tickets : 0;
        $ticketsGrowth = $lastWeekTickets > 0 ? round((($currentWeekTickets - $lastWeekTickets) / $lastWeekTickets) * 100) : ($currentWeekTickets > 0 ? 100 : 0);

        return [
            'days' => $weeklyData,
            'total' => $currentWeekTotal,
            'growth' => $growth,
            'tickets' => $currentWeekTickets,
            'tickets_growth' => $ticketsGrowth
        ];
    }
}
