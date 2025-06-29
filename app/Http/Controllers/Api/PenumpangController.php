<?php

namespace App\Http\Controllers\Api;

use App\Models\Tiket;
use App\Models\Penumpang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PenumpangController extends Controller
{
    /**
     * Menyimpan data penumpang untuk tiket tertentu
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'tiket_id' => 'required|exists:tiket,id',
                    'penumpang' => 'required|array|min:1',
                    'penumpang.*.nama_lengkap' => 'required|string|max:255',
                    'penumpang.*.no_identitas' => 'required|string|max:50',
                    'penumpang.*.usia' => 'required|integer|min:1|max:120',
                    'penumpang.*.jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
                    'penumpang.*.is_pemesan' => 'sometimes|boolean',
                ],
                [
                    'tiket_id.required' => 'ID tiket wajib diisi',
                    'tiket_id.exists' => 'Tiket tidak ditemukan',
                    'penumpang.required' => 'Data penumpang wajib diisi',
                    'penumpang.*.nama_lengkap.required' => 'Nama lengkap penumpang wajib diisi',
                    'penumpang.*.no_identitas.required' => 'Nomor identitas penumpang wajib diisi',
                    'penumpang.*.usia.required' => 'Usia penumpang wajib diisi',
                    'penumpang.*.usia.min' => 'Usia minimal 1 tahun',
                    'penumpang.*.usia.max' => 'Usia maksimal 120 tahun',
                    'penumpang.*.jenis_kelamin.required' => 'Jenis kelamin penumpang wajib dipilih',
                    'penumpang.*.jenis_kelamin.in' => 'Jenis kelamin tidak valid',
                ],
            );

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

            // Cek kepemilikan tiket
            $tiket = Tiket::find($request->tiket_id);

            if (!$tiket) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak ditemukan',
                    ],
                    404,
                );
            }

            // Jika user terautentikasi, cek kepemilikan
            if (auth()->check() && $tiket->user_id !== auth()->id()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Anda tidak memiliki akses ke tiket ini',
                    ],
                    403,
                );
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
                    'user_id' => $p['is_pemesan'] ?? $index === 0 ? $tiket->user_id : null,
                    'nama_lengkap' => $p['nama_lengkap'],
                    'no_identitas' => $p['no_identitas'],
                    'usia' => $p['usia'],
                    'jenis_kelamin' => $p['jenis_kelamin'],
                    'is_pemesan' => $p['is_pemesan'] ?? $index === 0,
                    'status' => 'booked', // Set default status
                    'created_at' => now(),
                    'updated_at' => now(),
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
                'data' => Penumpang::where('tiket_id', $request->tiket_id)->get(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                    'trace' => config('app.debug') ? $e->getTrace() : null,
                ],
                500,
            );
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
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Anda tidak memiliki akses ke tiket ini',
                    ],
                    403,
                );
            }

            $penumpang = Penumpang::where('tiket_id', $tiket_id)->get();

            return response()->json([
                'success' => true,
                'data' => $penumpang,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak ditemukan',
                ],
                404,
            );
        }
    }

    /**
     * Get all passengers with filters (for admin)
     */
    public function getAllPenumpang(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search' => 'nullable|string',
                'status' => 'nullable|in:booked,checked_in,boarded,completed,cancelled',
                'jadwal_id' => 'nullable|exists:jadwal,id',
                'date' => 'nullable|date',
                'page' => 'nullable|integer|min:1',
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

            $query = Penumpang::with(['tiket.jadwal.kapal', 'user'])
                ->select('penumpang.*')
                ->join('tiket', 'tiket.id', '=', 'penumpang.tiket_id')
                ->join('jadwal', 'jadwal.id', '=', 'tiket.jadwal_id');

            // Apply filters
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('penumpang.nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('penumpang.no_identitas', 'like', "%{$search}%")
                        ->orWhere('tiket.kode_pemesanan', 'like', "%{$search}%");
                });
            }

            if ($request->has('status') && $request->status !== 'all' && !empty($request->status)) {
                $query->where('penumpang.status', $request->status);
            }

            if ($request->has('jadwal_id') && !empty($request->jadwal_id)) {
                $query->where('tiket.jadwal_id', $request->jadwal_id);
            }

            if ($request->has('date') && !empty($request->date)) {
                $query->whereDate('jadwal.tanggal', $request->date);
            }

            // Pagination
            $perPage = 15;
            $penumpang = $query->orderBy('penumpang.created_at', 'desc')->paginate($perPage);

            // Get stats for dashboard
            $stats = [
                'total' => Penumpang::count(),
                'booked' => Penumpang::where('status', 'booked')->count(),
                'checked_in' => Penumpang::where('status', 'checked_in')->count(),
                'boarded' => Penumpang::where('status', 'boarded')->count(),
                'completed' => Penumpang::where('status', 'completed')->count(),
                'cancelled' => Penumpang::where('status', 'cancelled')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $penumpang,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat data penumpang',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Check-in passenger by QR code or ID
     */
    public function checkInPenumpang(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'tiket_id' => 'required_without:qr_code|exists:tiket,id',
            'qr_code' => 'required_without:tiket_id|string',
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

        // Find ticket by ID or QR code
        if ($request->has('tiket_id')) {
            $tiket = Tiket::with(['jadwal', 'penumpang'])->find($request->tiket_id);
        } else {
            $qrCode = $request->qr_code;

            // Try to find by booking code directly if not JSON
            if (strpos($qrCode, 'TKT-') === 0) {
                $kodePemesanan = $qrCode;
            } else {
                $kodePemesanan = 'TKT-' . $qrCode;
            }

            $tiket = Tiket::with(['jadwal', 'penumpang'])
                ->where('kode_pemesanan', $kodePemesanan)
                ->first();
        }

        if (!$tiket) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tiket tidak ditemukan',
                ],
                404,
            );
        }

        DB::beginTransaction();

        // Update all passengers in this ticket
        $updated = Penumpang::where('tiket_id', $tiket->id)
            ->where('status', 'booked')
            ->update([
                'status' => 'checked_in',
                'checked_in_at' => now(),
            ]);

        if ($updated === 0) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Penumpang sudah check-in sebelumnya atau tidak ditemukan',
                ],
                400,
            );
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Penumpang berhasil check-in',
            'data' => [
                'tiket' => $tiket->load('penumpang'),
                'passengers_checked_in' => $updated,
            ],
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(
            [
                'success' => false,
                'message' => 'Gagal melakukan check-in: ' . $e->getMessage(),
            ],
            500,
        );
    }
}

    /**
     * Get passenger detail
     */
    public function getDetailPenumpang($id)
    {
        try {
            $penumpang = Penumpang::with(['tiket.jadwal.kapal', 'tiket.pembayaran', 'user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $penumpang,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Penumpang tidak ditemukan',
                ],
                404,
            );
        }
    }
}
