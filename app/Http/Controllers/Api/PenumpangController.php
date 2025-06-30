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
     * FIXED: Get all passengers with filters (for admin) - Fixed filtering issues
     */
    public function getAllPenumpang(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search' => 'nullable|string|max:255',
                'status' => 'nullable|in:booked,checked_in,cancelled', // SIMPLIFIED: Only 3 statuses
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

            // FIXED: Improved query with proper eager loading
            $query = Penumpang::with([
                'tiket' => function ($q) {
                    $q->select('id', 'kode_pemesanan', 'jadwal_id', 'user_id', 'status', 'jumlah_penumpang', 'total_harga');
                },
                'tiket.jadwal' => function ($q) {
                    $q->select('id', 'rute_asal', 'rute_tujuan', 'tanggal', 'waktu_berangkat', 'kapal_id');
                },
                'tiket.jadwal.kapal' => function ($q) {
                    $q->select('id', 'nama_kapal');
                },
                'user' => function ($q) {
                    $q->select('id', 'nama', 'email');
                },
            ]);

            // FIXED: Apply filters with proper null checks
            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('no_identitas', 'like', "%{$search}%")
                        ->orWhereHas('tiket', function ($subQ) use ($search) {
                            $subQ->where('kode_pemesanan', 'like', "%{$search}%");
                        });
                });
            }

            if ($request->filled('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            if ($request->filled('jadwal_id')) {
                $query->whereHas('tiket', function ($q) use ($request) {
                    $q->where('jadwal_id', $request->jadwal_id);
                });
            }

            if ($request->filled('date')) {
                $query->whereHas('tiket.jadwal', function ($q) use ($request) {
                    $q->whereDate('tanggal', $request->date);
                });
            }

            // FIXED: Pagination with proper error handling
            $perPage = 15;
            $penumpang = $query->orderBy('created_at', 'desc')->paginate($perPage);

            // SIMPLIFIED: Stats calculation for only 3 statuses
            $stats = [
                'total' => Penumpang::count(),
                'booked' => Penumpang::where('status', 'booked')->count(),
                'checked_in' => Penumpang::where('status', 'checked_in')->count(),
                'cancelled' => Penumpang::where('status', 'cancelled')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $penumpang,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading passengers data: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memuat data penumpang: ' . $e->getMessage(),
                    'error' => config('app.debug') ? $e->getMessage() : null,
                ],
                500,
            );
        }
    }

    /**
     * IMPROVED: Check-in passenger by QR code or ID with toast notification support
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
                $tiket = Tiket::find($request->tiket_id);
            } else {
                $qrCode = $request->qr_code;
                $kodePemesanan = $qrCode;

                // If no TKT- prefix, add it
                if (strpos($qrCode, 'TKT-') !== 0) {
                    $kodePemesanan = 'TKT-' . $qrCode;
                }

                Log::info('Searching ticket by QR code', [
                    'original_qr' => $qrCode,
                    'search_code' => $kodePemesanan,
                ]);

                $tiket = Tiket::where('kode_pemesanan', $kodePemesanan)->first();
            }

            if (!$tiket) {
                Log::warning('Ticket not found for check-in', [
                    'qr_code' => $request->qr_code ?? null,
                    'tiket_id' => $request->tiket_id ?? null,
                ]);

                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tiket tidak ditemukan atau kode QR tidak valid',
                    ],
                    404,
                );
            }

            // Check if ticket is cancelled
            if ($tiket->status === 'dibatalkan') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tiket telah dibatalkan dan tidak dapat di-check-in',
                ], 400);
            }

            DB::beginTransaction();

            // Update passenger status from booked to checked_in only
            $updated = Penumpang::where('tiket_id', $tiket->id)
                ->where('status', 'booked')
                ->update([
                    'status' => 'checked_in',
                    'checked_in_at' => now(),
                ]);

            if ($updated === 0) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada penumpang yang dapat di-check-in. Mungkin sudah check-in sebelumnya.',
                ], 400);
            }

            DB::commit();

            Log::info('Passenger check-in successful', [
                'ticket_id' => $tiket->id,
                'booking_code' => $tiket->kode_pemesanan,
                'passengers_updated' => $updated,
            ]);

            return response()->json([
                'success' => true,
                'message' => "Berhasil check-in {$updated} penumpang untuk tiket {$tiket->kode_pemesanan}",
                'data' => [
                    'tiket_id' => $tiket->id,
                    'kode_pemesanan' => $tiket->kode_pemesanan,
                    'passengers_checked_in' => $updated,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Check-in error', [
                'error' => $e->getMessage(),
                'qr_code' => $request->qr_code ?? null,
                'tiket_id' => $request->tiket_id ?? null,
            ]);

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

    /**
     * NEW: Auto-cancel passengers when ticket and payment are cancelled
     */
    public function autoCancelPassengers($tiketId)
    {
        try {
            $tiket = Tiket::with('pembayaran')->find($tiketId);

            if (!$tiket) {
                return false;
            }

            // Check if both ticket and payment are cancelled
            $ticketCancelled = $tiket->status === 'dibatalkan';
            $paymentCancelled = $tiket->pembayaran && $tiket->pembayaran->status === 'dibatalkan';

            if ($ticketCancelled && $paymentCancelled) {
                // Update all passengers for this ticket to cancelled
                $updated = Penumpang::where('tiket_id', $tiketId)
                    ->whereIn('status', ['booked', 'checked_in'])
                    ->update([
                        'status' => 'cancelled',
                        'updated_at' => now(),
                    ]);

                Log::info('Auto-cancelled passengers', [
                    'tiket_id' => $tiketId,
                    'passengers_cancelled' => $updated,
                ]);

                return $updated;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Error auto-cancelling passengers', [
                'tiket_id' => $tiketId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
