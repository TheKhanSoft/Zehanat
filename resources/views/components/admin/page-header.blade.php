@props(['title', 'description', 'module', 'actionText' => null, 'actionMethod' => null, 'icon' => null, 'actionPermission' => null])

<section class="relative overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/70 p-5 shadow-2xl shadow-slate-950/20 backdrop-blur-xl sm:p-7">
    <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-teal-500/10 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 left-1/3 h-56 w-56 rounded-full bg-cyan-500/10 blur-3xl"></div>

    <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
        <div class="max-w-2xl">
            <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-teal-400/20 bg-teal-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-teal-300">
                <span class="h-1.5 w-1.5 rounded-full bg-teal-400"></span>
                {{ $module }}
            </div>

            <h1 class="text-2xl font-black tracking-tight !text-white sm:text-3xl">
                {{ $title }}
            </h1>
            <p class="mt-2 max-w-xl text-sm leading-6 text-slate-400 sm:text-base">
                {{ $description }}
            </p>
        </div>

        @if($actionText && $actionMethod)
        @if(!$actionPermission || auth()->user()->can($actionPermission))
        <button
            type="button"
            wire:click="{{ $actionMethod }}"
            class="group inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-teal-500/25 focus:outline-none focus:ring-4 focus:ring-teal-500/20"
        >
            @if($icon && str_contains($icon, '<svg'))
                {!! $icon !!}
            @else
                <svg class="h-5 w-5 transition-transform duration-200 group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            @endif
            {{ $actionText }}
        </button>
        @endif
        @endif
    </div>
</section>
