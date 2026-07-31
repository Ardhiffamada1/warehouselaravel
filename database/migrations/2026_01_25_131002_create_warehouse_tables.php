<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('items', function ($table) {
        $table->id();
        $table->string('kode_barang')->unique();
        $table->string('nama_barang');
        $table->integer('stok')->default(0);
        $table->integer('stok_minimum')->default(5);
        $table->timestamps();
    });

    // Tabel Transaksi (Bab 4.2.4)
    Schema::create('transactions', function ($table) {
        $table->id();
        $table->foreignId('item_id')->constrained();
        $table->enum('jenis', ['masuk', 'keluar']);
        $table->integer('jumlah');
        $table->date('tanggal_transaksi');
        $table->string('petugas');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_tables');
    }
};
