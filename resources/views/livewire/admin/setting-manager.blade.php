<div>
    @section('title', 'Settings - Admin Panel')
    @section('page_title', 'Settings')

    <div class="space-y-6"
        x-data="{
            init() {
                document.addEventListener('modal:confirm', event => {
                    if (event.detail.action === 'perform-reset-defaults') {
                        @this.performResetDefaults(event.detail.params[0]);
                    }
                });
            }
        }">
        
        {{-- Page Header --}}
        <x-admin.page-header 
            title="System Settings" 
            description="Configure your website, email, appearance, and more"
            module="settings"
            icon="<svg class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.8' d='M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'></path><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.8' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'></path></svg>" />

        {{-- Tab Navigation Bar --}}
        <div class="flex overflow-x-auto border-b border-slate-700/60 pb-1 scrollbar-hide">
            <div class="flex space-x-1 min-w-max px-1">
                @php
                    $tabIcons = [
                        'general' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
                        'contact' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>',
                        'email' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                        'features' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>',
                        'seo' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>',
                        'appearance' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>',
                        'footer' => '<svg class="h-4.5 w-4.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>',
                    ];
                    $tabTitles = [
                        'general' => 'General',
                        'contact' => 'Contact & Social',
                        'email' => 'Email',
                        'features' => 'Features',
                        'seo' => 'SEO',
                        'appearance' => 'Appearance',
                        'footer' => 'Footer',
                    ];
                    $tabDescriptions = [
                        'general' => 'Basic site information and global configuration.',
                        'contact' => 'Contact details, address, and social media links.',
                        'email' => 'SMTP configuration and email delivery settings.',
                        'features' => 'Toggle and configure optional features across the platform.',
                        'seo' => 'Search engine optimization and meta data defaults.',
                        'appearance' => 'Customize the look, colors, and branding of the user interface.',
                        'footer' => 'Manage footer settings, dynamic links, background, and copyright.',
                    ];
                @endphp
                @foreach ($tabTitles as $tabKey => $tabName)
                    <button 
                        wire:click="switchTab('{{ $tabKey }}')"
                        class="flex items-center px-4 py-3 text-sm font-semibold transition-all rounded-t-xl focus:outline-none {{ $activeTab === $tabKey ? 'border-b-2 border-teal-400 text-teal-300 bg-slate-800/40' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/30' }}"
                    >
                        {!! $tabIcons[$tabKey] !!}
                        {{ $tabName }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Tab Content Card --}}
        <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
            {{-- Tab Header with save button --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-700/40 px-6 py-5 sm:px-8 gap-4">
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $tabTitles[$activeTab] }}</h3>
                    <p class="mt-1 text-sm text-slate-400">{{ $tabDescriptions[$activeTab] }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <button wire:click="resetToDefaults('{{ $activeTab }}')" class="px-4 py-2 text-sm font-semibold text-slate-300 bg-slate-800 border border-slate-700 rounded-xl hover:bg-slate-700 transition focus:outline-none focus:ring-4 focus:ring-slate-700/50">
                        Reset Defaults
                    </button>
                    <button wire:click="save" class="px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl shadow-lg shadow-teal-500/20 hover:from-teal-400 hover:to-cyan-400 transition hover:-translate-y-0.5 hover:shadow-teal-500/30 focus:outline-none focus:ring-4 focus:ring-teal-500/20">
                        Save Changes
                    </button>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-8 relative min-h-[400px]">
                {{-- Loading overlay --}}
                <div wire:loading wire:target="save, sendTestEmail, resetToDefaults, switchTab" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/40 backdrop-blur-sm rounded-b-3xl">
                    <div class="flex items-center gap-3 rounded-2xl bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-white shadow-2xl shadow-black/50 border border-slate-800">
                        <svg class="h-5 w-5 animate-spin text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    </div>
                </div>

                @if($activeTab === 'appearance')
                    {{-- Theme Palette Selector --}}
                    <div>
                        <h4 class="text-base font-semibold text-white mb-4">Theme Presets</h4>
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($this->themePalettes as $key => $palette)
                                @php
                                    $isSelected = ($settings['theme_active'] ?? 'default') === $key;
                                @endphp
                                <div wire:click="selectTheme('{{ $key }}')" class="relative cursor-pointer rounded-2xl border {{ $isSelected ? 'border-teal-400 bg-slate-800/80' : 'border-slate-700/60 bg-slate-950/40 hover:bg-slate-800/40 hover:border-slate-600' }} p-4 transition-all">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h5 class="text-sm font-bold text-white">{{ $palette['name'] }}</h5>
                                            <p class="text-xs text-slate-500 mt-0.5">{{ $palette['style'] }}</p>
                                        </div>
                                        @if($isSelected)
                                            <div class="h-5 w-5 rounded-full bg-teal-500 flex items-center justify-center">
                                                <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-4 flex gap-3">
                                        <div class="h-8 w-8 rounded-full shadow-inner" style="background-color: {{ $palette['primary'] }};" title="Primary: {{ $palette['primary'] }}"></div>
                                        <div class="h-8 w-8 rounded-full shadow-inner" style="background-color: {{ $palette['secondary'] }};" title="Secondary: {{ $palette['secondary'] }}"></div>
                                        <div class="h-8 w-8 rounded-full shadow-inner border border-slate-700" style="background-color: {{ $palette['dark'] }};" title="Dark: {{ $palette['dark'] }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr class="border-slate-700/60">
                @endif

                @if($activeTab === 'email')
                    {{-- Test Email Section --}}
                    <div class="rounded-2xl border border-cyan-400/20 bg-cyan-400/5 p-5 mb-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h4 class="text-sm font-bold text-cyan-300 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    Test Email Configuration
                                </h4>
                                <p class="text-xs text-cyan-200/70 mt-1">Send a test email using the current settings before saving.</p>
                            </div>
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <input wire:model="testEmailAddress" type="email" placeholder="Test recipient address" class="h-10 w-full sm:w-64 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10">
                                <button wire:click="sendTestEmail" class="h-10 px-4 whitespace-nowrap rounded-xl bg-cyan-500/20 text-cyan-300 border border-cyan-400/30 font-semibold text-sm hover:bg-cyan-500/30 transition">
                                    Send Test
                                </button>
                            </div>
                        </div>
                        @error('testEmailAddress') <p class="mt-2 text-xs text-rose-400">{{ $message }}</p> @enderror
                    </div>
                @endif

                {{-- Settings Form Grid --}}
                @if($activeTab === 'footer')
                    {{-- ═══════════════════════════════════════ --}}
                    {{-- FOOTER MANAGER – Premium Advanced UI  --}}
                    {{-- ═══════════════════════════════════════ --}}

                    {{-- Header Banner --}}
                    <div class="relative mb-8 rounded-2xl overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 border border-slate-700/50 shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/10 via-transparent to-second/10 pointer-events-none"></div>
                        <div class="absolute -top-10 -right-10 w-48 h-48 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="relative flex items-center gap-5 px-6 py-5">
                            <div class="flex-none h-12 w-12 rounded-2xl bg-gradient-to-br from-primary/20 to-second/20 border border-primary/30 flex items-center justify-center shadow-lg shadow-primary/10">
                                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-base font-extrabold text-white tracking-tight">Footer Layout Manager</h2>
                                <p class="text-xs text-slate-400 mt-0.5">Configure all 4 footer columns, contact info, background, and copyright.</p>
                            </div>
                            <div class="ml-auto hidden lg:flex items-center gap-2">
                                @foreach(['1','2','3','4'] as $col)
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-700/60 border border-slate-600/40 text-[11px] font-bold text-slate-300">
                                    <span class="h-2 w-2 rounded-full {{ ['bg-violet-400','bg-teal-400','bg-amber-400','bg-rose-400'][$loop->index] }}"></span>
                                    Col {{ $col }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Background Section (full width) --}}
                    <div class="mb-8 rounded-2xl border border-slate-700/60 bg-gradient-to-br from-slate-900 to-slate-800/60 overflow-hidden shadow-sm">
                        <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-700/50 bg-slate-800/40">
                            <div class="h-7 w-7 rounded-lg bg-indigo-500/20 border border-indigo-400/30 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="text-sm font-bold text-white">Background</span>
                                <span class="ml-2 text-[10px] px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 font-semibold border border-indigo-400/20">FULL WIDTH</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <x-admin.bg-image-picker modelPrefix="settings" imageKey="footer_bg_image" colorKey="footer_bg_overlay_color" opacityKey="footer_bg_overlay_opacity" targetEvent="media-selected-setting" />
                        </div>
                    </div>

                    {{-- 2-column grid for columns --}}
                    <div class="grid lg:grid-cols-2 gap-6">

                        {{-- ─── LEFT COLUMN ─── --}}
                        <div class="space-y-6">

                            {{-- Col 1: Brand --}}
                            <div class="rounded-2xl border border-violet-500/20 bg-gradient-to-br from-violet-500/5 via-slate-900 to-slate-800/60 overflow-hidden shadow-sm hover:border-violet-400/30 transition-colors">
                                <div class="flex items-center gap-3 px-5 py-3.5 border-b border-violet-500/10 bg-violet-500/5">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-violet-500/20 border border-violet-400/30 text-[10px] font-black text-violet-300">1</span>
                                    <div>
                                        <span class="text-sm font-bold text-white">Brand &amp; Overview</span>
                                        <span class="ml-2 text-[10px] text-violet-400/70">Col 1</span>
                                    </div>
                                    <div class="ml-auto">
                                        <svg class="w-4 h-4 text-violet-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    </div>
                                </div>
                                <div class="p-5 space-y-5">
                                    {{-- Logo --}}
                                    <div>
                                        <label class="block mb-3 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Footer Logo</label>
                                        <div class="flex items-start gap-4">
                                            <div class="flex-none h-20 w-24 rounded-xl border border-slate-700 bg-slate-950/80 flex items-center justify-center overflow-hidden">
                                                @if($settings['footer_logo'] ?? false)
                                                    <img src="{{ is_string($settings['footer_logo']) ? $settings['footer_logo'] : $settings['footer_logo']->temporaryUrl() }}" class="h-full w-full object-contain p-2" alt="Logo Preview">
                                                @else
                                                    <div class="text-center">
                                                        <svg class="w-6 h-6 text-slate-600 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                        <p class="text-[9px] text-slate-600 font-semibold">Site Logo</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 space-y-2">
                                                <input type="text" wire:model.lazy="settings.footer_logo" placeholder="e.g. /images/brand/logo.svg" class="w-full h-10 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 focus:border-violet-400 focus:ring-2 focus:ring-violet-400/10 outline-none transition">
                                                <div class="flex gap-2">
                                                    <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-setting', params: 'footer_logo' })" class="flex-1 h-9 flex items-center justify-center gap-2 rounded-xl bg-violet-500/10 border border-violet-400/30 text-violet-300 text-xs font-bold hover:bg-violet-500/20 transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                        Browse Media
                                                    </button>
                                                    @if($settings['footer_logo'] ?? false)
                                                    <button type="button" wire:click="$set('settings.footer_logo', '')" class="h-9 w-9 flex items-center justify-center rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 hover:bg-rose-500/20 transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                                    @endif
                                                </div>
                                                <p class="text-[10px] text-slate-600">Leave empty to auto-use the global site logo.</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Description --}}
                                    <div>
                                        <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tagline / Description</label>
                                        <textarea wire:model="settings.footer_description" rows="4" placeholder="Describe your organisation..." class="w-full resize-none rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm leading-relaxed text-white placeholder:text-slate-600 focus:border-violet-400 focus:ring-2 focus:ring-violet-400/10 outline-none transition"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Col 2: Quick Links --}}
                            <div class="rounded-2xl border border-teal-500/20 bg-gradient-to-br from-teal-500/5 via-slate-900 to-slate-800/60 overflow-hidden shadow-sm hover:border-teal-400/30 transition-colors">
                                <div class="flex items-center gap-3 px-5 py-3.5 border-b border-teal-500/10 bg-teal-500/5">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-teal-500/20 border border-teal-400/30 text-[10px] font-black text-teal-300">2</span>
                                    <div>
                                        <span class="text-sm font-bold text-white">Quick Links</span>
                                        <span class="ml-2 text-[10px] text-teal-400/70">Col 2</span>
                                    </div>
                                    <div class="ml-auto">
                                        <svg class="w-4 h-4 text-teal-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                </div>
                                <div class="p-5 space-y-4">
                                    <div>
                                        <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Column Heading</label>
                                        <input type="text" wire:model="settings.footer_col2_heading" placeholder="e.g. Quick Links" class="w-full h-10 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 focus:border-teal-400 focus:ring-2 focus:ring-teal-400/10 outline-none transition">
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Links</label>
                                            <span class="text-[10px] text-slate-600">{{ count($settings['footer_col2_links'] ?? []) }} item(s)</span>
                                        </div>
                                        <div class="space-y-2">
                                            @if(is_array($settings['footer_col2_links'] ?? null))
                                                @foreach($settings['footer_col2_links'] as $index => $item)
                                                    <div class="group flex items-center gap-2 rounded-xl border border-slate-700/60 bg-slate-950/40 p-2 hover:border-teal-500/30 transition-colors">
                                                        <div class="flex-none flex items-center justify-center h-6 w-6 rounded-md bg-teal-500/10 text-teal-400 text-[9px] font-black">{{ $index + 1 }}</div>
                                                        <input type="text" wire:model="settings.footer_col2_links.{{ $index }}.label" placeholder="Label" class="w-1/3 h-8 rounded-lg border border-slate-700/50 bg-slate-900 px-2.5 text-xs text-white focus:border-teal-400 outline-none">
                                                        <input type="text" wire:model="settings.footer_col2_links.{{ $index }}.url" placeholder="/url" class="flex-1 h-8 rounded-lg border border-slate-700/50 bg-slate-900 px-2.5 text-xs text-white focus:border-teal-400 outline-none font-mono">
                                                        <button type="button" wire:click="removeRepeaterItem('footer_col2_links', {{ $index }})" class="flex-none h-8 w-8 rounded-lg bg-rose-500/0 text-slate-600 group-hover:bg-rose-500/10 group-hover:text-rose-400 flex items-center justify-center transition-colors">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" wire:click="addRepeaterItem('footer_col2_links', { label: '', url: '' })" class="mt-3 w-full h-9 flex items-center justify-center gap-2 rounded-xl border border-dashed border-teal-500/30 text-teal-400/70 text-xs font-bold hover:border-teal-400/60 hover:text-teal-300 hover:bg-teal-500/5 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Add Link
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- ─── RIGHT COLUMN ─── --}}
                        <div class="space-y-6">

                            {{-- Col 3: Key Programs --}}
                            <div class="rounded-2xl border border-amber-500/20 bg-gradient-to-br from-amber-500/5 via-slate-900 to-slate-800/60 overflow-hidden shadow-sm hover:border-amber-400/30 transition-colors">
                                <div class="flex items-center gap-3 px-5 py-3.5 border-b border-amber-500/10 bg-amber-500/5">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-amber-500/20 border border-amber-400/30 text-[10px] font-black text-amber-300">3</span>
                                    <div>
                                        <span class="text-sm font-bold text-white">Key Programs</span>
                                        <span class="ml-2 text-[10px] text-amber-400/70">Col 3</span>
                                    </div>
                                    <div class="ml-auto">
                                        <svg class="w-4 h-4 text-amber-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                </div>
                                <div class="p-5 space-y-4">
                                    <div>
                                        <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Column Heading</label>
                                        <input type="text" wire:model="settings.footer_col3_heading" placeholder="e.g. Key Programs" class="w-full h-10 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/10 outline-none transition">
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Links</label>
                                            <span class="text-[10px] text-slate-600">{{ count($settings['footer_col3_links'] ?? []) }} item(s)</span>
                                        </div>
                                        <div class="space-y-2">
                                            @if(is_array($settings['footer_col3_links'] ?? null))
                                                @foreach($settings['footer_col3_links'] as $index => $item)
                                                    <div class="group flex items-center gap-2 rounded-xl border border-slate-700/60 bg-slate-950/40 p-2 hover:border-amber-500/30 transition-colors">
                                                        <div class="flex-none flex items-center justify-center h-6 w-6 rounded-md bg-amber-500/10 text-amber-400 text-[9px] font-black">{{ $index + 1 }}</div>
                                                        <input type="text" wire:model="settings.footer_col3_links.{{ $index }}.label" placeholder="Label" class="w-1/3 h-8 rounded-lg border border-slate-700/50 bg-slate-900 px-2.5 text-xs text-white focus:border-amber-400 outline-none">
                                                        <input type="text" wire:model="settings.footer_col3_links.{{ $index }}.url" placeholder="/url" class="flex-1 h-8 rounded-lg border border-slate-700/50 bg-slate-900 px-2.5 text-xs text-white focus:border-amber-400 outline-none font-mono">
                                                        <button type="button" wire:click="removeRepeaterItem('footer_col3_links', {{ $index }})" class="flex-none h-8 w-8 rounded-lg bg-rose-500/0 text-slate-600 group-hover:bg-rose-500/10 group-hover:text-rose-400 flex items-center justify-center transition-colors">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" wire:click="addRepeaterItem('footer_col3_links', { label: '', url: '' })" class="mt-3 w-full h-9 flex items-center justify-center gap-2 rounded-xl border border-dashed border-amber-500/30 text-amber-400/70 text-xs font-bold hover:border-amber-400/60 hover:text-amber-300 hover:bg-amber-500/5 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Add Link
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Col 4: Contact Info --}}
                            <div class="rounded-2xl border border-rose-500/20 bg-gradient-to-br from-rose-500/5 via-slate-900 to-slate-800/60 overflow-hidden shadow-sm hover:border-rose-400/30 transition-colors">
                                <div class="flex items-center gap-3 px-5 py-3.5 border-b border-rose-500/10 bg-rose-500/5">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-rose-500/20 border border-rose-400/30 text-[10px] font-black text-rose-300">4</span>
                                    <div>
                                        <span class="text-sm font-bold text-white">Contact Info</span>
                                        <span class="ml-2 text-[10px] text-rose-400/70">Col 4</span>
                                    </div>
                                    <div class="ml-auto">
                                        <svg class="w-4 h-4 text-rose-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                </div>
                                <div class="p-5 space-y-4">
                                    <div>
                                        <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Column Heading</label>
                                        <input type="text" wire:model="settings.footer_col4_heading" placeholder="e.g. Contact Us" class="w-full h-10 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 focus:border-rose-400 focus:ring-2 focus:ring-rose-400/10 outline-none transition">
                                    </div>
                                    <div class="h-px bg-slate-700/50"></div>
                                    <div class="space-y-3">
                                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest">Contact Details</label>
                                        {{-- Address --}}
                                        <div class="flex items-center gap-3 rounded-xl border border-slate-700/60 bg-slate-950/40 p-3 focus-within:border-rose-400/40 transition-colors">
                                            <div class="flex-none h-8 w-8 rounded-lg bg-rose-500/10 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-0.5">Address</p>
                                                <input type="text" wire:model="settings.contact_address" placeholder="Full address..." class="w-full bg-transparent text-sm text-white placeholder:text-slate-600 outline-none">
                                            </div>
                                        </div>
                                        {{-- Email --}}
                                        <div class="flex items-center gap-3 rounded-xl border border-slate-700/60 bg-slate-950/40 p-3 focus-within:border-rose-400/40 transition-colors">
                                            <div class="flex-none h-8 w-8 rounded-lg bg-rose-500/10 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-0.5">Email</p>
                                                <input type="email" wire:model="settings.contact_email" placeholder="info@example.com" class="w-full bg-transparent text-sm text-white placeholder:text-slate-600 outline-none">
                                            </div>
                                        </div>
                                        {{-- Phone --}}
                                        <div class="flex items-center gap-3 rounded-xl border border-slate-700/60 bg-slate-950/40 p-3 focus-within:border-rose-400/40 transition-colors">
                                            <div class="flex-none h-8 w-8 rounded-lg bg-rose-500/10 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-0.5">Phone</p>
                                                <input type="text" wire:model="settings.contact_phone" placeholder="+92 xxx xxxxxxx" class="w-full bg-transparent text-sm text-white placeholder:text-slate-600 outline-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Sub-Footer / Copyright --}}
                            <div class="rounded-2xl border border-slate-700/40 bg-gradient-to-br from-slate-800/50 to-slate-900 overflow-hidden shadow-sm">
                                <div class="flex items-center gap-3 px-5 py-3.5 border-b border-slate-700/40 bg-slate-800/30">
                                    <div class="h-7 w-7 rounded-lg bg-slate-700/60 border border-slate-600/40 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-white">Sub-Footer &amp; Copyright</span>
                                </div>
                                <div class="p-5">
                                    <label class="block mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Copyright Statement</label>
                                    <input type="text" wire:model="settings.footer_copyright_text" placeholder="e.g. Copyright &copy; 2025 Zehanat. All rights reserved." class="w-full h-10 rounded-xl border border-slate-700 bg-slate-950/80 px-3.5 text-sm text-white placeholder:text-slate-600 focus:border-slate-500 focus:ring-2 focus:ring-slate-500/10 outline-none transition">
                                    <p class="mt-2 text-[10px] text-slate-600">You can use HTML entities like <code class="text-slate-500">&amp;copy;</code> for ©</p>
                                </div>
                            </div>

                        </div>
                    </div>

                @else
                    <div class="grid gap-x-8 gap-y-6 lg:grid-cols-2">
                        @forelse($settingMeta as $key => $meta)
                        <div class="{{ in_array($meta['type'], ['textarea']) ? 'lg:col-span-2' : '' }}">
                            @if($meta['type'] === 'boolean' || $meta['type'] === 'toggle')
                                <div class="rounded-xl border border-slate-700 bg-slate-950/50 p-4">
                                    <label class="flex cursor-pointer items-center justify-between gap-4">
                                        <span>
                                            <span class="block text-sm font-semibold text-slate-200">{{ $meta['label'] }}</span>
                                            @if($meta['description'])
                                                <span class="mt-0.5 block text-xs text-slate-500">{{ $meta['description'] }}</span>
                                            @endif
                                        </span>
                                        <span class="relative inline-flex flex-none">
                                            <input type="checkbox" wire:model="settings.{{ $key }}" class="peer sr-only">
                                            <span class="h-7 w-12 rounded-full bg-slate-700 transition peer-checked:bg-teal-500 peer-focus:ring-4 peer-focus:ring-teal-500/15"></span>
                                            <span class="absolute left-1 top-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
                                        </span>
                                    </label>
                                </div>
                            @elseif($meta['type'] === 'textarea')
                                <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                <textarea 
                                    wire:model="settings.{{ $key }}" 
                                    id="setting-{{ $key }}" 
                                    rows="4" 
                                    class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-sm leading-6 text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                ></textarea>
                                @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                            @elseif($meta['type'] === 'textarea_code')
                                <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                <textarea 
                                    wire:model="settings.{{ $key }}" 
                                    id="setting-{{ $key }}" 
                                    rows="6" 
                                    class="w-full resize-y rounded-xl border border-slate-700 bg-[#0f111a] px-4 py-3 text-sm font-mono leading-6 text-emerald-400 placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                    spellcheck="false"
                                ></textarea>
                                @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror

                            @elseif($meta['type'] === 'image')
                                <label class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                <div class="flex items-start gap-4">
                                    <div class="relative h-20 w-20 flex-none overflow-hidden rounded-xl border border-slate-700 bg-slate-900 flex items-center justify-center">
                                        @if($settings[$key] && is_string($settings[$key]))
                                            <img src="{{ $settings[$key] }}" class="h-full w-full object-contain p-2" alt="Preview">
                                        @elseif($settings[$key] && !is_string($settings[$key]))
                                            <img src="{{ $settings[$key]->temporaryUrl() }}" class="h-full w-full object-contain p-2" alt="Preview">
                                        @else
                                            <svg class="h-8 w-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex gap-2 items-center mb-2">
                                            <input 
                                                wire:model.lazy="settings.{{ $key }}" 
                                                type="text" 
                                                placeholder="Image URL or Path"
                                                class="flex-1 rounded-xl border border-slate-700 bg-slate-950/80 px-4 py-2.5 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                                            >
                                            <button type="button" wire:click="$dispatch('open-media-picker', { targetEvent: 'media-selected-setting', params: '{{ $key }}' })" class="px-5 py-2.5 bg-slate-800 border border-slate-700 hover:border-teal-500 text-white font-semibold text-sm rounded-xl hover:bg-slate-700 transition shadow-sm">
                                                Browse Media
                                            </button>
                                        </div>
                                        @if($meta['description'])
                                            <p class="text-xs text-slate-400">{{ $meta['description'] }}</p>
                                        @endif
                                        @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                            @elseif($meta['type'] === 'repeater_social')
                                <div class="col-span-full">
                                    <label class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    @if($meta['description']) <p class="mb-4 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    
                                    <div class="space-y-3">
                                        @foreach($settings[$key] as $index => $item)
                                            <div class="flex items-center gap-3">
                                                <select wire:model="settings.{{ $key }}.{{ $index }}.platform" class="w-40 h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                                                    <option value="facebook">Facebook</option>
                                                    <option value="twitter">Twitter / X</option>
                                                    <option value="linkedin">LinkedIn</option>
                                                    <option value="instagram">Instagram</option>
                                                    <option value="youtube">YouTube</option>
                                                    <option value="whatsapp">WhatsApp</option>
                                                    <option value="tiktok">TikTok</option>
                                                    <option value="pinterest">Pinterest</option>
                                                    <option value="snapchat">Snapchat</option>
                                                    <option value="reddit">Reddit</option>
                                                    <option value="telegram">Telegram</option>
                                                    <option value="discord">Discord</option>
                                                    <option value="github">GitHub</option>
                                                    <option value="website">Website</option>
                                                </select>
                                                <input type="url" wire:model="settings.{{ $key }}.{{ $index }}.url" placeholder="Profile URL" class="flex-1 h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                                                <button type="button" wire:click="removeRepeaterItem('{{ $key }}', {{ $index }})" class="flex-none h-11 w-11 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition" title="Remove">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" wire:click="addRepeaterItem('{{ $key }}', { platform: 'facebook', url: '' })" class="mt-4 flex items-center gap-2 text-xs font-bold text-teal-400 hover:text-teal-300 transition-colors uppercase tracking-wider">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Add Network
                                    </button>
                                </div>
                                
                            @elseif($meta['type'] === 'repeater_links')
                                <div class="col-span-full">
                                    <label class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    @if($meta['description']) <p class="mb-4 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    
                                    <div class="space-y-3">
                                        @if(is_array($settings[$key]))
                                            @foreach($settings[$key] as $index => $item)
                                                <div class="flex items-center gap-3">
                                                    <input type="text" wire:model="settings.{{ $key }}.{{ $index }}.label" placeholder="Link Label (e.g. Home)" class="w-1/3 h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                                                    <input type="text" wire:model="settings.{{ $key }}.{{ $index }}.url" placeholder="URL (e.g. /about)" class="flex-1 h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10">
                                                    <button type="button" wire:click="removeRepeaterItem('{{ $key }}', {{ $index }})" class="flex-none h-11 w-11 flex items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition" title="Remove">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" wire:click="addRepeaterItem('{{ $key }}', { label: '', url: '' })" class="mt-4 flex items-center gap-2 text-xs font-bold text-teal-400 hover:text-teal-300 transition-colors uppercase tracking-wider">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Add Link
                                    </button>
                                </div>
                                
                            @elseif($meta['type'] === 'bg_image_group')
                                <div class="col-span-full">
                                    <x-admin.bg-image-picker modelPrefix="settings" imageKey="{{ $key }}" colorKey="{{ str_replace('image', 'color', $key) }}" opacityKey="{{ str_replace('image', 'opacity', $key) }}" targetEvent="media-selected-setting" />
                                </div>
                                
                            @elseif($meta['type'] === 'hidden')
                                <!-- Do nothing, handled by bg_image_group -->
                            @elseif($meta['type'] === 'select')
                                <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                <select 
                                    wire:model="settings.{{ $key }}" 
                                    id="setting-{{ $key }}" 
                                    class="w-full h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                >
                                    @foreach($meta['options'] as $val => $optLabel)
                                        <option value="{{ $val }}">{{ $optLabel }}</option>
                                    @endforeach
                                </select>
                                @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror

                            @elseif($meta['type'] === 'color')
                                <div>
                                    <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    <div class="flex items-center gap-3">
                                        <input 
                                            wire:model="settings.{{ $key }}" 
                                            id="setting-{{ $key }}-picker" 
                                            type="color"
                                            class="h-11 w-11 cursor-pointer rounded-xl border border-slate-700 bg-slate-950 p-1"
                                        >
                                        <input 
                                            wire:model="settings.{{ $key }}" 
                                            id="setting-{{ $key }}" 
                                            type="text" 
                                            class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                        >
                                    </div>
                                    @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                </div>
                            @elseif($meta['type'] === 'password')
                                <div x-data="{ show: false }">
                                    <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    <div class="relative">
                                        <input 
                                            :type="show ? 'text' : 'password'"
                                            wire:model="settings.{{ $key }}" 
                                            id="setting-{{ $key }}" 
                                            class="w-full h-11 rounded-xl border border-slate-700 bg-slate-950/80 pl-4 pr-10 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                        >
                                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300">
                                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                        </button>
                                    </div>
                                    @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                </div>
                            @elseif($meta['type'] === 'url')
                                <div>
                                    <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                        </div>
                                        <input 
                                            wire:model="settings.{{ $key }}" 
                                            id="setting-{{ $key }}" 
                                            type="url" 
                                            class="w-full h-11 rounded-xl border border-slate-700 bg-slate-950/80 pl-10 pr-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                        >
                                    </div>
                                    @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                </div>
                            @else
                                <div>
                                    <label for="setting-{{ $key }}" class="block mb-2 text-sm font-semibold text-slate-200">{{ $meta['label'] }}</label>
                                    <input 
                                        wire:model="settings.{{ $key }}" 
                                        id="setting-{{ $key }}" 
                                        type="{{ $meta['type'] === 'number' ? 'number' : 'text' }}" 
                                        class="w-full h-11 rounded-xl border border-slate-700 bg-slate-950/80 px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 @error('settings.'.$key) border-rose-500 @enderror"
                                    >
                                    @if($meta['description']) <p class="mt-1.5 text-xs text-slate-500">{{ $meta['description'] }}</p> @endif
                                    @error('settings.'.$key) <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-800/50 mb-4">
                                <svg class="h-8 w-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-1">No Settings Found</h4>
                            <p class="text-sm text-slate-500">There are no configurable settings available in the "{{ $tabTitles[$activeTab] }}" group.</p>
                        </div>
                    @endforelse
                </div>
                @endif
            </div>
        </section>
    </div>
</div>
