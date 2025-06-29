<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $table = 'penumpang';
    protected $fillable = [
        'tiket_id',
        'user_id',
        'nama_lengkap',
        'no_identitas',
        'usia',
        'jenis_kelamin',
        'is_pemesan',
        'status',
        'checked_in_at'
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

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
            'checked_in_at' => now()
        ]);
    }
}
