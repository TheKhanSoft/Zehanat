@props([
    'title',
    'open' => false,
])

<div class="border border-slate-100 rounded-2xl mb-3 overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow">
    <button type="button" class="accordion-trigger w-full flex items-center justify-between px-6 py-4 text-left focus:outline-none hover:bg-slate-50 transition-colors" onclick="
        const content = this.nextElementSibling;
        const icon = this.querySelector('svg');
        if(content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180', 'text-[#0c5adb]');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180', 'text-[#0c5adb]');
        }
    ">
        <span class="text-base font-heading font-bold text-[#182433]">{{ html_entity_decode($title) }}</span>
        <svg class="w-5 h-5 text-slate-400 transition-transform duration-300 transform {{ $open ? 'rotate-180 text-[#0c5adb]' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <div class="accordion-content px-6 pb-5 text-[#5e6278] {{ $open ? 'open block' : 'hidden' }}">
        {{ $slot }}
    </div>
</div>
