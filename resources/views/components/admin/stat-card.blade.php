@props(['title', 'value', 'icon', 'trend' => null, 'color' => 'teal'])

<div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/80 rounded-xl p-6 shadow-sm hover:shadow-lg hover:border-slate-600 transition-all duration-300 group">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-slate-400 mb-1 group-hover:text-slate-300 transition-colors">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-white tracking-tight">{{ $value }}</h3>
            
            @if($trend)
                <div class="mt-2 flex items-center text-sm">
                    @if(str_starts_with($trend, '+'))
                        <span class="text-emerald-400 font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                            </svg>
                            {{ $trend }}
                        </span>
                    @elseif(str_starts_with($trend, '-'))
                        <span class="text-rose-400 font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                            </svg>
                            {{ $trend }}
                        </span>
                    @else
                        <span class="text-slate-400 font-medium">{{ $trend }}</span>
                    @endif
                    <span class="text-slate-500 ml-1 text-xs">vs last month</span>
                </div>
            @endif
        </div>
        
        @php
            $colorClasses = match($color) {
                'teal' => 'bg-teal-500/10 text-teal-400 border-teal-500/20 group-hover:bg-teal-500/20',
                'amber' => 'bg-amber-500/10 text-amber-400 border-amber-500/20 group-hover:bg-amber-500/20',
                'rose' => 'bg-rose-500/10 text-rose-400 border-rose-500/20 group-hover:bg-rose-500/20',
                'blue' => 'bg-blue-500/10 text-blue-400 border-blue-500/20 group-hover:bg-blue-500/20',
                'emerald' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 group-hover:bg-emerald-500/20',
                'purple' => 'bg-purple-500/10 text-purple-400 border-purple-500/20 group-hover:bg-purple-500/20',
                default => 'bg-teal-500/10 text-teal-400 border-teal-500/20 group-hover:bg-teal-500/20',
            };
        @endphp
        <div class="h-12 w-12 rounded-xl {{ $colorClasses }} flex items-center justify-center text-2xl shadow-inner border group-hover:scale-110 transition-all duration-300">
            @if(preg_match('/<svg|<\/svg>/i', $icon))
                <div class="w-6 h-6">{!! $icon !!}</div>
            @else
                {{ $icon }}
            @endif
        </div>
    </div>
</div>
