<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Sesuaikan fillable dengan kodingan di Controller
    protected $fillable = ['item_id', 'user_id', 'jenis', 'jumlah', 'keterangan'];

    // Relasi ke Barang
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke User (Penting agar nama petugas muncul otomatis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}