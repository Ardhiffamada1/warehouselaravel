<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['kode_barang', 'nama_barang', 'harga_satuan', 'stok', 'stok_minimum'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}