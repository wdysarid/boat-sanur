<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    /**
     * Get all schedules
     */
    public function getJadwal()
    {
        $jadwal = Jadwal::with(['kapal', 'tiket' => function($query) {
            $query->where('status', 'sukses');
        }])->get();

        return response()->json([
            'success' => true,
            'data' => $jadwal->map(function($item) {
                $item->tiket_terjual = $item->tiket->sum('jumlah_penumpang');
                return $item;
            })
        ]);
    }

    /**
     * Get schedule details by ID
     */
    public function getJadwalById($id)
    {
        $jadwal = Jadwal::with(['kapal', 'tiket' => function($query) {
            $query->where('status', 'sukses');
        }])->find($id);

        if (!$jadwal) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan',
                ],
                404,
            );
        }

        $jadwal->tiket_terjual = $jadwal->tiket->sum('jumlah_penumpang');

        return response()->json([
            'success' => true,
            'data' => $jadwal,
        ]);
    }

    /**
     * Create new schedule
     */
    public function tambahJadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kapal_id' => 'required|string|exists:kapal,id',
            'rute_asal' => 'required|string|max:255',
            'rute_tujuan' => 'required|string|max:255|different:rute_asal',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_berangkat' => 'required|date_format:H:i',
            'waktu_tiba' => 'required|date_format:H:i|after:waktu_berangkat',
            'harga_tiket' => 'required|integer|min:1000',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        try {
            $jadwal = Jadwal::create([
                'kapal_id' => $request->kapal_id,
                'rute_asal' => $request->rute_asal,
                'rute_tujuan' => $request->rute_tujuan,
                'tanggal' => $request->tanggal,
                'waktu_berangkat' => $request->waktu_berangkat,
                'waktu_tiba' => $request->waktu_tiba,
                'harga_tiket' => $request->harga_tiket,
                'keterangan' => $request->keterangan,
                'status' => 'aktif',
            ]);

            return response()->json([
                'success' => true,
                'data' => $jadwal,
                'message' => 'Jadwal berhasil ditambahkan'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'error_details' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Update schedule
     */
    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan',
                ],
                404,
            );
        }

        $validator = Validator::make($request->all(), [
            'kapal_id' => 'sometimes|string|exists:kapal,id',
            'rute_asal' => 'sometimes|string|max:255',
            'rute_tujuan' => 'sometimes|string|max:255|different:rute_asal',
            'tanggal' => 'sometimes|date|after_or_equal:today',
            'waktu_berangkat' => 'sometimes|date_format:H:i',
            'waktu_tiba' => 'sometimes|date_format:H:i|after:waktu_berangkat',
            'harga_tiket' => 'sometimes|integer|min:1000',
            'keterangan' => 'nullable|string',
            'status' => 'sometimes|in:aktif,selesai,dibatalkan',
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

        // Check if there are tickets when trying to change ship
        if ($request->has('kapal_id') && $request->kapal_id != $jadwal->kapal_id) {
            if ($jadwal->tiket()->where('status', 'sukses')->exists()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tidak dapat mengubah kapal karena sudah ada tiket yang terjual',
                    ],
                    400,
                );
            }

            $kapal = Kapal::find($request->kapal_id);
            if (!$kapal || $kapal->status !== 'aktif') {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Kapal tidak tersedia atau tidak aktif',
                    ],
                    400,
                );
            }
        }

        // Check for schedule conflicts if changing time
        if ($request->has('waktu_berangkat') || $request->has('waktu_tiba') || $request->has('tanggal')) {
            $waktuBerangkat = $request->waktu_berangkat ?? $jadwal->waktu_berangkat;
            $waktuTiba = $request->waktu_tiba ?? $jadwal->waktu_tiba;
            $tanggal = $request->tanggal ?? $jadwal->tanggal;
            $kapalId = $request->kapal_id ?? $jadwal->kapal_id;

            $existingSchedule = Jadwal::where('kapal_id', $kapalId)
                ->where('id', '!=', $id)
                ->whereDate('tanggal', $tanggal)
                ->where(function($query) use ($waktuBerangkat, $waktuTiba) {
                    $query->whereBetween('waktu_berangkat', [$waktuBerangkat, $waktuTiba])
                          ->orWhereBetween('waktu_tiba', [$waktuBerangkat, $waktuTiba])
                          ->orWhere(function($q) use ($waktuBerangkat, $waktuTiba) {
                              $q->where('waktu_berangkat', '<=', $waktuBerangkat)
                                ->where('waktu_tiba', '>=', $waktuTiba);
                          });
                })
                ->exists();

            if ($existingSchedule) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Kapal sudah memiliki jadwal pada waktu tersebut',
                    ],
                    400,
                );
            }
        }

        $jadwal->fill($request->only([
            'kapal_id',
            'rute_asal',
            'rute_tujuan',
            'tanggal',
            'waktu_berangkat',
            'waktu_tiba',
            'harga_tiket',
            'keterangan',
            'status'
        ]));

        $jadwal->save();

        return response()->json([
            'success' => true,
            'data' => $jadwal,
            'message' => 'Jadwal berhasil diperbarui',
        ]);
    }

    /**
     * Delete schedule
     */
    public function deleteJadwal($id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan',
                ],
                404,
            );
        }

        // Check if there are any tickets associated with this schedule
        if ($jadwal->tiket()->exists()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tidak dapat menghapus jadwal karena sudah ada tiket yang terkait',
                ],
                400,
            );
        }

        $jadwal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus',
        ]);
    }
}
