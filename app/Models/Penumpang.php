<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $table = 'penumpang';
    protected $fillable = ['tiket_id', 'user_id', 'nama_lengkap', 'no_identitas', 'usia', 'jenis_kelamin', 'is_pemesan', 'status', 'checked_in_at'];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    // Tambahkan konstanta untuk status
    public const STATUS_BOOKED = 'booked';
    public const STATUS_CHECKED_IN = 'checked_in';
    public const STATUS_BOARDED = 'boarded';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkIn()
    {
        return $this->update([
            'status' => 'checked_in',
            'checked_in_at' => now(),
        ]);
    }
}
