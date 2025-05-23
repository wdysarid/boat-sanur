<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'pesan',
        // 'rating',
        'disetujui',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
