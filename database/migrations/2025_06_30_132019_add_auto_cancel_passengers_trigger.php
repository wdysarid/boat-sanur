<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a trigger to auto-cancel passengers when both ticket and payment are cancelled
        DB::unprepared('
            CREATE TRIGGER auto_cancel_passengers_on_ticket_cancel
            AFTER UPDATE ON tiket
            FOR EACH ROW
            BEGIN
                IF NEW.status = "dibatalkan" AND OLD.status != "dibatalkan" THEN
                    -- Check if payment is also cancelled
                    IF EXISTS (
                        SELECT 1 FROM pembayaran
                        WHERE tiket_id = NEW.id AND status = "dibatalkan"
                    ) THEN
                        -- Update passengers to cancelled
                        UPDATE penumpang
                        SET status = "cancelled", updated_at = NOW()
                        WHERE tiket_id = NEW.id
                        AND status IN ("booked", "checked_in");
                    END IF;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER auto_cancel_passengers_on_payment_cancel
            AFTER UPDATE ON pembayaran
            FOR EACH ROW
            BEGIN
                IF NEW.status = "dibatalkan" AND OLD.status != "dibatalkan" THEN
                    -- Check if ticket is also cancelled
                    IF EXISTS (
                        SELECT 1 FROM tiket
                        WHERE id = NEW.tiket_id AND status = "dibatalkan"
                    ) THEN
                        -- Update passengers to cancelled
                        UPDATE penumpang
                        SET status = "cancelled", updated_at = NOW()
                        WHERE tiket_id = NEW.tiket_id
                        AND status IN ("booked", "checked_in");
                    END IF;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS auto_cancel_passengers_on_ticket_cancel');
        DB::unprepared('DROP TRIGGER IF EXISTS auto_cancel_passengers_on_payment_cancel');
    }
};
