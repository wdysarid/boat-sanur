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
        'waktu_berangkat',
        'waktu_tiba',
        'harga_tiket',
        'kuota',
    ];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}
