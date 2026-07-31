<x-app-layout>
    @section('page_title', 'Manajemen Akses Karyawan')

    <div class="space-y-10 animate-fade-in">
        
        <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-10 py-6 bg-slate-900 flex justify-between items-center italic">
                <div class="space-y-1">
                    <h3 class="text-white text-xs font-black uppercase tracking-[0.2em]">Registrasi Karyawan Baru</h3>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Otoritas Penuh PT. AMN</p>
                </div>
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="p-10">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic ml-1">Nama Lengkap</label>
                        <input type="text" name="name" required placeholder="NAMA LENGKAP" class="w-full border-slate-100 bg-slate-50/50 p-4 text-sm font-bold uppercase rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic ml-1">Email Corporate</label>
                        <input type="email" name="email" required placeholder="nama@amn.co.id" class="w-full border-slate-100 bg-slate-50/50 p-4 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic ml-1">Kata Sandi</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full border-slate-100 bg-slate-50/50 p-4 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest italic ml-1">Otoritas</label>
                        <select name="role" class="w-full border-slate-100 bg-slate-50/50 p-4 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition-all">
                            <option value="1">LEVEL 1 - STAFF</option>
                            <option value="2">LEVEL 2 - SUPERVISOR</option>
                            <option value="3">LEVEL 3 - SUPERADMIN</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-50 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white font-black text-[11px] py-4 px-12 uppercase tracking-[0.3em] rounded-2xl shadow-xl shadow-blue-500/20 hover:bg-slate-900 transition-all duration-300 transform active:scale-95">
                        Aktifkan User Baru
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200/50">
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-white">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest italic font-mono">Personel Terverifikasi</h4>
                </div>
                <div class="bg-slate-50 px-4 py-2 rounded-full border border-slate-100">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Total: {{ $users->count() }} Anggota</span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-10 py-5">Nama Karyawan</th>
                            <th class="px-10 py-5">Kontak Email</th>
                            <th class="px-10 py-5 text-center">Level Otoritas</th>
                            <th class="px-10 py-5 text-right">Status Akun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-slate-600">
                        @foreach($users as $user)
                        <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-800 text-sm uppercase italic tracking-tight group-hover:text-blue-600 transition-colors">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-xs font-medium text-slate-400 tracking-wide lowercase italic">{{ $user->email }}</td>
                            <td class="px-10 py-6 text-center">
                                @if($user->role == 3)
                                    <span class="px-4 py-1.5 bg-blue-600 text-white text-[9px] font-black uppercase rounded-xl shadow-lg shadow-blue-500/20">Superadmin</span>
                                @elseif($user->role == 2)
                                    <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-xl border border-blue-100">Supervisor</span>
                                @else
                                    <span class="px-4 py-1.5 bg-slate-50 text-slate-500 text-[9px] font-black uppercase rounded-xl border border-slate-100">Staff Unit</span>
                                @endif
                            </td>
                            <td class="px-10 py-6 text-right">
                                <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green-600 text-[9px] font-black uppercase rounded-lg border border-green-100 italic tracking-tighter shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Aktif ✓
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>