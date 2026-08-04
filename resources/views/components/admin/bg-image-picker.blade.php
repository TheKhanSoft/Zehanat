@props([
    'modelPrefix' => 'sectionContent',
    'imageKey' => 'bg_image',
    'colorKey' => 'bg_overlay_color',
    'opacityKey' => 'bg_overlay_opacity',
    'targetEvent' => 'media-selected-homepage-flat'
])

<div class="relative overflow-hidden rounded-2xl border border-slate-700/60 bg-gradient-to-b from-slate-900/60 to-slate-900/20 p-5 shadow-sm backdrop-blur-sm">
    {{-- Decorative subtle glow --}}
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-start gap-6">

        {{-- Live Thumbnail Preview (Left) --}}
        <div class="flex-none flex flex-col gap-2">
            <div
                x-data
                class="relative w-40 h-28 rounded-xl overflow-hidden border border-slate-700/80 bg-slate-950 shadow-inner shrink-0 group"
            >
                {{-- Checkerboard pattern for transparency visualization --}}
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjMWUxZTI0IiAvPgo8cmVjdCB4PSI0IiB5PSI0IiB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjMWUxZTI0IiAvPgo8L3N2Zz4=')] opacity-50"></div>

                {{-- Background image layer --}}
                <div
                    class="absolute inset-0 bg-cover bg-center transition-all duration-500 ease-out"
                    x-bind:style="'background-image: url(\'' + ($wire.get('{{ $modelPrefix }}.{{ $imageKey }}') || '') + '\')'"
                ></div>

                {{-- Overlay color layer --}}
                <div
                    class="absolute inset-0 transition-all duration-300 ease-in-out mix-blend-multiply"
                    x-bind:style="'background-color:' + ($wire.get('{{ $modelPrefix }}.{{ $colorKey }}') || '#000000') + '; opacity:' + (($wire.get('{{ $modelPrefix }}.{{ $opacityKey }}') || 0) / 100)"
                ></div>

                {{-- Empty state placeholder --}}
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 transition-opacity duration-300 bg-slate-900/80 backdrop-blur-sm"
                    x-bind:style="($wire.get('{{ $modelPrefix }}.{{ $imageKey }}')) ? 'opacity:0;pointer-events:none' : 'opacity:1'"
                >
                    <svg class="w-6 h-6 mb-1.5 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">No Image</span>
                </div>

                {{-- Preview badge --}}
                <div class="absolute top-2 left-2 flex items-center gap-1.5 bg-black/60 backdrop-blur-md border border-white/10 px-2 py-0.5 rounded text-white shadow-lg pointer-events-none">
                    <div class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-pulse"></div>
                    <span class="text-[8px] font-black uppercase tracking-widest text-white/90">Preview</span>
                </div>
            </div>
            
            <div class="text-center">
                <button type="button" wire:click="$set('{{ $modelPrefix }}.{{ $imageKey }}', '')" class="text-[10px] font-bold uppercase tracking-wider text-rose-400 hover:text-rose-300 transition-colors inline-flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Clear Image
                </button>
            </div>
        </div>

        {{-- Controls (Right) --}}
        <div class="flex-1 min-w-0 space-y-5">
            
            {{-- URL Input Group --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400">Background Source</label>
                </div>
                <div class="flex shadow-sm rounded-xl overflow-hidden border border-slate-700/80 bg-slate-900/50 focus-within:border-teal-500/70 focus-within:ring-4 focus-within:ring-teal-500/10 transition-all duration-200">
                    <div class="flex items-center justify-center pl-3.5 pr-2 bg-slate-900/50 text-slate-500">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <input
                        type="text"
                        wire:model.lazy="{{ $modelPrefix }}.{{ $imageKey }}"
                        placeholder="/images/path/to/image.jpg"
                        class="flex-1 min-w-0 bg-transparent px-2 py-2.5 text-sm text-white placeholder:text-slate-600 outline-none font-mono"
                    >
                    <div class="w-px bg-slate-700/50 my-1"></div>
                    <button
                        type="button"
                        wire:click="$dispatch('open-media-picker', { targetEvent: '{{ $targetEvent }}', params: '{{ $imageKey }}' })"
                        class="flex items-center gap-1.5 px-4 bg-slate-800 hover:bg-teal-500 hover:text-white text-slate-300 font-semibold text-xs transition-colors duration-200 whitespace-nowrap"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Browse
                    </button>
                </div>
            </div>

            {{-- Overlay Controls --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-900/30 p-4 rounded-xl border border-slate-700/40">
                {{-- Color --}}
                <div>
                    <label class="block mb-2 text-[10px] uppercase font-bold text-slate-500 tracking-wider">Overlay Color</label>
                    <div class="flex items-center gap-3">
                        <div class="relative flex-none w-9 h-9 rounded-lg overflow-hidden border-2 border-slate-700 shadow-inner group-hover:border-teal-500 transition-colors">
                            <input type="color" wire:model.live="{{ $modelPrefix }}.{{ $colorKey }}" class="absolute -top-2 -left-2 w-14 h-14 cursor-pointer">
                        </div>
                        <input type="text" wire:model="{{ $modelPrefix }}.{{ $colorKey }}" class="flex-1 w-full rounded-lg border border-slate-700/60 bg-slate-950/60 px-3 py-1.5 text-xs text-white outline-none focus:border-teal-500 font-mono uppercase transition-colors" placeholder="#000000">
                    </div>
                </div>
                
                {{-- Opacity --}}
                <div>
                    <label class="block mb-2 text-[10px] uppercase font-bold text-slate-500 tracking-wider flex justify-between">
                        <span>Overlay Opacity</span>
                        <span class="text-teal-400"><span x-data x-text="$wire.get('{{ $modelPrefix }}.{{ $opacityKey }}') || 0"></span>%</span>
                    </label>
                    <div class="flex items-center h-9">
                        <input type="range" min="0" max="100" step="5" wire:model.live="{{ $modelPrefix }}.{{ $opacityKey }}" class="w-full accent-teal-500 cursor-ew-resize">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
