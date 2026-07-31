<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Informasi Monitoring Produksi | PT. AMN</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .bg-grid {
                background-image: linear-gradient(to right, #e2e8f0 1px, transparent 1px),
                                  linear-gradient(to bottom, #e2e8f0 1px, transparent 1px);
                background-size: 40px 40px;
            }
        </style>
    </head>
    <body class="bg-white text-slate-900 antialiased bg-grid">

        <div class="relative min-h-screen flex items-center justify-center p-6">
            
            <main class="w-full max-w-5xl bg-white border border-slate-300 shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
                
                <div class="flex-1 p-10 md:p-16 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-12 border-l-4 border-slate-900 pl-4">
                            <div>
                                <h2 class="font-bold text-xl tracking-tighter text-slate-900 uppercase">PT. Andalan Manufaktur Nusantara</h2>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Inventory Management Division</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h1 class="text-4xl font-extrabold text-slate-900 leading-tight">
                                Sistem Informasi <br>
                                <span class="text-blue-600 uppercase">Monitoring Stok Produksi.</span>
                            </h1>
                            
                            <div class="h-1 w-20 bg-slate-900"></div>

                            <p class="text-slate-600 text-sm leading-relaxed text-justify max-w-md">
                                Aplikasi ini dirancang untuk melakukan digitalisasi pencatatan arus barang masuk dan keluar secara real-time. Fokus utama sistem mencakup pengendalian stok minimum, valuasi aset gudang, dan pelaporan log aktivitas operasional guna mendukung efisiensi manufaktur pada PT. AMN.
                            </p>
                        </div>

                        <div class="mt-10 grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-[11px] font-bold text-slate-700 uppercase italic">Real-Time Monitoring</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-[11px] font-bold text-slate-700 uppercase italic">Audit Log Activity</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-[11px] font-bold text-slate-700 uppercase italic">Automated Reporting</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-[11px] font-bold text-slate-700 uppercase italic">Asset Valuation</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white font-bold text-xs uppercase tracking-widest hover:bg-blue-600 transition-all rounded-lg">
                                Masuk ke Sistem
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-blue-600 text-white font-bold text-xs uppercase tracking-widest hover:bg-slate-900 transition-all rounded-lg shadow-lg shadow-blue-200">
                                Otorisasi Akun Karyawan
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="hidden md:flex w-[35%] bg-slate-50 border-l border-slate-200 flex-col justify-center p-12 text-center">
                    <div class="space-y-8">
                        <div class="flex justify-center">
                            <div class="w-24 h-24 bg-white border border-slate-300 rounded-3xl flex items-center justify-center shadow-sm">
                                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-slate-900 font-bold uppercase tracking-widest text-sm">Main Terminal</h3>
                            <p class="text-slate-400 text-[10px] font-bold uppercase">Authorized Personnel Only</p>
                        </div>
                        <div class="pt-8 border-t border-slate-200">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Developer by:</p>
                            <p class="text-[10px] font-bold text-slate-800 uppercase tracking-tighter">MakeItAllEasy Software House</p>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        
        <div class="fixed bottom-6 left-0 right-0 text-center">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.5em]">
                &copy; {{ date('Y') }} PT. Andalan Manufaktur Nusantara — Manufacturing System v2.0
            </p>
        </div>
    </body>
</html>