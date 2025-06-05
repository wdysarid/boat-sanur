<?php

namespace App\Http\Controllers\Api;

use App\Models\Tiket;
use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $jadwal = Jadwal::find($request->jadwal_id);

        // Check schedule availability
        if ($jadwal->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak tersedia untuk pemesanan'
            ], 400);
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

            return response()->json([
                'success' => true,
                'data' => $tiket,
                'message' => 'Tiket berhasil dipesan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memesan tiket: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's tickets
     */
    public function getTiketSaya(Request $request)
    {
        $tickets = Tiket::with(['jadwal.kapal'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }

    /**
     * Get ticket details
     */
    public function getTiketDetail(Request $request, $id)
    {
        $tiket = Tiket::with(['jadwal.kapal', 'pembayaran'])
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$tiket) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan atau tidak memiliki akses'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tiket
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
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan atau tidak memiliki akses'
            ], 404);
        }

        if ($tiket->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak dapat dibatalkan karena status bukan menunggu'
            ], 400);
        }

        $tiket->update(['status' => 'dibatalkan']);

        return response()->json([
            'success' => true,
            'message' => 'Tiket berhasil dibatalkan'
        ]);
    }
}
