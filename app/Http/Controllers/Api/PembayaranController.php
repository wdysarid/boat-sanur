<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function uploadBuktiBayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tiket_id' => 'required|exists:tiket,id',
            'metode_bayar' => 'required|string|in:transfer,qris',
            'jumlah_bayar' => 'required|numeric|min:1',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        $tiket = Tiket::where('id', $request->tiket_id)->where('user_id', $user->id)->first();

        if (!$tiket || $tiket->status !== 'menunggu') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak valid untuk pembayaran',
                ],
                400,
            );
        }

        try {
            $file = $request->file('bukti_transfer');
            $fileName = 'payment_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/bukti_pembayaran', $fileName);

            $pembayaran = Pembayaran::create([
                'tiket_id' => $tiket->id,
                'metode_bayar' => $request->metode_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'bukti_transfer' => 'bukti_pembayaran/' . $fileName,
                'status' => 'menunggu',
                'expires_at' => now()->addMinutes(15), // Tambahkan waktu kadaluarsa
            ]);

            return response()->json(
                [
                    'success' => true,
                    'data' => $pembayaran,
                    'message' => 'Bukti pembayaran berhasil diunggah',
                ],
                201,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal mengunggah bukti pembayaran',
                ],
                500,
            );
        }
    }

    public function getRiwayatPembayaran(Request $request)
    {
        $pembayarans = Pembayaran::with(['tiket.jadwal.kapal'])
            ->whereHas('tiket', fn($q) => $q->where('user_id', $request->user()->id))
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pembayarans,
        ]);
    }

    public function getDetailPembayaran(Request $request, $id)
    {
        $pembayaran = Pembayaran::with(['tiket.jadwal.kapal'])
            ->whereHas('tiket', fn($q) => $q->where('user_id', $request->user()->id))
            ->find($id);

        if (!$pembayaran) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Pembayaran tidak ditemukan',
                ],
                404,
            );
        }

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:terverifikasi,ditolak',
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

        $pembayaran = Pembayaran::with('tiket')->find($id);

        if (!$pembayaran) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Pembayaran tidak ditemukan',
                ],
                404,
            );
        }

        if ($pembayaran->status !== 'menunggu') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses sebelumnya',
                ],
                400,
            );
        }

        DB::transaction(function () use ($pembayaran, $request) {
            $pembayaran->update(['status' => $request->status]);

            if ($request->status === 'terverifikasi') {
                $pembayaran->tiket()->update(['status' => 'sukses']);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran diperbarui',
        ]);
    }

    public function cancelPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tiket_id' => 'required|exists:tiket,id',
            'reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        DB::beginTransaction();
        try {
            $tiket = Tiket::find($request->tiket_id);

            // Verifikasi kepemilikan tiket
            if ($tiket->user_id !== auth()->id()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Anda tidak memiliki akses ke tiket ini',
                    ],
                    403,
                );
            }

            // Update status tiket dan pembayaran
            $tiket->update(['status' => 'dibatalkan']);

            $pembayaran = $tiket->pembayaran()->where('status', 'menunggu')->first();
            if ($pembayaran) {
                $pembayaran->update([
                    'status' => 'dibatalkan',
                    'expires_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dibatalkan',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function checkPaymentStatus(Request $request)
    {
        $user = $request->user();

        // Cari pembayaran aktif
        $activePembayaran = Pembayaran::with(['tiket.jadwal'])
            ->whereHas('tiket', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'menunggu');
            })
            ->where('status', 'menunggu')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$activePembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pembayaran aktif',
                'hasActivePayment' => false,
            ]);
        }

        $remainingSeconds = max(0, now()->diffInSeconds($activePembayaran->expires_at, false));

        return response()->json([
            'success' => true,
            'hasActivePayment' => true,
            'data' => [
                'tiket_id' => $activePembayaran->tiket_id,
                'remaining_seconds' => $remainingSeconds,
                'expires_at' => $activePembayaran->expires_at,
            ],
        ]);
    }
}
