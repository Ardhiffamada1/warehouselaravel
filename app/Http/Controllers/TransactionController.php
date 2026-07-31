<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Halaman Utama Input Logistik
     */
    public function index()
    {
        $items = Item::orderBy('nama_barang', 'asc')->get();
        
        // LOGIKA AUTO-SERIAL: AMN + TAHUNBULAN + URUTAN
        $latestItem = Item::latest()->first();
        $nextNumber = $latestItem ? ((int) substr($latestItem->kode_barang, -3)) + 1 : 1;
        $autoCode = 'AMN-' . date('ym') . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Ambil 5 transaksi terakhir untuk ditampilkan di form (Live Preview)
        $recentTransactions = Transaction::with(['item', 'user'])->latest()->take(5)->get();

        return view('transactions.index', compact('items', 'autoCode', 'recentTransactions'));
    }

    /**
     * FITUR: Simpan Pergerakan Stok (Masuk/Keluar) + CATAT LOG
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jenis'   => 'required|in:masuk,keluar',
            'jumlah'  => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $item = Item::findOrFail($request->item_id);

            // Validasi Stok untuk Barang Keluar
            if ($request->jenis == 'keluar' && $item->stok < $request->jumlah) {
                return back()->with('error', 'STOK TIDAK CUKUP! Sisa stok ' . $item->nama_barang . ' hanya ' . $item->stok);
            }

            // 1. Proses Update Stok di Tabel Items
            if ($request->jenis == 'masuk') {
                $item->increment('stok', $request->jumlah);
            } else {
                $item->decrement('stok', $request->jumlah);
            }

            // 2. Simpan Rekaman ke Tabel Transactions
            Transaction::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(), 
                'jenis'   => $request->jenis,
                'jumlah'  => $request->jumlah,
                'keterangan' => $request->keterangan ?? 'Karyawan ' . Auth::user()->name . ' melakukan input barang ' . $request->jenis,
            ]);

            DB::commit();
            return back()->with('success', 'Stok ' . $item->nama_barang . ' berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal sistem: ' . $e->getMessage());
        }
    }

    /**
     * FITUR: Registrasi Material Baru + CATAT LOG
     */
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'stok'         => 'required|integer|min:0',
            'stok_minimum'=> 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $newItem = Item::create([
                'kode_barang'  => $request->kode_barang,
                'nama_barang'  => strtoupper($request->nama_barang),
                'stok'         => $request->stok,
                'stok_minimum' => $request->stok_minimum,
                'harga_satuan' => $request->harga_satuan,
            ]);

            // Catat log pendaftaran (dianggap barang masuk pertama kali)
            Transaction::create([
                'item_id' => $newItem->id,
                'user_id' => Auth::id(),
                'jenis'   => 'masuk',
                'jumlah'  => $request->stok,
                'keterangan' => 'REGISTRASI AWAL: ' . $newItem->nama_barang,
            ]);

            DB::commit();
            return back()->with('success', 'Material Baru Berhasil Didaftarkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * FITUR: Halaman Utama Laporan Kerusakan
     */
    public function damageIndex()
    {
        $items = Item::orderBy('nama_barang', 'asc')->get();
        return view('damage.index', compact('items'));
    }

    /**
     * FITUR: Simpan Laporan Kerusakan + CATAT LOG
     */
    public function storeDamage(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah'  => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $item = Item::findOrFail($request->item_id);

            if ($item->stok < $request->jumlah) {
                return back()->with('error', 'Gagal! Stok tidak mencukupi untuk dilaporkan rusak.');
            }

            // 1. Kurangi stok utama
            $item->decrement('stok', $request->jumlah);
            
            // 2. Catat Log (Jenis keluar karena rusak)
            Transaction::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(),
                'jenis'   => 'keluar',
                'jumlah'  => $request->jumlah,
                'keterangan' => 'LAPORAN KERUSAKAN: ' . $request->keterangan,
            ]);

            DB::commit();
            return back()->with('success', 'Laporan kerusakan ' . $item->nama_barang . ' berhasil dicatat.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}