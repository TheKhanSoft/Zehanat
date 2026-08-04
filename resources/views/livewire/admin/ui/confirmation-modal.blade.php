<div>
    <div x-data="{ show: @entangle('show') }"
         x-show="show"
         class="fixed inset-0 z-[110] overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         style="display: none;">
        
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <!-- Background overlay -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/80 transition-opacity"
                 @click="$wire.cancel()"></div>

            <!-- Modal panel -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block align-middle bg-slate-900 rounded-2xl border border-slate-700/80 text-left overflow-hidden shadow-2xl shadow-slate-950/50 transform transition-all w-full max-w-lg z-10">
                
                <div class="bg-slate-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-rose-500/10 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-white" id="modal-title">
                                {{ $title }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-400">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-slate-900/50 px-4 py-3 border-t border-slate-800/80 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                    <button type="button" 
                            wire:click="confirm"
                            class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-4 py-2.5 bg-rose-500 text-sm font-bold text-white hover:bg-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-500/20 sm:w-auto transition-colors">
                        Confirm Action
                    </button>
                    <button type="button" 
                            wire:click="cancel"
                            class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-slate-700/80 px-4 py-2.5 bg-slate-800 text-sm font-bold text-slate-300 hover:text-white hover:bg-slate-700 focus:outline-none focus:ring-4 focus:ring-slate-500/20 sm:mt-0 sm:w-auto transition-colors">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
