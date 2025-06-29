<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Mail\EtiketMail;
use Illuminate\Support\Facades\Mail;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

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
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Simpan file ke storage/public/bukti_pembayaran
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');

            if (!$path) {
                throw new \Exception('Gagal menyimpan bukti transfer');
            }

            $pembayaran = Pembayaran::create([
                'tiket_id' => $tiket->id,
                'metode_bayar' => $request->metode_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'bukti_transfer' => $path,
                'status' => 'menunggu',
                'expires_at' => now()->addMinutes(15),
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

    public function getPaymentDetail($id)
    {
        try {
            $payment = Pembayaran::with(['tiket.jadwal.kapal', 'tiket.penumpang', 'user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $payment,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Pembayaran tidak ditemukan',
                ],
                404,
            );
        }
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

        try {
            $pembayaran = Pembayaran::with('tiket.user')->find($id);

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
                // Update status pembayaran
                $pembayaran->update(['status' => $request->status]);

                if ($request->status === 'terverifikasi') {
                    // Update status tiket
                    $pembayaran->tiket()->update(['status' => Tiket::STATUS_SUKSES]);

                    // PERBAIKAN: Generate QR Code sederhana menggunakan service yang sudah diperbaiki
                    try {
                        $qrCodePath = $this->qrCodeService->generateTicketQrCode($pembayaran->tiket);

                        Log::info('Simple QR Code generated successfully', [
                            'ticket_id' => $pembayaran->tiket->id,
                            'booking_code' => $pembayaran->tiket->kode_pemesanan,
                            'qr_path' => $qrCodePath,
                        ]);
                    } catch (\Exception $qrError) {
                        Log::error('Simple QR Code generation failed', [
                            'ticket_id' => $pembayaran->tiket->id,
                            'error' => $qrError->getMessage(),
                        ]);
                        // Continue without failing the verification
                    }

                    // Kirim email e-tiket secara asynchronous
                    $this->sendEtiketEmail($pembayaran->tiket);
                } elseif ($request->status === 'ditolak') {
                    $pembayaran->tiket()->update(['status' => Tiket::STATUS_DIBATALKAN]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diperbarui',
                'data' => [
                    'payment_id' => $pembayaran->id,
                    'new_status' => $request->status,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Error verifying payment', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui status pembayaran: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * PERBAIKAN: Send e-ticket email dengan QR Code sederhana
     */
    private function sendEtiketEmail($tiket)
    {
        try {
            // PERBAIKAN: Generate QR Code data sederhana untuk email - hanya kode pemesanan
            $qrData = $tiket->kode_pemesanan; // Format: "TKT-ABC123"

            $qrCodeImage = $this->qrCodeService->generateQrCode($qrData, 200);

            // Kirim email
            Mail::to($tiket->user->email)->send(new EtiketMail($tiket, $qrCodeImage));

            Log::info('E-ticket email sent successfully with simple QR', [
                'ticket_id' => $tiket->id,
                'booking_code' => $tiket->kode_pemesanan,
                'user_email' => $tiket->user->email,
                'qr_data' => $qrData,
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending e-ticket email', [
                'ticket_id' => $tiket->id,
                'error' => $e->getMessage(),
            ]);
            // Jangan throw error, biarkan proses verifikasi tetap berhasil
        }
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

        // Cari pembayaran aktif yang belum selesai
        $activePembayaran = Pembayaran::with(['tiket.jadwal'])
            ->whereHas('tiket', function ($query) use ($user) {
                $query->where('user_id', $user->id)->whereIn('status', [Tiket::STATUS_MENUNGGU, Tiket::STATUS_DIPROSES]);
            })
            ->whereIn('status', [Pembayaran::STATUS_MENUNGGU])
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
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
                'tiket_status' => $activePembayaran->tiket->status,
                'payment_status' => $activePembayaran->status,
                'remaining_seconds' => $remainingSeconds,
                'expires_at' => $activePembayaran->expires_at,
            ],
        ]);
    }
}
