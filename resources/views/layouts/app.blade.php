<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Sistem Monitoring | PT. AMN</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .sidebar-link-active { 
                background: linear-gradient(to right, #2563eb, #3b82f6); 
                color: white !important;
                box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
                border-radius: 1rem;
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 5px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900" x-data="{ mobileMenuOpen: false }">
        
        <div class="flex min-h-screen relative">
            
<aside 
    class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-100 transition-transform duration-300 transform md:relative md:translate-x-0 flex flex-col h-screen"
    :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <div class="h-20 flex-none flex items-center px-8 border-b border-slate-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-black shadow-lg shadow-blue-200">A</div>
            <span class="font-black tracking-tighter text-xl text-slate-800 uppercase">PT. AMN</span>
        </div>
        <button @click="mobileMenuOpen = false" class="md:hidden ml-auto text-slate-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="flex-grow px-4 py-6 overflow-y-auto space-y-8">
        <nav class="space-y-2">
            <div class="px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4 italic">Main Menu</div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Monitoring Dashboard
            </a>

            @if(Auth::user()->role == 1 || Auth::user()->role == 3)
            <div class="pt-6 px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4 italic">Operations</div>
            
            <a href="{{ route('attendance.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('attendance.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Sistem Presensi
            </a>

            <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('transactions.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                Logistik In/Out
            </a>

            <a href="{{ route('damage.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('damage.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Laporan Kerusakan
            </a>
            @endif

            @if(Auth::user()->role >= 2)
            <div class="pt-6 px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4 italic">Management & Analysis</div>
            
            <a href="{{ route('items.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('items.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Daftar Harga & Stok
            </a>

            <a href="{{ route('laporan.aktivitas') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('laporan.aktivitas') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5m11 0h2a4 4 0 014 4v2m-6-10V7a2 2 0 00-2-2H9a2 2 0 00-2 2v2m7 0h-4"></path></svg>
                Laporan Aktivitas
            </a>

            @if(Auth::user()->role == 2)
            <a href="{{ route('attendance.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('attendance.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Rekap Presensi Staff
            </a>
            @endif
            @endif

            @if(Auth::user()->role == 3)
            <div class="pt-6 px-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4 italic">Control Panel</div>
            <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-300 {{ request()->routeIs('users.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manajemen Karyawan
            </a>
            @endif
        </nav>
    </div>

    <div class="flex-none p-6 bg-slate-50/80 border-t border-slate-100">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-blue-400 rounded-full border-2 border-white shadow-md flex items-center justify-center font-bold text-white uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black text-slate-800 truncate uppercase">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 font-bold uppercase italic">
                    @if(Auth::user()->role == 1) Staff Karyawan @elseif(Auth::user()->role == 2) Supervisor @else Superadmin @endif
                </p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V7m0 10a3 3 0 01-3 3h-3a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3"></path></svg>
                Keluar Sistem
            </button>
        </form>
    </div>
</aside>

            <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">
                
                <header class="sticky top-0 z-30 h-20 glass-effect border-b border-slate-100 flex items-center justify-between px-6 md:px-10">
                    <div class="flex items-center gap-4">
                        <button @click="mobileMenuOpen = true" class="md:hidden p-2 bg-slate-50 rounded-lg text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        </button>
                        <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] italic">
                            @yield('page_title', 'Operational System')
                        </h2>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden md:flex flex-col items-end">
                            <span class="text-[10px] font-black text-slate-800 uppercase tracking-tighter">PT. AMN Manufacturing</span>
                            <span class="text-[9px] text-green-500 font-bold uppercase italic">Server: Online</span>
                        </div>
                    </div>
                </header>

                <main class="p-6 md:p-10 max-w-7xl">
                    {{ $slot }}
                </main>
            </div>

            <div 
                x-show="mobileMenuOpen" 
                @click="mobileMenuOpen = false" 
                class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 md:hidden"
                x-transition:enter="transition opacity-0 duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity-100 duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>

        </div>

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>