<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk ambil user yang login

class InventoryController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('nama_barang', 'asc')->get();
        $totalItems = $items->count();
        $stokRendah = $items->where('stok', '<=', 10)->count();

        return view('dashboard', compact('items', 'totalItems', 'stokRendah'));
    }

    public function manage()
    {
        $items = Item::orderBy('nama_barang', 'asc')->get();
        return view('items.index', compact('items'));
    }

    public function laporanAktivitas()
    {
        $logs = Transaction::with(['item', 'user'])
                    ->latest()
                    ->paginate(15);

        return view('laporan.aktivitas', compact('logs'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_satuan' => 'required|numeric',
            'stok_minimum' => 'required|integer',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'nama_barang' => strtoupper($request->nama_barang),
            'harga_satuan' => $request->harga_satuan,
            'stok_minimum' => $request->stok_minimum,
        ]);

        // LOG TAMBAHAN: Catat aksi edit ke tabel transaksi
        Transaction::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'jenis'   => 'masuk', // Kita asumsikan kategori masuk untuk log sistem
            'jumlah'  => 0, // Tidak ada perubahan stok
            'keterangan' => 'SISTEM: Memperbarui informasi master data/harga.',
        ]);

        return redirect()->route('items.index')->with('success', 'Material berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        
        // LOG TAMBAHAN: Sebelum dihapus, catat dulu siapa yang hapus
        Transaction::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'jenis'   => 'keluar',
            'jumlah'  => $item->stok,
            'keterangan' => 'SISTEM: Material dihapus dari database oleh Admin.',
        ]);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Material berhasil dihapus!');
    }

    public function cetakPDF()
    {
        $items = Item::all();
        $totalAset = $items->sum(fn($i) => $i->stok * $i->harga_satuan);
        
        $pdf = Pdf::loadView('laporan.stok_pdf', compact('items', 'totalAset'));
        return $pdf->download('Laporan_Stok_PT_Andalan.pdf');
    }

    public function laporanKeluar()
{
    // Hanya ambil transaksi yang jenisnya 'keluar' (termasuk rusak)
    $outgoings = Transaction::with(['item', 'user'])
                    ->where('jenis', 'keluar')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->latest()
                    ->paginate(20);

    return view('laporan.barang_keluar', compact('outgoings'));
}
}