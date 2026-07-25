@props(['id', 'title' => 'Confirm Action', 'confirmText' => 'Confirm', 'confirmColor' => 'red'])

<div id="{{ $id }}" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity opacity-0 modal-overlay" aria-hidden="true" onclick="closeModal('{{ $id }}')"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal panel -->
            <div class="relative transform overflow-hidden rounded-2xl bg-slate-800 border border-slate-700 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md opacity-0 scale-95 modal-content duration-300">
                <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        @if($confirmColor === 'rose' || $confirmColor === 'red')
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-rose-500/10 sm:mx-0 sm:h-10 sm:w-10 border border-rose-500/20">
                            <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        @else
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-{{ $confirmColor }}-500/10 sm:mx-0 sm:h-10 sm:w-10 border border-{{ $confirmColor }}-500/20">
                            <svg class="h-6 w-6 text-{{ $confirmColor }}-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        @endif
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">{{ $title }}</h3>
                            <div class="mt-2">
                                <div class="text-sm text-slate-300">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-700/50">
                    <button type="button" onclick="submitModalForm(this, '{{ $id }}')" class="inline-flex w-full justify-center rounded-lg bg-{{ $confirmColor }}-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-{{ $confirmColor }}-400 sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-{{ $confirmColor }}-500 border border-transparent">
                        {{ $confirmText }}
                    </button>
                    <button type="button" onclick="closeModal('{{ $id }}')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-300 shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-slate-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@once
<script>
    window.openModal = function(id) {
        const modal = document.getElementById(id);
        if(!modal) return;
        
        modal.classList.remove('hidden');
        
        // Small delay to allow display block to apply before animating opacity
        setTimeout(() => {
            modal.querySelector('.modal-overlay').classList.remove('opacity-0');
            modal.querySelector('.modal-overlay').classList.add('opacity-100');
            
            const content = modal.querySelector('.modal-content');
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    window.closeModal = function(id) {
        const modal = document.getElementById(id);
        if(!modal) return;
        
        modal.querySelector('.modal-overlay').classList.remove('opacity-100');
        modal.querySelector('.modal-overlay').classList.add('opacity-0');
        
        const content = modal.querySelector('.modal-content');
        content.classList.remove('opacity-100', 'scale-100');
        content.classList.add('opacity-0', 'scale-95');
        
        // Wait for transition to finish
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }
    
    // Helper to submit a form inside the modal or trigger an event
    window.submitModalForm = function(button, modalId) {
        const modal = document.getElementById(modalId);
        const form = modal.querySelector('form');
        if(form) {
            form.submit();
        } else {
            // If no form, dispatch custom event that can be listened to
            const event = new CustomEvent('modal:confirm', { detail: { modalId: modalId } });
            document.dispatchEvent(event);
        }
    }
</script>
@endonce
@endpush
