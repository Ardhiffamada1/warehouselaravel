<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar master data material
     */
    public function index()
    {
        // Mengambil semua data barang urut berdasarkan nama
        $items = Item::orderBy('nama_barang', 'asc')->get();

        return view('items.index', compact('items'));
    }

    /**
     * Menampilkan form edit material
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    /**
     * Memperbarui data material (Nama, Harga, Stok Minimum)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|min:0',
            'stok_minimum' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($id);
        
        $item->update([
            'nama_barang' => strtoupper($request->nama_barang),
            'harga_satuan' => $request->harga_satuan,
            'stok_minimum' => $request->stok_minimum,
        ]);

        return redirect()->route('items.index')->with('success', 'Data material ' . $item->nama_barang . ' berhasil diperbarui.');
    }

    /**
     * Menghapus material dari database
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        
        // Simpan nama untuk pesan sukses sebelum dihapus
        $nama = $item->nama_barang;
        
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Material ' . $nama . ' telah dihapus dari sistem.');
    }

    /**
     * Fitur Tambahan: Mengambil data barang via JSON (untuk AJAX/Search)
     */
    public function getApiItems()
    {
        $items = Item::all();
        return response()->json($items);
    }
}