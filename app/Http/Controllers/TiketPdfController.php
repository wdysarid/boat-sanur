<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use PDF;

class TiketPdfController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function generatePdf($tiketId)
    {
        $tiket = Tiket::with(['jadwal.kapal', 'penumpang', 'pembayaran'])
            ->where('id', $tiketId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Generate QR Code data
        $qrData = json_encode([
            'booking_code' => $tiket->kode_pemesanan,
            'user_id' => $tiket->user_id,
            'schedule_id' => $tiket->jadwal_id,
            'date' => $tiket->jadwal->tanggal,
        ]);

        $qrCode = $this->qrCodeService->generateQrCode($qrData);

        $today = now()->format('d F Y');

        $pdf = PDF::loadView('tiket-pdf', [
            'tiket' => $tiket,
            'qrCodeImage' => $qrCode->getDataUri(),
            'today' => $today,
        ]);

        return $pdf->download('e-tiket-' . $tiket->kode_pemesanan . '.pdf');
    }
}
