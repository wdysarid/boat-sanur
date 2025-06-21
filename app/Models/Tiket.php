<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'kode_pemesanan',
        'jumlah_penumpang',
        'total_harga',
        'status',
    ];

    protected $casts = [
    'status' => 'string', 
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function penumpang()
    {
        return $this->hasMany(Penumpang::class);
    }

    public function pemesan()
    {
        return $this->hasOne(Penumpang::class)->where('is_pemesan', true);
    }
}
