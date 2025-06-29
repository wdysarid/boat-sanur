<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class TiketPdfController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * FIXED: Generate PDF dengan QR Code format sederhana
     */
    public function generatePdf($tiketId)
    {
        try {
            Log::info('Starting PDF generation', ['ticket_id' => $tiketId, 'user_id' => auth()->id()]);

            $tiket = Tiket::with(['jadwal.kapal', 'penumpang', 'pembayaran'])
                ->where('id', $tiketId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$tiket) {
                Log::warning('Ticket not found for PDF generation', [
                    'ticket_id' => $tiketId,
                    'user_id' => auth()->id(),
                ]);

                return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
            }

            // Cek apakah tiket sudah dikonfirmasi
            if ($tiket->status !== 'sukses' || !$tiket->pembayaran || $tiket->pembayaran->status !== 'terverifikasi') {
                Log::warning('Ticket not confirmed for PDF generation', [
                    'ticket_id' => $tiketId,
                    'ticket_status' => $tiket->status,
                    'payment_status' => $tiket->pembayaran?->status,
                ]);

                return redirect()->back()->with('error', 'Tiket belum dikonfirmasi. PDF hanya tersedia untuk tiket yang sudah dikonfirmasi.');
            }

            // FIXED: Generate QR Code sederhana untuk PDF
            $qrCodeDataUri = null;

            try {
                // FIXED: QR Code sederhana - hanya kode pemesanan
                $qrData = $tiket->kode_pemesanan; // Format: "TKT-ABC123"

                $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

                Log::info('Simple QR Code generated for PDF', [
                    'ticket_id' => $tiketId,
                    'qr_data' => $qrData,
                ]);
            } catch (\Exception $qrError) {
                Log::error('Error generating simple QR Code for PDF', [
                    'ticket_id' => $tiketId,
                    'error' => $qrError->getMessage(),
                ]);

                // Gunakan placeholder jika QR Code gagal
                $qrCodeDataUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
            }

            $today = now()->format('d F Y H:i:s');

            // Generate PDF
            try {
                $pdf = Pdf::loadView('pdf.tiket', [
                    'tiket' => $tiket,
                    'qrCodeImage' => $qrCodeDataUri,
                    'today' => $today,
                ]);

                $pdf->setPaper('A4', 'portrait');

                // Set options untuk better rendering
                $pdf->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'dpi' => 150,
                    'defaultPaperSize' => 'A4',
                    'chroot' => public_path(),
                ]);

                $filename = 'e-tiket-' . $tiket->kode_pemesanan . '.pdf';

                Log::info('PDF generated successfully', [
                    'ticket_id' => $tiketId,
                    'filename' => $filename,
                ]);

                return $pdf->download($filename);
            } catch (\Exception $pdfError) {
                Log::error('Error generating PDF', [
                    'ticket_id' => $tiketId,
                    'error' => $pdfError->getMessage(),
                    'trace' => $pdfError->getTraceAsString(),
                ]);

                return redirect()
                    ->back()
                    ->with('error', 'Gagal membuat PDF: ' . $pdfError->getMessage());
            }
        } catch (\Exception $e) {
            Log::error('General error in PDF generation', [
                'ticket_id' => $tiketId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Gagal membuat PDF tiket. Silakan coba lagi.');
        }
    }

    /**
     * FIXED: Preview PDF dengan QR Code format sederhana
     */
    public function previewPdf($tiketId)
    {
        try {
            $tiket = Tiket::with(['jadwal.kapal', 'penumpang', 'pembayaran'])
                ->where('id', $tiketId)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            // FIXED: Generate QR Code sederhana
            $qrData = $tiket->kode_pemesanan; // Format: "TKT-ABC123"
            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            $today = now()->format('d F Y H:i:s');

            Log::info('PDF preview generated', [
                'ticket_id' => $tiketId,
                'qr_data' => $qrData,
            ]);

            return view('pdf.tiket', [
                'tiket' => $tiket,
                'qrCodeImage' => $qrCodeDataUri,
                'today' => $today,
            ]);
        } catch (\Exception $e) {
            Log::error('Error previewing PDF', [
                'ticket_id' => $tiketId,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Gagal memuat preview tiket.');
        }
    }

    /**
     * FIXED: Generate PDF untuk admin (tanpa auth check)
     */
    public function generateAdminPdf($tiketId)
    {
        try {
            Log::info('Starting admin PDF generation', ['ticket_id' => $tiketId]);

            $tiket = Tiket::with(['jadwal.kapal', 'penumpang', 'pembayaran', 'user'])->findOrFail($tiketId);

            // FIXED: Generate QR Code sederhana
            $qrData = $tiket->kode_pemesanan; // Format: "TKT-ABC123"
            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            $today = now()->format('d F Y H:i:s');

            $pdf = Pdf::loadView('pdf.tiket', [
                'tiket' => $tiket,
                'qrCodeImage' => $qrCodeDataUri,
                'today' => $today,
            ]);

            $pdf->setPaper('A4', 'portrait');

            $filename = 'admin-tiket-' . $tiket->kode_pemesanan . '.pdf';

            Log::info('Admin PDF generated successfully', [
                'ticket_id' => $tiketId,
                'filename' => $filename,
            ]);

            return $pdf->download($filename);
        } catch (\Exception $e) {
            Log::error('Error generating admin PDF', [
                'ticket_id' => $tiketId,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Gagal membuat PDF tiket.');
        }
    }
}
