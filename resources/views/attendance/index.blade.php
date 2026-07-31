<x-app-layout>
    @section('page_title', 'Presensi & Log Kehadiran')

    <div class="space-y-8 animate-fade-in">
        
        @if(session('success') || session('error'))
            <div class="fixed top-24 right-10 z-50 min-w-[300px] animate-bounce-short">
                @if(session('success'))
                    <div class="bg-blue-600 text-white p-5 rounded-2xl shadow-2xl flex items-center gap-4 border border-blue-400">
                        <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center font-bold">✓</div>
                        <span class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</span>
                    </div>
                @else
                    <div class="bg-red-600 text-white p-5 rounded-2xl shadow-2xl flex items-center gap-4 border border-red-400">
                        <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center font-bold">!</div>
                        <span class="text-[10px] font-black uppercase tracking-widest">{{ session('error') }}</span>
                    </div>
                @endif
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2.5rem] p-10 shadow-xl shadow-slate-200/50">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="space-y-3">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/20 border border-blue-400/30 rounded-full text-[9px] font-black text-blue-300 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span> Waktu Server Real-Time
                        </div>
                        <h3 class="text-white text-3xl font-light tracking-tight italic">{{ date('l, d F Y') }}</h3>
                        <div id="digital-clock" class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-white font-mono tracking-tighter">
                            00:00:00
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-4">
                        @if(!Auth::user()->hasAttendedToday())
                            <form action="{{ route('attendance.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="group relative px-12 py-5 bg-blue-600 text-white font-black text-[11px] uppercase tracking-[0.3em] rounded-2xl shadow-2xl shadow-blue-500/40 hover:bg-white hover:text-blue-600 transition-all duration-500 active:scale-95">
                                    <span class="relative z-10">Absen Masuk Sekarang</span>
                                </button>
                            </form>
                        @else
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center border border-green-500/30 mb-3">
                                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-[10px] font-black text-green-400 uppercase tracking-[0.2em] italic">Kehadiran Terverifikasi</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-[0.05] text-white">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-[2.5rem] p-10 flex flex-col justify-center items-center text-center shadow-sm group hover:shadow-xl transition-all duration-500">
                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-10 h-10 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">
                    {{ Auth::user()->role >= 2 ? 'Total Staff Hadir Hari Ini' : 'Rekaman Hadir Pribadi' }}
                </span>
                <p class="text-5xl font-light text-slate-800 tracking-tighter">
                    @if(Auth::user()->role >= 2)
                        {{ $attendances->where('tanggal', date('Y-m-d'))->where('status', 'hadir')->count() }}
                    @else
                        {{ $attendances->where('user_id', Auth::id())->where('status', 'hadir')->count() }}
                    @endif
                </p>
                <div class="w-12 h-1 bg-blue-600 rounded-full my-4"></div>
                <p class="text-[9px] font-bold text-slate-300 uppercase italic tracking-widest">Data Real-Time AMN</p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200/50">
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-white">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-slate-900 rounded-full"></div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest italic font-mono">
                        {{ Auth::user()->role >= 2 ? 'Log Monitoring Presensi Seluruh Staff' : 'Riwayat Presensi Saya' }}
                    </h4>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Server: {{ config('app.name') }}</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-10 py-5 italic">Nama Karyawan</th>
                            <th class="px-10 py-5">Tanggal</th>
                            <th class="px-10 py-5 text-center">Waktu Masuk</th>
                            <th class="px-10 py-5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600 font-medium italic">
                        @forelse($attendances as $absen)
                            @if(Auth::user()->role >= 2 || $absen->user_id == Auth::id())
                            <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-400 text-[10px] border border-slate-200">
                                            {{ substr($absen->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="font-black text-slate-800 text-sm uppercase group-hover:text-blue-600 transition-colors">
                                            {{ $absen->user->name ?? 'Unknown User' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-xs text-slate-400 font-bold uppercase tracking-tighter">
                                    {{ date('d M Y', strtotime($absen->tanggal)) }}
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <span class="font-mono text-sm font-black text-slate-800">
                                        {{ $absen->jam_masuk ?? '--:--' }}
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    @if($absen->status == 'hadir')
                                        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-green-50 text-green-600 text-[9px] font-black uppercase rounded-xl border border-green-100 shadow-sm shadow-green-200/50">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-50 text-red-600 text-[9px] font-black uppercase rounded-xl border border-red-100 animate-pulse">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Alpha / Mangkir
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @empty
                        <tr>
                            <td colspan="4" class="px-10 py-16 text-center text-xs text-slate-400 uppercase font-black tracking-[0.3em] italic">Belum Ada Rekaman Presensi Hari Ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                               now.getMinutes().toString().padStart(2, '0') + ':' + 
                               now.getSeconds().toString().padStart(2, '0');
            document.getElementById('digital-clock').textContent = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>