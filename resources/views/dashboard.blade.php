<x-app-layout>
    @section('page_title', 'Dashboard Monitoring | PT. AMN')

    <div class="space-y-6 animate-fade-in">
        
        <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-8 shadow-xl">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="space-y-2">
                    @php
                        $hour = date('H');
                        $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));
                    @endphp
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-blue-500/20 border border-blue-400/30 rounded-full text-xs font-bold text-blue-300 uppercase tracking-widest">{{ $greeting }}</span>
                        <span class="text-slate-400 text-sm font-medium italic">{{ date('l, d F Y') }}</span>
                    </div>
                    <h1 class="text-2xl font-semibold text-white tracking-tight">Halo, <span class="font-black text-blue-400">{{ Auth::user()->name }}</span></h1>
                    <p class="text-slate-400 text-sm">Sistem Monitoring Produksi PT. AMN</p>
                </div>
                <div id="live-clock" class="text-2xl font-black text-white font-mono tracking-tighter bg-white/5 px-6 py-3 rounded-2xl border border-white/10">00:00:00</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white border border-slate-200 p-6 rounded-3xl shadow-sm">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest block mb-2">Total Material</span>
                <p class="text-3xl font-black text-slate-800 tracking-tighter italic">{{ $items->count() }} <span class="text-sm text-slate-400 uppercase font-normal">SKU</span></p>
            </div>
            
            <div class="bg-white border border-slate-200 p-6 rounded-3xl shadow-sm border-l-8 border-l-emerald-500">
                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest block mb-2">Valuasi Aset</span>
                <p class="text-2xl font-black text-slate-800 tracking-tighter italic">Rp {{ number_format($items->sum(fn($i) => $i->stok * $i->harga_satuan), 0, ',', '.') }}</p>
            </div>

            <div class="bg-white border border-slate-200 p-6 rounded-3xl shadow-sm border-l-8 border-l-blue-600">
                <span class="text-xs font-black text-blue-600 uppercase tracking-widest block mb-2">Barang Keluar (Bulan Ini)</span>
                @php 
                    $qtyKeluar = \App\Models\Transaction::where('jenis', 'keluar')
                                    ->whereMonth('created_at', date('m'))
                                    ->sum('jumlah');
                @endphp
                <p class="text-3xl font-black text-slate-800 tracking-tighter italic">{{ $qtyKeluar }} <span class="text-sm text-slate-400 uppercase font-normal">Unit</span></p>
            </div>

            <div class="bg-white border border-slate-200 p-6 rounded-3xl shadow-sm border-l-8 border-l-red-500">
                <span class="text-xs font-black text-red-500 uppercase tracking-widest block mb-2">Butuh Re-Stock</span>
                <p class="text-3xl font-black text-slate-800 tracking-tighter italic">{{ $items->where('stok', '<=', 10)->count() }} <span class="text-sm text-slate-400 uppercase font-normal">Item</span></p>
            </div>
        </div>

        @php $criticalItems = $items->where('stok', '<=', 5); @endphp
        @if($criticalItems->count() > 0)
        <div class="bg-red-50 border-2 border-red-100 rounded-3xl p-6 shadow-lg shadow-red-100/50">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-6 h-6 text-red-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <h4 class="text-sm font-black text-red-700 uppercase tracking-widest italic">Peringatan: Stok Hampir Habis!</h4>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($criticalItems as $ci)
                <div class="bg-white p-4 rounded-2xl border border-red-100 flex justify-between items-center shadow-sm">
                    <span class="text-sm font-bold text-slate-700 uppercase">{{ $ci->nama_barang }}</span>
                    <span class="text-sm font-black text-red-600 bg-red-50 px-3 py-1 rounded-lg border border-red-200 italic">Sisa: {{ $ci->stok }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-[2rem] overflow-hidden shadow-sm">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-7 bg-slate-900 rounded-full"></div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest italic font-mono">Inventory Monitoring Center</h4>
                </div>
                @if(Auth::user()->role >= 2)
                <a href="{{ route('laporan.cetak') }}" class="px-5 py-2.5 bg-slate-900 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-600 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak PDF
                </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] font-black uppercase tracking-wider border-b border-slate-100 italic">
                        <tr>
                            <th class="px-8 py-5">Material</th>
                            <th class="px-8 py-5 text-center">Harga Unit</th>
                            <th class="px-8 py-5 text-center">Stok</th>
                            <th class="px-8 py-5 text-right">Nilai Barang</th>
                            <th class="px-8 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @foreach($items as $item)
                        <tr class="group hover:bg-slate-50/80 transition-all italic">
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-slate-800 uppercase tracking-tighter group-hover:text-blue-600 transition-colors">{{ $item->nama_barang }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono tracking-widest uppercase">{{ $item->kode_barang }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center text-sm font-bold text-slate-500">
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="text-base font-black text-slate-800 tracking-tighter">{{ $item->stok }}</span>
                            </td>
                            <td class="px-8 py-5 text-right font-black text-blue-600 text-sm tracking-tighter">
                                Rp {{ number_format($item->stok * $item->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($item->stok <= $item->stok_minimum)
                                    <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase rounded-lg border border-red-100">Kritis</span>
                                @else
                                    <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-lg border border-green-100">Aman</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('live-clock').textContent = now.toLocaleTimeString('id-ID', { hour12: false }) + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>