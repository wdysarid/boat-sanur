<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class EtiketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tiket;
    public $qrCodeImage;
    /**
     * Create a new message instance.
     */
    public function __construct($tiket, $qrCodeImage)
    {
        $this->tiket = $tiket;
        $this->qrCodeImage = $qrCodeImage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-Tiket SanurBoat - ' . $this->tiket->kode_pemesanan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.etiket',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        $tiket = $this->tiket;
        $pdf = PDF::loadView('pdf.tiket', [
            'tiket' => $tiket,
            'qrCodeImage' => $this->qrCodeImage,
            'today' => now()->format('d F Y H:i:s')
        ]);

        return $this->view('emails.etiket')
            ->attachData($pdf->output(), "e-tiket-{$tiket->kode_pemesanan}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
