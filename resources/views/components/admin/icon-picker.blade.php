@props(['model'])
<div x-data="iconPickerData({ selected: @entangle($model) })">
    <!-- Trigger Button -->
    <div class="relative flex items-center group">
        <button type="button" 
            @click="isOpen = !isOpen; if(isOpen) { customMode = false; $nextTick(() => $refs.searchInput.focus()) }"
            class="flex-none w-[46px] h-[46px] flex items-center justify-center rounded-xl border border-slate-700 bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-white transition shadow-sm z-10 relative">
            <template x-if="selectedIcon && !customMode">
                <span x-html="selectedIcon" class="text-xl flex items-center justify-center w-full h-full"></span>
            </template>
            <template x-if="selectedIcon && customMode">
                <svg class="w-5 h-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </template>
            <template x-if="!selectedIcon">
                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </template>
        </button>
        <div class="flex-1">
            <template x-if="!customMode">
                <div class="text-sm text-slate-400 font-medium px-2 truncate cursor-pointer" @click="isOpen = true">
                    <span x-show="selectedIcon">Icon selected</span>
                    <span x-show="!selectedIcon">Choose an icon...</span>
                </div>
            </template>
            <template x-if="customMode">
                <input type="text" x-model="selectedIcon" class="block w-full h-[46px] rounded-xl border border-slate-700 bg-slate-900 px-4 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-teal-500 shadow-inner" placeholder="Paste Emoji, HTML, or SVG...">
            </template>
        </div>
    </div>

    <!-- Dropdown Panel -->
    <div x-show="isOpen" 
         @click.away="isOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="absolute z-[110] mt-2 w-72 rounded-2xl border border-slate-700/60 bg-slate-900/95 backdrop-blur-xl shadow-2xl shadow-black/60 overflow-hidden"
         x-cloak>
        
        <!-- Header / Search -->
        <div class="p-3 border-b border-slate-800/80 bg-slate-950/40">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input x-ref="searchInput" x-model="search" type="text" class="w-full bg-slate-800 border-none rounded-xl py-2 pl-9 pr-3 text-sm text-white placeholder:text-slate-500 focus:ring-2 focus:ring-teal-500 transition-shadow" placeholder="Search icons...">
            </div>
        </div>

        <!-- Icon Grid -->
        <div class="p-3 max-h-60 overflow-y-auto custom-scrollbar">
            <template x-if="filteredIcons.length > 0">
                <div class="grid grid-cols-6 gap-2">
                    <template x-for="(item, index) in filteredIcons" :key="index">
                        <button type="button" 
                            @click="selectIcon(item.i)"
                            :class="selectedIcon === item.i && !customMode ? 'bg-teal-500 text-white shadow-md shadow-teal-500/20' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'"
                            class="aspect-square flex items-center justify-center rounded-lg transition-all text-lg"
                            x-html="item.i"></button>
                    </template>
                </div>
            </template>
            <template x-if="filteredIcons.length === 0">
                <div class="text-center py-6 text-sm text-slate-500">
                    No icons found for "<span x-text="search"></span>"
                </div>
            </template>

            <!-- Custom Mode Toggle -->
            <div class="mt-3 pt-3 border-t border-slate-800/80">
                <button type="button" @click="customMode = true; isOpen = false;" class="w-full flex items-center justify-center gap-2 py-2 text-xs font-semibold text-teal-400 hover:text-teal-300 bg-teal-500/10 hover:bg-teal-500/20 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    Enter custom SVG/HTML
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('iconPickerData', (params) => ({
            selectedIcon: params.selected,
            isOpen: false,
            search: '',
            customMode: false,
            icons: [
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>', t: 'research search magnifying glass analyze study' },
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>', t: 'development code programming dev software engineering' },
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>', t: 'training education graduation learning learn school' },
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>', t: 'outreach global share network connect connection' },
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>', t: 'ethics scale balance justice fair fairness law' },
                { i: '<svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"/></svg>', t: 'community users people team group social society' },
                { i: '<i class="fa-solid fa-users fa-lg"></i>', t: 'font awesome users people team group community' },
                { i: '<i class="fa-solid fa-microscope fa-lg"></i>', t: 'font awesome microscope research lab science' },
                { i: '<i class="fa-solid fa-graduation-cap fa-lg"></i>', t: 'font awesome graduation cap education learn school' },
                { i: '<i class="fa-solid fa-robot fa-lg"></i>', t: 'font awesome robot ai bot machine' },
                { i: '✨', t: 'sparkles magic feature ai' }, { i: '🚀', t: 'rocket launch fast speed' },
                { i: '💡', t: 'lightbulb idea smart' }, { i: '🎓', t: 'education graduation university school learning' },
                { i: '🏛️', t: 'institution government building bank' }, { i: '🎯', t: 'target goal focus objective accuracy' },
                { i: '🤝', t: 'handshake deal partner agree team' }, { i: '📊', t: 'chart graph analytics data statistics' },
                { i: '🛡️', t: 'shield security protect defense safe' }, { i: '💬', t: 'chat bubble message communication' },
                { i: '🌐', t: 'globe world web internet network' }, { i: '⚙️', t: 'gear settings config options machine' },
                { i: '📈', t: 'chart trend growth up increase' }, { i: '💻', t: 'laptop computer dev tech code' },
                { i: '📱', t: 'phone mobile app device' }, { i: '🔧', t: 'wrench tool fix repair build' },
                { i: '🏆', t: 'trophy win award prize achievement' }, { i: '⭐', t: 'star favorite rate premium' },
                { i: '🔥', t: 'fire hot trending popular' }, { i: '⚡', t: 'lightning power fast energy electric' },
                { i: '💎', t: 'diamond gem premium quality value' }, { i: '🧠', t: 'brain smart ai intelligence mind' },
                { i: '🤖', t: 'robot ai bot automation machine' }, { i: '🧪', t: 'test tube lab science experiment research' },
                { i: '🌱', t: 'seedling plant grow nature eco' }, { i: '🌍', t: 'earth globe world global planet' },
                { i: '❤️', t: 'heart love like favorite health' }, { i: '🌟', t: 'glowing star shine bright feature' },
                { i: '📌', t: 'pin location map attach important' }, { i: '📣', t: 'megaphone shout announce broadcast alert' },
                { i: '✅', t: 'check mark tick success complete done' }, { i: '👑', t: 'crown king leader premium top' },
                { i: '🔍', t: 'search glass find zoom inspect' }, { i: '🔑', t: 'key unlock access secret security' },
                { i: '🔒', t: 'lock secure private safe closed' }, { i: '🔓', t: 'unlock open insecure public' },
                { i: '🔔', t: 'bell alarm alert notification ring' }, { i: '📅', t: 'calendar date schedule event time' },
                { i: '⏱️', t: 'stopwatch timer clock time speed' }, { i: '📝', t: 'memo write note document paper' },
                { i: '📂', t: 'folder open file directory organize' }, { i: '📦', t: 'package box product ship deliver' },
                { i: '🛒', t: 'cart shop buy ecommerce store' }, { i: '💳', t: 'credit card pay money buy purchase' },
                { i: '💵', t: 'dollar cash money bill finance' }, { i: '🏢', t: 'building office business company tower' },
                { i: '🏠', t: 'house home real estate property' }, { i: '🎨', t: 'palette color paint art design' },
                { i: '🎵', t: 'music note song sound audio' }, { i: '🎬', t: 'clapper board movie film video camera' },
                { i: '📷', t: 'camera photo picture image shoot' }, { i: '🔗', t: 'link chain url connect attach' },
                { i: '⚕️', t: 'medical health hospital doctor medicine' }, { i: '⚖️', t: 'scale balance law justice court' },
                { i: '✈️', t: 'airplane flight travel transport fly' }, { i: '🚗', t: 'car auto drive ride transport' }
            ],
            get filteredIcons() {
                if (this.search === '') return this.icons;
                const lowerSearch = this.search.toLowerCase();
                return this.icons.filter(icon => icon.t.includes(lowerSearch) || icon.i.includes(lowerSearch));
            },
            selectIcon(icon) {
                this.selectedIcon = icon;
                this.customMode = false;
                this.isOpen = false;
            }
        }));
    });
</script>
