@props([
    'number',
    'icon',
    'title',
    'description',
])

<div class="glass-card rounded-2xl p-6 md:p-8 relative overflow-hidden group">
    <!-- Number badge -->
    <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-400 font-bold text-sm">
        {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
    </div>

    <!-- Icon -->
    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500/20 to-teal-600/10 flex items-center justify-center text-3xl mb-5 text-teal-400">
        {!! $icon !!}
    </div>

    <!-- Content -->
    <h3 class="text-xl font-semibold text-white mb-3 group-hover:text-teal-400 transition-colors duration-300">
        {{ $title }}
    </h3>
    <p class="text-slate-400 leading-relaxed text-sm md:text-base">
        {{ $description }}
    </p>

    <!-- Bottom accent line -->
    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-teal-500 to-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
</div>
