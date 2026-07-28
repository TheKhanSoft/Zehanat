@props([
    'title',
    'value',
    'icon',
    'trend' => null,
    'meta' => null,
    'color' => 'teal',
    'href' => null,
])

@php
    $namedIcon = match($icon) {
        'mail' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.57 5.27a2.25 2.25 0 0 1-2.36 0L2.25 6.75" /></svg>',
        'check' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 12.75 2.25 2.25L15 9.75m6 2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
        'shield' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2.25c2.1 2.02 4.73 3 7.5 3v5.25c0 4.74-3.08 8.93-7.5 10.5-4.42-1.57-7.5-5.76-7.5-10.5V5.25c2.77 0 5.4-.98 7.5-3Z" /></svg>',
        'sparkles' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.81 3.64c.08-.35.58-.35.66 0l.31 1.39a6.04 6.04 0 0 0 4.59 4.59l1.39.31c.35.08.35.58 0 .66l-1.39.31a6.04 6.04 0 0 0-4.59 4.59l-.31 1.39c-.08.35-.58.35-.66 0l-.31-1.39A6.04 6.04 0 0 0 4.9 10.9l-1.39-.31c-.35-.08-.35-.58 0-.66l1.39-.31a6.04 6.04 0 0 0 4.59-4.59l.31-1.39ZM18.25 15.75l.14.63a2.75 2.75 0 0 0 2.09 2.09l.63.14-.63.14a2.75 2.75 0 0 0-2.09 2.09l-.14.63-.14-.63a2.75 2.75 0 0 0-2.09-2.09l-.63-.14.63-.14a2.75 2.75 0 0 0 2.09-2.09l.14-.63Z" /></svg>',
        'key' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>',
        'shield-check' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75m5.25-4.5c-2.76 0-5.216-1.295-6.792-3.31a1.124 1.124 0 0 0-1.916 0C9.966 3.955 7.51 5.25 4.75 5.25c-.621 0-1.125.504-1.125 1.125V9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622V6.375c0-.621-.504-1.125-1.125-1.125Z" /></svg>',
        default => null,
    };

    $colorClasses = match($color) {
        'teal' => 'bg-teal-500/10 text-teal-400 border-teal-500/20 group-hover:bg-teal-500/20',
        'amber' => 'bg-amber-500/10 text-amber-400 border-amber-500/20 group-hover:bg-amber-500/20',
        'rose' => 'bg-rose-500/10 text-rose-400 border-rose-500/20 group-hover:bg-rose-500/20',
        'blue' => 'bg-blue-500/10 text-blue-400 border-blue-500/20 group-hover:bg-blue-500/20',
        'cyan' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20 group-hover:bg-cyan-500/20',
        'sky' => 'bg-sky-500/10 text-sky-400 border-sky-500/20 group-hover:bg-sky-500/20',
        'indigo' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 group-hover:bg-indigo-500/20',
        'emerald' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 group-hover:bg-emerald-500/20',
        'purple' => 'bg-purple-500/10 text-purple-400 border-purple-500/20 group-hover:bg-purple-500/20',
        'violet' => 'bg-violet-500/10 text-violet-400 border-violet-500/20 group-hover:bg-violet-500/20',
        default => 'bg-teal-500/10 text-teal-400 border-teal-500/20 group-hover:bg-teal-500/20',
    };

    $glowClass = match($color) {
        'amber' => 'bg-amber-400/15',
        'rose' => 'bg-rose-400/15',
        'cyan', 'sky', 'blue' => 'bg-cyan-400/15',
        'indigo', 'purple', 'violet' => 'bg-violet-400/15',
        'emerald' => 'bg-emerald-400/15',
        default => 'bg-teal-400/15',
    };
@endphp

<div class="admin-panel group relative overflow-hidden p-5 transition-all duration-300 hover:-translate-y-0.5 hover:border-slate-600 hover:shadow-2xl hover:shadow-slate-950/30">
    <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full opacity-60 blur-3xl {{ $glowClass }}"></div>
    <div class="flex items-start justify-between">
        <div class="relative min-w-0">
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.12em] text-slate-500 transition-colors group-hover:text-slate-400">{{ $title }}</p>
            <h3 class="text-3xl font-black tracking-tight text-white">{{ $value }}</h3>
            
            @if($trend)
                <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
                    @if(str_starts_with($trend, '+'))
                        <span class="flex items-center gap-1 rounded-full bg-emerald-400/10 px-2 py-1 font-bold text-emerald-300">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m5 12 7-7 7 7M12 5v14" /></svg>
                            {{ $trend }}
                        </span>
                    @elseif(str_starts_with($trend, '-'))
                        <span class="flex items-center gap-1 rounded-full bg-rose-400/10 px-2 py-1 font-bold text-rose-300">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m19 12-7 7-7-7m7 7V5" /></svg>
                            {{ $trend }}
                        </span>
                    @else
                        <span class="rounded-full bg-slate-800 px-2 py-1 font-bold text-slate-400">{{ $trend }}</span>
                    @endif
                    @if($meta)
                        <span class="text-slate-500">{{ $meta }}</span>
                    @endif
                </div>
            @elseif($meta)
                <p class="mt-3 text-xs font-medium text-slate-500">{{ $meta }}</p>
            @endif
        </div>
        
        <div class="relative flex h-12 w-12 flex-none items-center justify-center rounded-2xl border text-2xl shadow-inner transition-all duration-300 group-hover:scale-105 {{ $colorClasses }}">
            @if($namedIcon)
                {!! $namedIcon !!}
            @elseif(preg_match('/<svg|<\/svg>/i', $icon))
                <div class="w-6 h-6">{!! $icon !!}</div>
            @else
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 19.5v-6m5 6v-10m5 10v-4m5 4V5.5" /></svg>
            @endif
        </div>
    </div>
    @if($href)
        <a href="{{ $href }}" class="absolute inset-0 rounded-2xl focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-400" aria-label="Open {{ $title }}"></a>
        <svg class="pointer-events-none absolute bottom-5 right-5 h-4 w-4 text-slate-700 transition-all group-hover:translate-x-0.5 group-hover:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
    @endif
</div>
