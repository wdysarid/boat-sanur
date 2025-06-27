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
    public function getTiketSaya(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $tickets = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }

    /**
     * Get ticket details - PERBAIKAN: Tambahkan bukti_transfer_url
     */
    public function getTiketDetail(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // PERBAIKAN: Pastikan hanya bisa melihat tiket milik sendiri
        $tiket = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
            ->where('id', $id)
            ->where('user_id', auth()->id()) // PENTING: Filter berdasarkan user yang login
            ->first();

        if (!$tiket) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak ditemukan atau Anda tidak memiliki akses',
                ],
                404,
            );
        }

        // PERBAIKAN: Tambahkan URL bukti transfer jika ada
        if ($tiket->pembayaran && $tiket->pembayaran->bukti_transfer) {
            $tiket->pembayaran->bukti_transfer_url = asset('storage/' . $tiket->pembayaran->bukti_transfer);
        }

        return response()->json([
            'success' => true,
            'data' => $tiket,
        ]);
    }

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

    public function getTiketByStatus(Request $request, $status)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $userId = auth()->id();

            // PERBAIKAN: Selalu mulai dengan filter user_id untuk keamanan
            $query = Tiket::with(['jadwal.kapal', 'pembayaran', 'penumpang'])
                ->where('user_id', $userId);

            switch ($status) {
                case 'upcoming':
                    $query->where('status', 'sukses')
                        ->whereHas('pembayaran', function ($q) {
                            $q->where('status', 'terverifikasi');
                        })
                        ->whereHas('jadwal', function ($q) {
                            $q->where('tanggal', '>=', now()->format('Y-m-d'));
                        });
                    break;

                case 'pending':
                    $query->where(function ($q) {
                    // PERBAIKAN: Tiket menunggu/diproses ATAU tiket sukses dengan pembayaran menunggu
                    $q->where('status', 'diproses')
                        ->orWhere('status', 'menunggu')
                        ->orWhere(function ($q2) {
                            $q2->where('status', 'sukses')
                                ->whereHas('pembayaran', function ($q3) {
                                    $q3->where('status', 'menunggu');
                                });
                        });
                });
                    break;

                case 'completed':
                    $query->where(function ($q) {
                        // Tiket sukses yang sudah lewat tanggalnya
                        $q->where(function ($q2) {
                            $q2->where('status', 'sukses')
                                ->whereHas('pembayaran', function ($q3) {
                                    $q3->where('status', 'terverifikasi');
                                })
                                ->whereHas('jadwal', function ($q4) {
                                    $q4->where('tanggal', '<', now()->format('Y-m-d'));
                                });
                        })
                        // Atau tiket yang dibatalkan/ditolak
                        ->orWhere('status', 'dibatalkan')
                        ->orWhereHas('pembayaran', function ($q5) {
                            $q5->where('status', 'ditolak');
                        });
                    });
                    break;

                default: // 'all'
                    // PERBAIKAN: Tampilkan semua tiket termasuk yang dibatalkan
                    // Tidak perlu filter tambahan karena sudah difilter berdasarkan user_id
                    break;
            }

            $tickets = $query->orderBy('created_at', 'desc')->get();

            // Hitung statistik untuk user ini
            $stats = $this->getTicketStats($userId);

            return response()->json([
                'success' => true,
                'data' => $tickets,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat data tiket',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    private function getTicketStats($userId)
    {
        $allTickets = Tiket::with(['jadwal', 'pembayaran'])
            ->where('user_id', $userId)
            ->get();

        $total = $allTickets->count();
        $upcoming = 0;
        $pending = 0;
        $completed = 0;

        foreach ($allTickets as $ticket) {
            // PERBAIKAN: Logika yang lebih jelas untuk pending
            if (in_array($ticket->status, ['menunggu', 'diproses'])) {
                $pending++;
            } elseif ($ticket->status === 'sukses' && $ticket->pembayaran && $ticket->pembayaran->status === 'terverifikasi') {
                $ticketDate = \Carbon\Carbon::parse($ticket->jadwal->tanggal);
                if ($ticketDate->gte(now()->startOfDay())) {
                    $upcoming++;
                } else {
                    $completed++;
                }
            } elseif ($ticket->status === 'dibatalkan' || ($ticket->pembayaran && $ticket->pembayaran->status === 'ditolak')) {
                $completed++;
            }
        }

        return [
            'total' => $total,
            'upcoming' => $upcoming,
            'pending' => $pending,
            'completed' => $completed,
        ];
    }
}
