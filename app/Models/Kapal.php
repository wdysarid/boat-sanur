<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $table = 'kapal';

    protected $fillable = [
        'nama_kapal', 
        'kapasitas', 
        'deskripsi'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
