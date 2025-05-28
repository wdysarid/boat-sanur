<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
 use HasFactory;

    protected $table = 'kapal';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama_kapal',
        'kapasitas',
        'status',
        'deskripsi',
        'foto_kapal'
    ];

    protected $casts = [
        'kapasitas' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor for foto_kapal URL
    public function getFotoKapalUrlAttribute()
    {
        if ($this->foto_kapal) {
            return asset('storage/' . $this->foto_kapal);
        }
        return null;
    }

    // Scope for active boats
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope for maintenance boats
    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    // Scope for inactive boats
    public function scopeInactive($query)
    {
        return $query->where('status', 'tidak aktif');
    }

    // Tambahkan untuk validasi enum
    const STATUES = [
        'aktif',
        'maintenance',
        'tidak aktif'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
