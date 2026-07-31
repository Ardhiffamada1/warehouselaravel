<div class="bg-white border border-slate-200 shadow-sm p-8 mb-8 rounded-none">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Presensi Harian</h3>
            <p class="text-2xl font-light text-slate-800 tracking-tight">{{ date('d F Y') }}</p>
        </div>
        
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-black py-4 px-10 uppercase tracking-widest transition-all rounded-none shadow-lg shadow-blue-100">
                Catat Kehadiran Sekarang
            </button>
        </form>
    </div>
    
    <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-6">
        <div class="text-center p-4 bg-slate-50 border border-slate-100">
            <span class="text-[9px] font-bold text-slate-400 uppercase">Jam Masuk</span>
            <p class="text-lg font-bold text-slate-700 tracking-tighter">08:00 WIB</p>
        </div>
        <div class="text-center p-4 bg-slate-50 border border-slate-100">
            <span class="text-[9px] font-bold text-slate-400 uppercase">Status</span>
            <p class="text-lg font-bold text-green-600 tracking-tighter uppercase">On Time</p>
        </div>
    </div>
</div>