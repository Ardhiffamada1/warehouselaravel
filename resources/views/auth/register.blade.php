<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white/90 backdrop-blur-md shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden sm:rounded-[2.5rem] border border-white">
        
        <div class="flex flex-col items-center mb-10 text-center">
            <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center shadow-2xl shadow-slate-200 mb-5 text-blue-500">
                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tighter uppercase leading-none">Registrasi Akun</h2>
            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.3em] mt-3">Sistem Monitoring Produksi PT. AMN</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 px-1">Nama Lengkap</label>
                <x-text-input id="name" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-[11px]" />
            </div>

            <div>
                <label for="email" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 px-1">Email Corporate</label>
                <x-text-input id="email" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[11px]" />
            </div>

            <div>
                <label for="password" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 px-1">Password</label>
                <x-text-input id="password" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[11px]" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 px-1">Konfirmasi Password</label>
                <x-text-input id="password_confirmation" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm" type="password" name="password_confirmation" required />
            </div>

            <div class="pt-4 space-y-4">
                <button type="submit" class="w-full py-4 bg-slate-900 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-blue-600 transition-all shadow-xl active:scale-[0.98]">
                    Daftar Akun Baru
                </button>
                <a href="{{ route('login') }}" class="block text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600">Sudah Punya Akun? Login</a>
            </div>
        </form>
    </div>
</x-guest-layout>