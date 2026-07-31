<x-app-layout>
    @section('page_title', 'Manajemen Master Data Material')

    <div class="space-y-6 animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Katalog Master Material</h2>
                <p class="text-xs text-slate-500 font-medium italic">Otoritas Manajemen Aset & Harga PT. AMN</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total SKU</p>
                    <p class="text-sm font-bold text-slate-700">{{ $items->count() }} Item</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4">Informasi Barang</th>
                            <th class="px-8 py-4 text-center">Harga Satuan</th>
                            <th class="px-8 py-4 text-center">Stok Saat Ini</th>
                            <th class="px-8 py-4 text-center">Safety Stock</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600">
                        @foreach($items as $item)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-mono font-bold text-blue-600 uppercase tracking-tighter">{{ $item->kode_barang }}</span>
                                    <span class="text-sm font-bold text-slate-800 uppercase italic leading-tight">{{ $item->nama_barang }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="text-xs font-bold text-slate-600">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 rounded-lg font-mono font-bold {{ $item->stok <= $item->stok_minimum ? 'bg-red-50 text-red-600' : 'bg-slate-50 text-slate-800' }}">
                                    {{ $item->stok }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="text-xs font-medium text-slate-400">{{ $item->stok_minimum }} Unit</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('items.edit', $item->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus material ini dari database?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus Barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-blue-50/50 p-6 rounded-2xl border border-blue-100 italic">
            <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
            <p class="text-[10px] font-bold text-blue-700 uppercase tracking-widest leading-relaxed">
                Informasi: Perubahan harga atau nama material di sini akan langsung memperbarui seluruh histori laporan yang berkaitan.
            </p>
        </div>
    </div>
</x-app-layout>