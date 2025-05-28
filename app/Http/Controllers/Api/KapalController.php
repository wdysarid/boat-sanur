<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class KapalController extends Controller
{
    /**
     * Get all kapal
     */
    public function getKapal()
    {
        try {
            $kapal = Kapal::orderBy('nama_kapal', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data kapal berhasil diambil',
                'data' => $kapal
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting kapal: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kapal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kapal by ID
     */
    public function getKapalById($id)
    {
        try {
            $kapal = Kapal::find($id);

            if (!$kapal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kapal tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data kapal berhasil diambil',
                'data' => $kapal
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting kapal by ID: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kapal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add new kapal
     */
    public function tambahKapal(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|string|max:10|unique:kapal,id',
                'nama_kapal' => 'required|string|max:255',
                'kapasitas' => 'required|integer|min:1|max:100',
                'status' => 'required|string|in:aktif,maintenance,tidak aktif',
                'deskripsi' => 'nullable|string|max:1000',
                'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['id', 'nama_kapal', 'kapasitas', 'status', 'deskripsi']);

            // Handle file upload
            if ($request->hasFile('foto_kapal')) {
                $file = $request->file('foto_kapal');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('foto_kapal', $filename, 'public');
                $data['foto_kapal'] = $path;
            }

            $kapal = Kapal::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Kapal berhasil ditambahkan',
                'data' => $kapal
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error adding kapal: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan kapal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update kapal
     */
    public function updateKapal(Request $request, $id)
    {
        try {
            $kapal = Kapal::find($id);

            if (!$kapal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kapal tidak ditemukan'
                ], 404);
            }

            // Handle multipart form data for PUT request
            if ($request->isMethod('put') && $request->hasFile('foto_kapal')) {
                // For PUT requests with files, we need to handle it differently
                $request->setMethod('POST');
                $request->merge(['_method' => 'PUT']);
            }

            $validator = Validator::make($request->all(), [
                'id' => 'required|string|max:10|unique:kapal,id,' . $kapal->id . ',id',
                'nama_kapal' => 'required|string|max:255',
                'kapasitas' => 'required|integer|min:1|max:100',
                'status' => 'required|string|in:aktif,maintenance,tidak aktif',
                'deskripsi' => 'nullable|string|max:1000',
                'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only(['id', 'nama_kapal', 'kapasitas', 'status', 'deskripsi']);

            // Handle file upload
            if ($request->hasFile('foto_kapal')) {
                // Delete old image if exists
                if ($kapal->foto_kapal && Storage::disk('public')->exists($kapal->foto_kapal)) {
                    Storage::disk('public')->delete($kapal->foto_kapal);
                }

                $file = $request->file('foto_kapal');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('foto_kapal', $filename, 'public');
                $data['foto_kapal'] = $path;
            }

            $kapal->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Kapal berhasil diupdate',
                'data' => $kapal->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating kapal: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate kapal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete kapal
     */
    public function deleteKapal($id)
    {
        try {
            $kapal = Kapal::find($id);

            if (!$kapal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kapal tidak ditemukan'
                ], 404);
            }

            // Delete image if exists
            if ($kapal->foto_kapal && Storage::disk('public')->exists($kapal->foto_kapal)) {
                Storage::disk('public')->delete($kapal->foto_kapal);
            }

            $kapal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kapal berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting kapal: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kapal',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
