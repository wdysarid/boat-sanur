<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $table = 'kapal';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_kapal', 
        'kapasitas', 
        'deskripsi',
        'foto_kapal',
        'status'
    ];

    // Tambahkan untuk validasi enum
    const STATUSES = [
        'aktif',
        'maintenance',
        'tidak aktif'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
