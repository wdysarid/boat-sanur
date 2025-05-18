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
        return $this->hasOneThrough(User::class, Tiket::class, 'id', 'id', 'tiket_id', 'user_id');
    }
}
