<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    Use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kapal_id',
        'rute',
        'tanggal',
        'waktu_berangkat',
        'waktu_tiba',
        'harga_tiket',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_berangkat' => 'datetime',
        'waktu_tiba' => 'datetime',
    ];

    const STATUS_AKTIF = 'aktif';
    const STATUS_SELESAI = 'selesai';

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }

    // Calculate available seats
    public function getAvailableSeatsAttribute()
    {
        $totalTiket = $this->tiket()->where('status', 'sukses')->sum('jumlah_penumpang');
        return $this->kapal->kapasitas - $totalTiket;
    }

    // Scope for active schedules
    public function scopeAktif($query)
    {
        return $query->where('status', self::STATUS_AKTIF);
    }

    // Scope for completed schedules
    public function scopeSelesai($query)
    {
        return $query->where('status', self::STATUS_SELESAI);
    }

    // Scope for schedules by date
    public function scopeByTanggal($query, $tanggal)
    {
        return $query->where('tanggal', $tanggal);
    }
}
