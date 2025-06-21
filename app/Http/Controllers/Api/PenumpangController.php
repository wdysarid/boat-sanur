<?php

namespace App\Http\Controllers\Api;

use App\Models\Tiket;
use App\Models\Penumpang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PenumpangController extends Controller
{
    /**
     * Menyimpan data penumpang untuk tiket tertentu
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tiket_id' => 'required|exists:tiket,id',
                'penumpang' => 'required|array|min:1',
                'penumpang.*.nama_lengkap' => 'required|string|max:255',
                'penumpang.*.no_identitas' => 'required|string|max:50',
                'penumpang.*.usia' => 'required|integer|min:1|max:120',
                'penumpang.*.jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
                'penumpang.*.is_pemesan' => 'sometimes|boolean'
            ], [
                'tiket_id.required' => 'ID tiket wajib diisi',
                'tiket_id.exists' => 'Tiket tidak ditemukan',
                'penumpang.required' => 'Data penumpang wajib diisi',
                'penumpang.*.nama_lengkap.required' => 'Nama lengkap penumpang wajib diisi',
                'penumpang.*.no_identitas.required' => 'Nomor identitas penumpang wajib diisi',
                'penumpang.*.usia.required' => 'Usia penumpang wajib diisi',
                'penumpang.*.usia.min' => 'Usia minimal 1 tahun',
                'penumpang.*.usia.max' => 'Usia maksimal 120 tahun',
                'penumpang.*.jenis_kelamin.required' => 'Jenis kelamin penumpang wajib dipilih',
                'penumpang.*.jenis_kelamin.in' => 'Jenis kelamin tidak valid'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Cek kepemilikan tiket
            $tiket = Tiket::find($request->tiket_id);

            if (!$tiket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tiket tidak ditemukan'
                ], 404);
            }

            // Jika user terautentikasi, cek kepemilikan
            if (auth()->check() && $tiket->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke tiket ini'
                ], 403);
            }

            // Gunakan transaction untuk memastikan data konsisten
            DB::beginTransaction();

            // Hapus penumpang lama jika ada (untuk update)
            Penumpang::where('tiket_id', $request->tiket_id)->delete();

            // Simpan penumpang baru
            $penumpangData = [];
            foreach ($request->penumpang as $index => $p) {
                $penumpangData[] = [
                    'tiket_id' => $request->tiket_id,
                    'user_id' => $p['is_pemesan'] ?? ($index === 0) ? $tiket->user_id : null,
                    'nama_lengkap' => $p['nama_lengkap'],
                    'no_identitas' => $p['no_identitas'],
                    'usia' => $p['usia'],
                    'jenis_kelamin' => $p['jenis_kelamin'],
                    'is_pemesan' => $p['is_pemesan'] ?? ($index === 0),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            Penumpang::insert($penumpangData);

            // Update status tiket jika perlu
            if ($tiket->status === 'draft') {
                $tiket->update(['status' => 'pending_payment']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penumpang berhasil disimpan',
                'data' => Penumpang::where('tiket_id', $request->tiket_id)->get()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
    }

    /**
     * Mendapatkan data penumpang berdasarkan tiket_id
     */
    public function show($tiket_id)
    {
        try {
            $tiket = Tiket::findOrFail($tiket_id);

            // Jika user terautentikasi, cek kepemilikan
            if (auth()->check() && $tiket->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke tiket ini'
                ], 403);
            }

            $penumpang = Penumpang::where('tiket_id', $tiket_id)->get();

            return response()->json([
                'success' => true,
                'data' => $penumpang
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan'
            ], 404);
        }
    }
}
