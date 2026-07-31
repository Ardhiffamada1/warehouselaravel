<x-app-layout>
    @section('page_title', 'Monthly Outgoing Report')

    <div class="max-w-6xl mx-auto space-y-6 animate-fade-in">
        <div class="flex justify-between items-center bg-white p-8 rounded-3xl border border-slate-200">
            <div>
                <h2 class="text-xl font-bold text-slate-800 italic uppercase tracking-tighter">Laporan Barang Keluar</h2>
                <p class="text-xs text-slate-500 italic">Periode: {{ date('F Y') }}</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Unit Keluar</p>
                <p class="text-2xl font-black text-red-600 tracking-tighter">{{ $outgoings->sum('jumlah') }}</p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse italic">
                <thead class="bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-4">Tanggal</th>
                        <th class="px-8 py-4">Material</th>
                        <th class="px-8 py-4 text-center">Jumlah</th>
                        <th class="px-8 py-4">Tujuan / Keterangan</th>
                        <th class="px-8 py-4">Operator</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-slate-600 font-medium">
                    @foreach($outgoings as $log)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-4 text-[10px] font-bold text-slate-400">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-8 py-4">
                            <span class="font-bold text-slate-800 block text-sm uppercase">{{ $log->item->nama_barang }}</span>
                            <span class="text-[9px] text-blue-500 font-mono">{{ $log->item->kode_barang }}</span>
                        </td>
                        <td class="px-8 py-4 text-center">
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg font-black text-xs border border-red-100">- {{ $log->jumlah }}</span>
                        </td>
                        <td class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-tighter">
                            {{ $log->keterangan ?? 'Distribusi Produksi' }}
                        </td>
                        <td class="px-8 py-4 text-[10px] font-black uppercase text-slate-400">{{ $log->user->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>