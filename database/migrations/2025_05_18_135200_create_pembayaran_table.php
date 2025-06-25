<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->constrained(
                table: 'tiket',
                indexName: 'pembayaran_tiket_id')->onDelete('cascade');
            $table->string('metode_bayar');
            $table->integer('jumlah_bayar');
            $table->string('bukti_transfer')->nullable(); // nama file / path
            $table->enum('status', ['menunggu', 'terverifikasi', 'ditolak', 'dibatalkan'])->default('menunggu');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
