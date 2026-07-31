<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0  industrial-grid">
        <div>
            <div class="flex flex-col items-center mb-10 text-center">
                <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center shadow-2xl shadow-slate-200 mb-5">
                    <svg class="w-9 h-9 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter uppercase leading-none">Portal Monitoring</h2>
                <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.3em] mt-3">PT. Andalan Manufaktur Nusantara</p>
            </div>

            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 px-1">Email Corporate</label>
                    <x-text-input id="email" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="name@andalan.co.id" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-[11px] font-medium" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 px-1">
                        <label for="password" class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Akses Kredensial</label>
                        @if (Route::has('password.request'))
                            <a class="text-[9px] font-bold text-blue-600 hover:underline uppercase tracking-tight" href="{{ route('password.request') }}">Lupa?</a>
                        @endif
                    </div>
                    <x-text-input id="password" class="block w-full border-slate-200 focus:border-blue-600 focus:ring-0 rounded-xl bg-slate-50/50 py-3.5 text-sm transition-all" type="password" name="password" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-[11px] font-medium" />
                </div>

                <div class="flex items-center px-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 focus:ring-0 w-4 h-4 transition-all" name="remember">
                        <span class="ms-3 text-[11px] font-bold text-slate-400 group-hover:text-slate-600 transition-colors uppercase tracking-wide">Ingat Sesi Saya</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center py-4 bg-slate-900 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-[0.98]">
                        Otorisasi Masuk
                    </button>
                </div>
            </form>
            
            <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col items-center">
                <p class="text-[9px] font-bold text-slate-300 uppercase tracking-[0.4em] mb-4 text-center">Secure Digital Transformation</p>
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-full border border-slate-100">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <p class="text-[10px] font-black text-slate-500 tracking-tight">MakeItAll Easy Software House</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .industrial-grid {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</x-guest-layout>