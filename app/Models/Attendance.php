<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    // Mass assignment agar data bisa disimpan
    protected $fillable = [
        'user_id', 
        'tanggal', 
        'jam_masuk', 
        'jam_keluar', 
        'status', 
        'keterangan'
    ];

    /**
     * Relasi balik ke User (Setiap absen milik satu user)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}