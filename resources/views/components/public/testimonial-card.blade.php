@props([
    'name',
    'role' => '',
    'image' => null,
])

<div class="glass-card rounded-2xl p-8 relative">
    <div class="text-5xl text-teal-500/30 font-serif leading-none mb-4 absolute top-6 left-6">"</div>
    
    <div class="relative z-10">
        <div class="text-lg text-slate-300 italic leading-relaxed mb-6 pt-4">
            {{ $slot }}
        </div>
        
        <div class="flex items-center gap-4 border-t border-slate-700/50 pt-6">
            @if($image)
                <img src="{{ $image }}" alt="{{ $name }}" class="w-12 h-12 rounded-full object-cover border border-slate-600">
            @else
                <div class="w-12 h-12 rounded-full bg-teal-500/20 flex items-center justify-center text-teal-400 font-bold text-xl uppercase">
                    {{ substr($name, 0, 1) }}
                </div>
            @endif
            
            <div>
                <h4 class="text-white font-semibold">{{ $name }}</h4>
                @if($role)
                    <p class="text-slate-400 text-sm">{{ $role }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
