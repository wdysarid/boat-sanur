<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';

    protected $fillable = ['user_id', 'jadwal_id', 'kode_pemesanan', 'jumlah_penumpang', 'total_harga', 'status', 'qr_code_path', 'qr_generated_at'];

    protected $casts = [
        'qr_generated_at' => 'datetime',
    ];

    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_DIBATALKAN = 'dibatalkan';
    public const STATUS_SUKSES = 'sukses';

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

    public function getCheckedInCountAttribute()
    {
        return $this->penumpang()->where('status', 'checked_in')->count();
    }

    public function checkedInPassengers()
    {
        return $this->penumpang()->where('status', 'checked_in');
    }

    public function getQrCodeUrlAttribute()
    {
        if ($this->qr_code_path) {
            return asset('storage/' . $this->qr_code_path);
        }
        return null;
    }
}
