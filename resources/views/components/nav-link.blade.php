@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pt-1 border-b-4 border-blue-700 text-xs font-black leading-5 text-slate-900 focus:outline-none transition duration-150 ease-in-out uppercase tracking-widest bg-slate-50'
            : 'inline-flex items-center px-4 pt-1 border-b-4 border-transparent text-xs font-bold leading-5 text-slate-500 hover:text-slate-700 hover:border-slate-300 focus:outline-none focus:text-slate-700 focus:border-slate-300 transition duration-150 ease-in-out uppercase tracking-widest';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>