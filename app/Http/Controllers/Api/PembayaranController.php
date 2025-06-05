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
            'metode_bayar' => 'required|string|in:transfer,bank,cash',
            'jumlah_bayar' => 'required|numeric|min:1',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $tiket = Tiket::where('id', $request->tiket_id)
                    ->where('user_id', $user->id)
                    ->first();

        if (!$tiket || $tiket->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak valid untuk pembayaran'
            ], 400);
        }

        try {
            $file = $request->file('bukti_transfer');
            $fileName = 'payment_'.time().'_'.$user->id.'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('public/bukti_pembayaran', $fileName);

            $pembayaran = Pembayaran::create([
                'tiket_id' => $tiket->id,
                'metode_bayar' => $request->metode_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'bukti_transfer' => 'bukti_pembayaran/'.$fileName,
                'status' => 'menunggu',
            ]);

            return response()->json([
                'success' => true,
                'data' => $pembayaran,
                'message' => 'Bukti pembayaran berhasil diunggah'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah bukti pembayaran'
            ], 500);
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
            'data' => $pembayarans
        ]);
    }

    // Get payment details (unchanged)
    public function getDetailPembayaran(Request $request, $id)
    {
        $pembayaran = Pembayaran::with(['tiket.jadwal.kapal'])
            ->whereHas('tiket', fn($q) => $q->where('user_id', $request->user()->id))
            ->find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pembayaran
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:terverifikasi,ditolak'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $pembayaran = Pembayaran::with('tiket')->find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        if ($pembayaran->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran sudah diproses sebelumnya'
            ], 400);
        }

        DB::transaction(function () use ($pembayaran, $request) {
            $pembayaran->update(['status' => $request->status]);

            if ($request->status === 'terverifikasi') {
                $pembayaran->tiket()->update(['status' => 'sukses']);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran diperbarui'
        ]);
    }
}
