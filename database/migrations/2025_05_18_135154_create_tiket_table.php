<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'user',
                indexName: 'tiket_user_id')->onDelete('cascade');
            $table->foreignId('jadwal_id')->constrained(
                table: 'jadwal',
                indexName: 'tiket_jadwal_id')->onDelete('cascade');
            $table->string('kode_pemesanan')->unique();
            $table->integer('jumlah_penumpang');
            $table->integer('total_harga'); // opsional
            $table->enum('status', ['menunggu', 'dibatalkan', 'sukses'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};
