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
        Schema::create('kapal', function (Blueprint $table) {
            // $table->id();
            $table->string('id', 5)->primary();
            $table->string('nama_kapal');
            $table->integer('kapasitas');
            $table->text('deskripsi')->nullable();
            $table->string('foto_kapal')->nullable();
            $table->enum('status', ['aktif', 'maintenance', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapal');
    }
};
