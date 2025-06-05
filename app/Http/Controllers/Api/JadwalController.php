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
        $jadwal = Jadwal::with('kapal')->get();

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    }

    /**
     * Get schedule details by ID
     */
    public function getJadwalById($id)
    {
        $jadwal = Jadwal::with(['kapal', 'tiket'])->find($id);

        if (!$jadwal) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan',
                ],
                404,
            );
        }

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
            'rute' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_berangkat' => 'required|date',
            'waktu_tiba' => 'required|date|after:waktu_berangkat',
            'harga_tiket' => 'required|integer|min:0',
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

        // Check if the ship already has a schedule at the same time
        $existingSchedule = Jadwal::where('kapal_id', $request->kapal_id)->where('waktu_berangkat', '<=', $request->waktu_tiba)->where('waktu_tiba', '>=', $request->waktu_berangkat)->exists();

        if ($existingSchedule) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Kapal sudah memiliki jadwal pada waktu tersebut',
                ],
                400,
            );
        }

        $jadwal = Jadwal::create([
            'kapal_id' => $request->kapal_id,
            'rute' => $request->rute,
            'tanggal' => $request->tanggal,
            'waktu_berangkat' => $request->waktu_berangkat,
            'waktu_tiba' => $request->waktu_tiba,
            'harga_tiket' => $request->harga_tiket,
            'status' => 'aktif',
        ]);

        return response()->json(
            [
                'success' => true,
                'data' => $jadwal,
                'message' => 'Jadwal berhasil ditambahkan',
            ],
            201,
        );
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
            'rute' => 'sometimes|string|max:255',
            'tanggal' => 'sometimes|date',
            'waktu_berangkat' => 'sometimes|date',
            'waktu_tiba' => 'sometimes|date|after:waktu_berangkat',
            'harga_tiket' => 'sometimes|integer|min:0',
            'status' => 'sometimes|in:aktif,selesai',
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
        if ($request->has('waktu_berangkat') || $request->has('waktu_tiba')) {
            $waktuBerangkat = $request->waktu_berangkat ?? $jadwal->waktu_berangkat;
            $waktuTiba = $request->waktu_tiba ?? $jadwal->waktu_tiba;
            $kapalId = $request->kapal_id ?? $jadwal->kapal_id;

            $existingSchedule = Jadwal::where('kapal_id', $kapalId)->where('id', '!=', $id)->where('waktu_berangkat', '<=', $waktuTiba)->where('waktu_tiba', '>=', $waktuBerangkat)->exists();

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

        $jadwal->fill($request->only(['kapal_id', 'rute', 'tanggal', 'waktu_berangkat', 'waktu_tiba', 'harga_tiket', 'status']));

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
