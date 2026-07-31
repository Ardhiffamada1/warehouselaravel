<x-app-layout>
    @section('page_title', 'Operasional Logistik')

    <div class="max-w-5xl mx-auto space-y-6 animate-fade-in" x-data="{ openModal: false }">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Stok Barang</h2>
                <p class="text-xs text-slate-500 font-medium italic">Catat arus masuk dan keluar barang secara akurat</p>
            </div>
            
            <button @click="openModal = true" class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all shadow-sm active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Material Baru
            </button>
        </div>

        @if(session('success'))
            <div class="bg-blue-600 text-white p-4 rounded-xl flex items-center gap-3 shadow-lg animate-bounce-short">
                <p class="text-[10px] font-black uppercase tracking-widest italic">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-100 p-4 rounded-xl">
                <p class="text-[10px] font-black text-red-600 uppercase mb-2">Terjadi Kesalahan Input:</p>
                <ul class="list-disc list-inside text-[9px] text-red-500 font-bold">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Input Pergerakan Barang</span>
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-tighter bg-blue-50 px-2 py-1 rounded-md">Live Update</span>
            </div>

            <form action="{{ route('transactions.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Komponen</label>
                    <select name="item_id" class="w-full border-slate-200 bg-slate-50 text-sm font-bold rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->kode_barang }} — {{ $item->nama_barang }} (Tersedia: {{ $item->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Jenis Arus</label>
                        <select name="jenis" class="w-full border-slate-200 bg-slate-50 text-sm font-bold rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                            <option value="masuk">Penerimaan (+)</option>
                            <option value="keluar">Pengeluaran (-)</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Jumlah Unit</label>
                        <input type="number" name="jumlah" required placeholder="0" class="w-full border-slate-200 bg-slate-50 text-sm font-bold rounded-xl focus:border-blue-600 focus:ring-0 transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-slate-900 text-white font-black text-[10px] py-4 uppercase tracking-[0.2em] rounded-xl hover:bg-blue-600 transition-all shadow-md active:scale-[0.99]">
                        Simpan Data Transaksi
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mt-6">
            <div class="px-6 py-4 border-b border-slate-50">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">5 Transaksi Terakhir Kamu</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11px] italic">
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentTransactions as $rt)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="px-6 py-3 font-bold text-slate-800">{{ $rt->item->nama_barang }}</td>
                            <td class="px-6 py-3">
                                <span class="{{ $rt->jenis == 'masuk' ? 'text-green-600' : 'text-blue-600' }} font-black uppercase">
                                    {{ $rt->jenis == 'masuk' ? '+' : '-' }} {{ $rt->jumlah }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-slate-400">{{ $rt->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td class="px-6 py-8 text-center text-slate-400">Belum ada aktivitas hari ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm" x-cloak>
            <div @click.away="openModal = false" class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden animate-fade-in">
                <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest italic">Registrasi Material Baru</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form action="{{ route('transactions.storeMaterial') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Serial Otomatis</label>
                            <input type="text" name="kode_barang" value="{{ $autoCode }}" readonly class="w-full border-none bg-slate-100 text-xs font-black text-slate-500 rounded-xl cursor-not-allowed">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nama Material</label>
                            <input type="text" name="nama_barang" required class="w-full border-slate-200 bg-slate-50 text-xs font-bold rounded-xl focus:border-blue-600 focus:ring-0 uppercase py-3">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Harga Satuan (Rp)</label>
                        <input type="number" name="harga_satuan" required placeholder="Masukkan nominal tanpa titik" class="w-full border-slate-200 bg-slate-50 text-xs font-bold rounded-xl focus:border-blue-600 focus:ring-0 py-3">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Stok Awal</label>
                            <input type="number" name="stok" value="0" class="w-full border-slate-200 bg-slate-50 text-xs font-bold rounded-xl focus:border-blue-600 focus:ring-0 py-3">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Stok Minimum</label>
                            <input type="number" name="stok_minimum" value="5" class="w-full border-slate-200 bg-slate-50 text-xs font-bold rounded-xl focus:border-blue-600 focus:ring-0 py-3">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white text-[10px] font-black py-4 uppercase tracking-[0.2em] rounded-xl hover:bg-slate-900 transition-all mt-4 shadow-lg shadow-blue-200">
                        Daftarkan Komponen Sekarang
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center text-[9px] font-bold text-slate-300 uppercase tracking-[0.4em] italic">PT. Andalan Manufaktur Nusantara</p>
    </div>
</x-app-layout>