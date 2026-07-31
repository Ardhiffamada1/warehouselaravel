<x-app-layout>
    @section('page_title', 'Quality Control - Laporan Kerusakan')

    <div class="space-y-10 animate-fade-in">
        
        <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-10 py-8 bg-slate-900 flex justify-between items-center">
                <div class="space-y-1">
                    <h3 class="text-white text-xs font-black uppercase tracking-[0.2em] italic text-amber-500">Laporan Komponen Reject</h3>
                    <p class="text-slate-400 text-[10px] font-medium uppercase tracking-widest">Input material yang rusak selama proses produksi</p>
                </div>
                <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-500 border border-amber-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>

            <form action="{{ route('damage.store') }}" method="POST" class="p-10 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Pilih Komponen</label>
                        <select name="item_id" class="w-full border-slate-100 bg-slate-50 p-4 text-sm font-bold uppercase rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_barang }} — {{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Jumlah Rusak</label>
                        <input type="number" name="jumlah" required placeholder="0" class="w-full border-slate-100 bg-slate-50 p-4 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Penyebab / Keterangan</label>
                        <input type="text" name="keterangan" required placeholder="Contoh: Pecah saat perakitan" class="w-full border-slate-100 bg-slate-50 p-4 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-amber-500 text-slate-900 font-black text-[11px] py-4 px-12 uppercase tracking-[0.3em] rounded-2xl shadow-xl shadow-amber-500/20 hover:bg-slate-900 hover:text-white transition-all duration-500">
                        Kirim Laporan Kerusakan
                    </button>
                </div>
            </form>
        </div>

        <div class="p-8 bg-amber-50 border border-amber-100 rounded-[2rem] flex items-center gap-6">
            <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white shadow-lg">!</div>
            <div class="space-y-1">
                <p class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Catatan Penting</p>
                <p class="text-xs font-medium text-amber-600 italic">Setiap barang yang dilaporkan rusak akan otomatis memotong stok gudang dan memicu peninjauan oleh Supervisor Produksi.</p>
            </div>
        </div>
    </div>
</x-app-layout>