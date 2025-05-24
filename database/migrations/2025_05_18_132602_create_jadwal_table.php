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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('kapal_id', 5);
            $table->foreign('kapal_id')->references('id')->on('kapal')->onDelete('cascade')->constrained(indexName: 'jadwal_kapal_id');
            $table->string('rute');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('waktu_tiba');
            $table->integer('harga_tiket');
            $table->integer('kuota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
