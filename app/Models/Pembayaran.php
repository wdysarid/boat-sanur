<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = ['tiket_id', 'metode_bayar', 'jumlah_bayar', 'bukti_transfer', 'status'];

    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_TERVERIFIKASI = 'terverifikasi';
    public const STATUS_DITOLAK = 'ditolak';
    public const STATUS_DIBATALKAN = 'dibatalkan';

    public function getMetodeBayarTextAttribute()
    {
        return [
            'transfer' => 'Transfer Bank',
            'qris' => 'QRIS',
        ][$this->metode_bayar] ?? $this->metode_bayar;
    }
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
            'user_id',
        ); // Local key di Tiket
    }

    public function getBuktiTransferUrlAttribute()
    {
        if ($this->bukti_transfer) {
            return asset('storage/' . $this->bukti_transfer);
        }
        return null;
    }

    protected $appends = ['bukti_transfer_url'];
}
