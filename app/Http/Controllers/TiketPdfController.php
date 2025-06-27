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
                    'user_id' => auth()->id()
                ]);

                return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
            }

            // Cek apakah tiket sudah dikonfirmasi
            if ($tiket->status !== 'sukses' ||
                !$tiket->pembayaran ||
                $tiket->pembayaran->status !== 'terverifikasi') {

                Log::warning('Ticket not confirmed for PDF generation', [
                    'ticket_id' => $tiketId,
                    'ticket_status' => $tiket->status,
                    'payment_status' => $tiket->pembayaran?->status
                ]);

                return redirect()->back()->with('error', 'Tiket belum dikonfirmasi. PDF hanya tersedia untuk tiket yang sudah dikonfirmasi.');
            }

            // Generate QR Code data URI untuk PDF
            $qrCodeDataUri = null;

            try {
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

                $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

                Log::info('QR Code generated for PDF', ['ticket_id' => $tiketId]);

            } catch (\Exception $qrError) {
                Log::error('Error generating QR Code for PDF', [
                    'ticket_id' => $tiketId,
                    'error' => $qrError->getMessage()
                ]);

                // Gunakan placeholder jika QR Code gagal
                $qrCodeDataUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
            }

            $today = now()->format('d F Y');

            // Generate PDF
            try {
                $pdf = Pdf::loadView('pdf.tiket', [
                    'tiket' => $tiket,
                    'qrCodeImage' => $qrCodeDataUri,
                    'today' => $today,
                ]);

                $pdf->setPaper('A4', 'portrait');

                Log::info('PDF generated successfully', ['ticket_id' => $tiketId]);

                return $pdf->download('e-tiket-' . $tiket->kode_pemesanan . '.pdf');

            } catch (\Exception $pdfError) {
                Log::error('Error generating PDF', [
                    'ticket_id' => $tiketId,
                    'error' => $pdfError->getMessage(),
                    'trace' => $pdfError->getTraceAsString()
                ]);

                return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $pdfError->getMessage());
            }

        } catch (\Exception $e) {
            Log::error('General error in PDF generation', [
                'ticket_id' => $tiketId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal membuat PDF tiket. Silakan coba lagi.');
        }
    }

    public function previewPdf($tiketId)
    {
        try {
            $tiket = Tiket::with(['jadwal.kapal', 'penumpang', 'pembayaran'])
                ->where('id', $tiketId)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            // Generate QR Code data URI
            $qrData = json_encode([
                'ticket_id' => $tiket->id,
                'booking_code' => $tiket->kode_pemesanan,
                'user_id' => $tiket->user_id,
                'schedule_id' => $tiket->jadwal_id,
                'date' => $tiket->jadwal->tanggal,
            ]);

            $qrCodeDataUri = $this->qrCodeService->generateQrCode($qrData, 200);

            $today = now()->format('d F Y');

            return view('pdf.tiket', [
                'tiket' => $tiket,
                'qrCodeImage' => $qrCodeDataUri,
                'today' => $today,
            ]);

        } catch (\Exception $e) {
            Log::error('Error previewing PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat preview tiket.');
        }
    }
}
