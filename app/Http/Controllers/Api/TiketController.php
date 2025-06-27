<?php

namespace App\Http\Controllers\Api;

use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{
    /**
     * Create new ticket
     */
    // Di dalam TiketController.php, modifikasi method pesanTiket:

    public function pesanTiket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jadwal_id' => 'required|exists:jadwal,id',
            'jumlah_penumpang' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        $user = $request->user();
        $jadwal = Jadwal::find($request->jadwal_id);

        // Check schedule availability
        if ($jadwal->status !== 'aktif') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Jadwal tidak tersedia untuk pemesanan',
                ],
                400,
            );
        }

        // Check available seats
        if ($jadwal->available_seats < $request->jumlah_penumpang) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Kapasitas tidak mencukupi. Kursi tersedia: ' . $jadwal->available_seats,
                ],
                400,
            );
        }

        // Calculate total price
        $totalHarga = $jadwal->harga_tiket * $request->jumlah_penumpang;

        try {
            $tiket = Tiket::create([
                'user_id' => $user->id,
                'jadwal_id' => $request->jadwal_id,
                'kode_pemesanan' => 'TKT-' . Str::upper(Str::random(8)),
                'jumlah_penumpang' => $request->jumlah_penumpang,
                'total_harga' => $totalHarga,
                'status' => 'menunggu',
            ]);

            return response()->json(
                [
                    'success' => true,
                    'data' => $tiket,
                    'message' => 'Tiket berhasil dipesan',
                ],
                201,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memesan tiket: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Get user's tickets
     */
    // public function getTiketSaya(Request $request)
    // {
    //     $tickets = Tiket::with(['jadwal.kapal'])
    //         ->where('user_id', $request->user()->id)
    //         ->latest()
    //         ->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $tickets,
    //     ]);
    // }

    /**
     * Get ticket details
     */
    // public function getTiketDetail(Request $request, $id)
    // {
    //     $tiket = Tiket::with(['jadwal.kapal', 'pembayaran'])
    //         ->where('id', $id)
    //         ->where('user_id', $request->user()->id)
    //         ->first();

    //     if (!$tiket) {
    //         return response()->json(
    //             [
    //                 'success' => false,
    //                 'message' => 'Tiket tidak ditemukan atau tidak memiliki akses',
    //             ],
    //             404,
    //         );
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => $tiket,
    //     ]);
    // }

    /**
     * Cancel ticket
     */
    public function batalkanTiket(Request $request, $id)
    {
        $tiket = Tiket::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$tiket) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak ditemukan atau tidak memiliki akses',
                ],
                404,
            );
        }

        if ($tiket->status !== 'menunggu') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak dapat dibatalkan karena status bukan menunggu',
                ],
                400,
            );
        }

        $tiket->update(['status' => 'dibatalkan']);

        return response()->json([
            'success' => true,
            'message' => 'Tiket berhasil dibatalkan',
        ]);
    }

    // TiketController.php

    public function getTiketByStatus(Request $request)
    {
        $status = $request->query('status', 'all');
        $user = $request->user();

        $query = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])->where('user_id', $user->id);

        switch ($status) {
            case 'upcoming':
                $query->where('status', Tiket::STATUS_SUKSES)->whereHas('jadwal', function ($q) {
                    $q->where('tanggal', '>=', now()->format('Y-m-d'));
                });
                break;
            case 'pending':
                $query->where(function ($q) {
                    $q->where('status', Tiket::STATUS_DIPROSES)->orWhere(function ($q2) {
                        $q2->where('status', Tiket::STATUS_SUKSES)->whereHas('pembayaran', function ($q3) {
                            $q3->where('status', Pembayaran::STATUS_MENUNGGU);
                        });
                    });
                });
                break;
            case 'completed':
                $query->where('status', Tiket::STATUS_SUKSES)->whereHas('jadwal', function ($q) {
                    $q->where('tanggal', '<', now()->format('Y-m-d'));
                });
                break;
            default:
                $query->whereIn('status', [Tiket::STATUS_MENUNGGU, Tiket::STATUS_DIPROSES, Tiket::STATUS_SUKSES]);
        }

        $tickets = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $tickets,
            'stats' => $this->getTicketStats($user->id),
        ]);
    }

    private function getTicketStats($userId)
    {
        $totalTickets = Tiket::where('user_id', $userId)->count();

        $upcomingTickets = Tiket::where('user_id', $userId)
            ->where('status', Tiket::STATUS_SUKSES)
            ->whereHas('jadwal', function ($q) {
                $q->where('tanggal', '>=', now()->format('Y-m-d'));
            })
            ->count();

        $pendingTickets = Tiket::where('user_id', $userId)
            ->where(function ($q) {
                $q->where('status', Tiket::STATUS_DIPROSES)->orWhere(function ($q2) {
                    $q2->where('status', Tiket::STATUS_SUKSES)->whereHas('pembayaran', function ($q3) {
                        $q3->where('status', Pembayaran::STATUS_MENUNGGU);
                    });
                });
            })
            ->count();

        $completedTickets = Tiket::where('user_id', $userId)
            ->where('status', Tiket::STATUS_SUKSES)
            ->whereHas('jadwal', function ($q) {
                $q->where('tanggal', '<', now()->format('Y-m-d'));
            })
            ->count();

        return [
            'total' => $totalTickets,
            'upcoming' => $upcomingTickets,
            'pending' => $pendingTickets,
            'completed' => $completedTickets,
        ];
    }
}
