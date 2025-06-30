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

    // SIMPLIFIED: Only 3 status constants
    public const STATUS_BOOKED = 'booked';
    public const STATUS_CHECKED_IN = 'checked_in';
    public const STATUS_CANCELLED = 'cancelled';

    // REMOVED: boarded and completed statuses

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

    /**
     * NEW: Auto-cancel when ticket/payment cancelled
     */
    public function cancel()
    {
        return $this->update([
            'status' => 'cancelled',
            'updated_at' => now(),
        ]);
    }

    /**
     * SIMPLIFIED: Get valid statuses
     */
    public static function getValidStatuses()
    {
        return [
            self::STATUS_BOOKED,
            self::STATUS_CHECKED_IN,
            self::STATUS_CANCELLED,
        ];
    }
}
