<x-app-layout>
    @section('page_title', 'Edit Material - PT. AMN')

    <div class="max-w-2xl mx-auto space-y-6 animate-fade-in">
        
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-slate-800 tracking-tight italic">Update Data Material</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Serial: {{ $item->kode_barang }}</p>
            </div>
            <a href="{{ route('items.index') }}" class="text-[10px] font-black text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-2 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-8 py-4 bg-slate-50 border-b border-slate-100">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Informasi Komponen</span>
            </div>

            <form action="{{ route('items.update', $item->id) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Material</label>
                    <input type="text" name="nama_barang" value="{{ $item->nama_barang }}" required class="w-full border-slate-200 bg-slate-50 text-sm font-bold uppercase rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Harga Satuan (Rp)</label>
                        <input type="number" name="harga_satuan" value="{{ (int)$item->harga_satuan }}" required class="w-full border-slate-200 bg-slate-50 text-sm font-bold rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ambang Stok Minimum</label>
                        <input type="number" name="stok_minimum" value="{{ $item->stok_minimum }}" required class="w-full border-slate-200 bg-slate-50 text-sm font-bold rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50 flex gap-3">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-black text-[10px] py-4 uppercase tracking-[0.2em] rounded-xl hover:bg-blue-600 transition-all shadow-md active:scale-95">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('items.index') }}" class="px-8 py-4 bg-slate-100 text-slate-500 font-black text-[10px] uppercase tracking-[0.2em] rounded-xl hover:bg-slate-200 transition-all text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div class="p-5 bg-blue-50/50 border border-blue-100 rounded-xl flex items-center gap-4">
            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm">i</div>
            <p class="text-[9px] font-bold text-blue-700 uppercase tracking-wider leading-relaxed">
                Perubahan data ini akan langsung mempengaruhi laporan stok dan perhitungan nilai aset di dashboard utama.
            </p>
        </div>
    </div>
</x-app-layout>