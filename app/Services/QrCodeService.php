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
     * Generate QR Code untuk tiket dengan format sederhana
     */
    public function generateTicketQrCode(Tiket $tiket): string
    {
        // PERBAIKAN: Format sederhana hanya kode pemesanan
        $qrData = $tiket->kode_pemesanan; // Contoh: "TKT-ABC123"

        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $qrData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low, // Low untuk QR lebih sederhana
            size: 200, // Ukuran lebih kecil untuk mengurangi kompleksitas
            margin: 3, // Margin lebih kecil
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        );

        $result = $builder->build();

        // Simpan ke storage
        $filename = 'qr_codes/ticket_' . $tiket->kode_pemesanan . '.png';
        Storage::disk('public')->put($filename, $result->getString());

        // Update tiket dengan path QR code
        $tiket->update([
            'qr_code_path' => $filename,
            'qr_generated_at' => now(),
        ]);

        Log::info('Simple QR Code generated', [
            'ticket_id' => $tiket->id,
            'booking_code' => $tiket->kode_pemesanan,
            'qr_data' => $qrData,
            'file_path' => $filename,
        ]);

        return $filename;
    }

    /**
     * Generate QR Code untuk data tertentu (untuk modal) - DISEDERHANAKAN
     */
    public function generateQrCode(string $data, int $size = 200): string
    {
        try {
            $builder = new Builder(
                writer: new PngWriter(),
                writerOptions: [],
                validateResult: false,
                data: $data,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::Low, // PERBAIKAN: Low untuk kesederhanaan
                size: $size,
                margin: 3, // PERBAIKAN: Margin lebih kecil
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );

            $result = $builder->build();

            return $result->getDataUri();
        } catch (\Exception $e) {
            Log::error('Error generating simple QR Code', [
                'data' => $data,
                'data_length' => strlen($data),
                'error' => $e->getMessage(),
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
            if (!$tiket->qr_code_path || !$tiket->qr_generated_at || $tiket->qr_generated_at->diffInHours(now()) > 24) {
                return $this->generateTicketQrCode($tiket);
            }

            return $tiket->qr_code_path;
        } catch (\Exception $e) {
            Log::error('Error regenerating simple QR Code', [
                'ticket_id' => $tiket->id,
                'error' => $e->getMessage(),
            ]);

            // Return existing path jika ada, atau empty string jika tidak ada
            return $tiket->qr_code_path ?? '';
        }
    }
}
