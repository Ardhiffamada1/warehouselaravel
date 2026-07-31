<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController; // Pastikan nama file controller kamu benar (InventoryController atau ItemController)
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute yang Wajib Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dashboard (Monitoring Utama - Read Only)
    Route::get('/dashboard', [InventoryController::class, 'index'])->name('dashboard');

    // 2. Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Operasional Logistik (Input Barang In/Out & Registrasi Material)
    Route::get('/logistik', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/logistik/add-material', [TransactionController::class, 'storeMaterial'])->name('transactions.storeMaterial');

    // 4. Laporan Kerusakan (Quality Control)
    Route::get('/damage', [TransactionController::class, 'damageIndex'])->name('damage.index');
    Route::post('/damage/store', [TransactionController::class, 'storeDamage'])->name('damage.store');

    // 5. Manajemen Inventaris (Edit, Update, Hapus Barang) - Untuk Supervisor & Admin
    // Kita arahkan ke InventoryController yang baru saja kita buat full CRUD-nya
// ... rute lainnya tetap ...

    Route::resource('items', InventoryController::class)->except(['index']);
    Route::get('/inventory/manage', [InventoryController::class, 'manage'])->name('items.index');
    Route::get('/laporan/cetak', [InventoryController::class, 'cetakPDF'])->name('laporan.cetak');
    Route::get('/laporan/aktivitas', [InventoryController::class, 'laporanAktivitas'])->name('laporan.aktivitas');

    // 6. Presensi / Absensi Harian
    Route::get('/attendance/rekap', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    // 7. Manajemen Karyawan - Khusus Akses Admin
    Route::get('/users-management', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
});

require __DIR__.'/auth.php';