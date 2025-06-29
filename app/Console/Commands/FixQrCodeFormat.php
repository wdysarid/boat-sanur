<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tiket;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;

class FixQrCodeFormat extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'qr:fix-format {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     */
    protected $description = 'Fix existing QR codes to use simple format (booking code only)';

    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        parent::__construct();
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        $this->info('Starting QR Code format fix...');

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }

        // Get all confirmed tickets that need QR code regeneration
        $tickets = Tiket::where('status', 'sukses')
            ->whereHas('pembayaran', function($q) {
                $q->where('status', 'terverifikasi');
            })
            ->get();

        $this->info("Found {$tickets->count()} confirmed tickets to process");

        $processed = 0;
        $errors = 0;

        foreach ($tickets as $ticket) {
            try {
                $this->line("Processing ticket: {$ticket->kode_pemesanan}");

                if (!$dryRun) {
                    // Regenerate QR code with simple format
                    $qrPath = $this->qrCodeService->generateTicketQrCode($ticket);

                    $this->info("✓ Generated simple QR code for {$ticket->kode_pemesanan}");
                } else {
                    $this->info("✓ Would generate simple QR code for {$ticket->kode_pemesanan}");
                }

                $processed++;

            } catch (\Exception $e) {
                $this->error("✗ Error processing {$ticket->kode_pemesanan}: {$e->getMessage()}");
                Log::error('QR Code fix error', [
                    'ticket_id' => $ticket->id,
                    'booking_code' => $ticket->kode_pemesanan,
                    'error' => $e->getMessage()
                ]);
                $errors++;
            }
        }

        $this->newLine();
        $this->info("QR Code format fix completed!");
        $this->info("Processed: {$processed}");
        $this->info("Errors: {$errors}");

        if ($dryRun) {
            $this->warn('This was a dry run. Run without --dry-run to apply changes.');
        }

        return Command::SUCCESS;
    }
}
