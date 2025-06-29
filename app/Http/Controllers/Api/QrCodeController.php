<?php

namespace App\Http\Controllers\Api;

use App\Models\Tiket;
use Illuminate\Http\Request;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QrCodeController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * FIXED: Generate QR Code sederhana untuk admin
     */
    public function generateQrCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // FIXED: Generate QR Code sederhana langsung dari data
            $qrData = $request->data;

            // Normalisasi format - pastikan ada prefix TKT-
            if (!str_starts_with($qrData, 'TKT-') && preg_match('/^[A-Z0-9]+$/', $qrData)) {
                $qrData = 'TKT-' . $qrData;
            }

            Log::info('Generating simple QR Code via API', [
                'original_data' => $request->data,
                'normalized_data' => $qrData
            ]);

            // Generate QR Code sebagai data URI
            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            return response($qrCodeDataUri)
                ->header('Content-Type', 'image/png')
                ->header('Cache-Control', 'public, max-age=3600');

        } catch (\Exception $e) {
            Log::error('Error generating QR Code via API', [
                'data' => $request->data,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal generate QR Code: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * FIXED: Generate QR Code untuk tiket tertentu
     */
    public function generateTicketQrCode($ticketId)
    {
        try {
            $ticket = Tiket::findOrFail($ticketId);

            // FIXED: Generate QR Code sederhana
            $qrData = $ticket->kode_pemesanan; // Format: "TKT-ABC123"

            Log::info('Generating ticket QR Code via API', [
                'ticket_id' => $ticketId,
                'booking_code' => $qrData
            ]);

            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            return response($qrCodeDataUri)
                ->header('Content-Type', 'image/png')
                ->header('Cache-Control', 'public, max-age=3600');

        } catch (\Exception $e) {
            Log::error('Error generating ticket QR Code via API', [
                'ticket_id' => $ticketId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal generate QR Code tiket: ' . $e->getMessage()
            ], 500);
        }
    }
}
