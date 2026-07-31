    <x-app-layout>
        @section('page_title', 'Log Aktivitas Logistik')

        <div class="max-w-6xl mx-auto space-y-6 animate-fade-in">
            
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Riwayat Aktivitas Gudang</h2>
                    <p class="text-xs text-slate-500 font-medium">Monitoring kronologis pergerakan material PT. AMN</p>
                </div>
                
                <form class="flex items-center gap-3">
                    <input type="date" name="from" class="text-xs border-slate-200 rounded-lg focus:ring-0 focus:border-blue-600 transition-all">
                    <span class="text-slate-400 font-bold text-[10px] uppercase">ke</span>
                    <input type="date" name="to" class="text-xs border-slate-200 rounded-lg focus:ring-0 focus:border-blue-600 transition-all">
                    <button type="submit" class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-4">Waktu & Tanggal</th>
                                <th class="px-8 py-4">Nama Material</th>
                                <th class="px-8 py-4 text-center">Tipe Arus</th>
                                <th class="px-8 py-4 text-center">Qty</th>
                                <th class="px-8 py-4">Petugas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-slate-600">
                            @forelse($logs as $log)
                            <tr class="group hover:bg-slate-50/30 transition-colors italic">
                                <td class="px-8 py-4 text-xs font-medium">
                                    <span class="text-slate-800 block">{{ $log->created_at->format('d/m/Y') }}</span>
                                    <span class="text-slate-400 text-[10px]">{{ $log->created_at->format('H:i') }} WIB</span>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="text-sm font-bold text-slate-800 uppercase tracking-tight">{{ $log->item->nama_barang }}</span>
                                    <span class="text-[9px] block text-slate-400 font-mono">{{ $log->item->kode_barang }}</span>
                                </td>
                                <td class="px-8 py-4 text-center">
                                    @if($log->jenis == 'masuk')
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[9px] font-black uppercase rounded-full border border-green-100 italic">Material In</span>
                                    @elseif($log->jenis == 'keluar')
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-full border border-blue-100 italic">Material Out</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-50 text-red-600 text-[9px] font-black uppercase rounded-full border border-red-100 italic">Damaged/Reject</span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-center font-bold text-slate-800">
                                    {{ $log->jumlah }}
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase italic">
                                            {{ substr($log->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-[11px] font-bold text-slate-600 uppercase">{{ $log->user->name ?? 'System' }}</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-10 text-center text-xs text-slate-400 italic">Belum ada rekaman aktivitas logistik hari ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-layout>