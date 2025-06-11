<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kapal_id',
        'rute_asal',
        'rute_tujuan',
        'tanggal',
        'waktu_berangkat',
        'waktu_tiba',
        'harga_tiket',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'waktu_berangkat' => 'datetime:H:i',
        'waktu_tiba' => 'datetime:H:i',
    ];

    protected $appends = ['tiket_terjual'];

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

    public function getTiketTerjualAttribute()
    {
        return $this->tiket()->where('status', 'sukses')->sum('jumlah_penumpang');
    }

    public function getKapasitasKapalAttribute()
    {
        return $this->kapal ? $this->kapal->kapasitas : 0;
    }

    public function getAvailableSeatsAttribute()
    {
        return $this->kapal->kapasitas - $this->tiket_terjual;
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
