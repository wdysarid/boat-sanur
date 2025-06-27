<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Tiket;

class QrCodeService
{
    /**
     * Generate QR Code untuk tiket
     */
    public function generateTicketQrCode(Tiket $tiket): string
    {
        try {
            // Data yang akan di-encode dalam QR Code
            $qrData = json_encode([
                'ticket_id' => $tiket->id,
                'booking_code' => $tiket->kode_pemesanan,
                'user_id' => $tiket->user_id,
                'schedule_id' => $tiket->jadwal_id,
                'date' => $tiket->jadwal->tanggal,
                'departure_time' => $tiket->jadwal->waktu_berangkat,
                'route' => $tiket->jadwal->rute_asal . ' - ' . $tiket->jadwal->rute_tujuan,
                'passengers' => $tiket->jumlah_penumpang,
                'generated_at' => now()->toISOString()
            ]);

            // PERBAIKAN: Gunakan konstanta enum yang benar
            $builder = new Builder(
                writer: new PngWriter(),
                writerOptions: [],
                validateResult: false,
                data: $qrData,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin
            );

            $result = $builder->build();

            // Simpan ke storage
            $filename = 'qr_codes/ticket_' . $tiket->kode_pemesanan . '_' . time() . '.png';
            Storage::disk('public')->put($filename, $result->getString());

            // Update tiket dengan path QR code
            $tiket->update([
                'qr_code_path' => $filename,
                'qr_generated_at' => now()
            ]);

            Log::info('QR Code generated successfully', [
                'ticket_id' => $tiket->id,
                'filename' => $filename
            ]);

            return $filename;

        } catch (\Exception $e) {
            Log::error('Error generating QR Code for ticket', [
                'ticket_id' => $tiket->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Generate QR Code untuk data tertentu (untuk modal)
     */
    public function generateQrCode(string $data, int $size = 300): string
    {
        try {
            $builder = new Builder(
                writer: new PngWriter(),
                writerOptions: [],
                validateResult: false,
                data: $data,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: $size,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin
            );

            $result = $builder->build();

            return $result->getDataUri();

        } catch (\Exception $e) {
            Log::error('Error generating QR Code', [
                'data_length' => strlen($data),
                'error' => $e->getMessage()
            ]);

            // Return placeholder jika gagal
            return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
        }
    }

    /**
     * Get QR Code URL untuk tiket
     */
    public function getTicketQrCodeUrl(Tiket $tiket): ?string
    {
        if (!$tiket->qr_code_path) {
            return null;
        }

        return asset('storage/' . $tiket->qr_code_path);
    }

    /**
     * Regenerate QR Code jika diperlukan
     */
    public function regenerateIfNeeded(Tiket $tiket): string
    {
        try {
            // Regenerate jika belum ada atau sudah lebih dari 24 jam
            if (!$tiket->qr_code_path ||
                !$tiket->qr_generated_at ||
                $tiket->qr_generated_at->diffInHours(now()) > 24) {

                return $this->generateTicketQrCode($tiket);
            }

            return $tiket->qr_code_path;

        } catch (\Exception $e) {
            Log::error('Error regenerating QR Code', [
                'ticket_id' => $tiket->id,
                'error' => $e->getMessage()
            ]);

            // Return existing path jika ada, atau empty string jika tidak ada
            return $tiket->qr_code_path ?? '';
        }
    }
}
