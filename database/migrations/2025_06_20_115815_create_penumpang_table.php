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
        Schema::create('penumpang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->constrained(
                table: 'tiket',
                indexName: 'penumpang_tiket_id'
            )->onDelete('cascade');

            // Untuk penumpang utama (pemesan), ini akan merujuk ke user yang login
            $table->foreignId('user_id')->nullable()->constrained(
                table: 'user',
                indexName: 'penumpang_user_id'
            )->onDelete('set null');

            $table->string('nama_lengkap');
            $table->string('no_identitas'); // KTP/Passport
            $table->integer('usia');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->boolean('is_pemesan')->default(false); // Flag untuk menandai pemesan utama

            $table->enum('status', ['booked', 'checked_in', 'boarded', 'completed', 'cancelled'])->default('booked');
            $table->timestamp('checked_in_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penumpang');
    }
};
