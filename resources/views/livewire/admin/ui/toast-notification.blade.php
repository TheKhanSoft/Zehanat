<div class="fixed bottom-4 right-4 z-50 flex flex-col gap-3 pointer-events-none w-full max-w-sm">
    @foreach($notifications as $notification)
        <div wire:key="toast-{{ $notification['id'] }}"
             x-data="{ show: false }"
             x-init="
                setTimeout(() => show = true, 50);
                setTimeout(() => { show = false; setTimeout(() => $wire.removeNotification('{{ $notification['id'] }}'), 300); }, 4000);
             "
             x-show="show"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-xl border {{ $notification['type'] === 'success' ? 'border-emerald-500/20 bg-emerald-500/10' : ($notification['type'] === 'error' ? 'border-rose-500/20 bg-rose-500/10' : 'border-amber-500/20 bg-amber-500/10') }} shadow-lg shadow-slate-950/20 backdrop-blur-xl">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if($notification['type'] === 'success')
                            <svg class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif($notification['type'] === 'error')
                            <svg class="h-6 w-6 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-semibold text-white">
                            {{ ucfirst($notification['type']) }}
                        </p>
                        <p class="mt-1 text-sm text-slate-300">
                            {{ $notification['message'] }}
                        </p>
                    </div>
                    <div class="ml-4 flex flex-shrink-0">
                        <button @click="show = false; setTimeout(() => $wire.removeNotification('{{ $notification['id'] }}'), 300)" type="button" class="inline-flex rounded-md text-slate-400 hover:text-white focus:outline-none transition-colors">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
