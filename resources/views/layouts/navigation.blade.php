<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 relative z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center pr-6 border-r border-slate-100">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-800 flex items-center justify-center rounded-none shadow-inner">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="font-extrabold text-slate-700 tracking-tighter uppercase">PT. AMN System</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-600 border-b-2 border-blue-500 font-bold uppercase text-[11px] tracking-widest px-4">
                        {{ __('Inventory Monitor') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center px-4 py-2 border border-slate-200 bg-slate-50 text-slate-600 hover:bg-white transition-colors rounded-none focus:outline-none">
                                <div class="text-right mr-3">
                                    <p class="text-[10px] font-bold uppercase tracking-tight leading-none mb-1">{{ Auth::user()->name }}</p>
                                    <p class="text-[9px] text-slate-400 font-medium">Internal Staff</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="rounded-none border border-slate-200 bg-white">
                                <x-dropdown-link :href="route('profile.edit')" class="text-xs font-bold text-slate-600 hover:bg-slate-50 rounded-none">
                                    {{ __('Account Settings') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="text-xs font-bold text-red-500 hover:bg-red-50 rounded-none uppercase" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Terminasi Sesi') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>