<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'tiket_id',
        'metode_bayar',
        'jumlah_bayar',
        'bukti_transfer',
        'status',
    ];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function user()
    {
        // akses user melalui tiket
        return $this->hasOneThrough(
            User::class, 
            Tiket::class, 
            'id', // Foreign key di Tiket (referensi dari tiket_id di Pembayaran)
            'id', // Foreign key di User (referensi dari user_id di Tiket)
            'tiket_id', // Local key di Pembayaran
            'user_id'); // Local key di Tiket
    }
}
