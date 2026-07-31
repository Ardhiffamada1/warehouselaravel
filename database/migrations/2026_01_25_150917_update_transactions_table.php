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
    Schema::table('transactions', function (Blueprint $table) {
        // Hapus kolom lama
        $table->dropColumn(['petugas', 'tanggal_transaksi']);
        
        // Tambahkan kolom baru yang sesuai dengan Controller
        $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('item_id');
        $table->string('keterangan')->nullable()->after('jumlah');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
