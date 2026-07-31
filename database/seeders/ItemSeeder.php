<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        \App\Models\Item::insert([
            ['kode_barang' => 'BRG-001', 'nama_barang' => 'Piston Suzuki GX', 'stok' => 50, 'stok_minimum' => 10],
            ['kode_barang' => 'BRG-002', 'nama_barang' => 'Brake Pad Toyota Kijang', 'stok' => 5, 'stok_minimum' => 15],
            ['kode_barang' => 'BRG-003', 'nama_barang' => 'Gasket Engine Yamaha', 'stok' => 100, 'stok_minimum' => 20],
        ]);
    }
}
