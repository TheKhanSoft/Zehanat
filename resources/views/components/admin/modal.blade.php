@props([
    'id' => uniqid('modal-'),
    'title' => 'Confirm Action',
    'confirmText' => 'Confirm',
    'confirmColor' => 'red',
    'showIcon' => false,
    'maxWidth' => 'md',
    'model' => null,
    'showFooter' => true,
    'plain' => false,
])

@php
    $maxWidthClass = match($maxWidth) {
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        default => 'sm:max-w-md',
    };

    $confirmClasses = match($confirmColor) {
        'teal' => [
            'iconWrap' => 'bg-teal-500/10 border-teal-500/20',
            'icon' => 'text-teal-500',
            'button' => 'bg-teal-500 hover:bg-teal-400 focus:ring-teal-500',
        ],
        'amber' => [
            'iconWrap' => 'bg-amber-500/10 border-amber-500/20',
            'icon' => 'text-amber-500',
            'button' => 'bg-amber-500 hover:bg-amber-400 focus:ring-amber-500 text-slate-950',
        ],
        'rose', 'red' => [
            'iconWrap' => 'bg-rose-500/10 border-rose-500/20',
            'icon' => 'text-rose-500',
            'button' => 'bg-rose-500 hover:bg-rose-400 focus:ring-rose-500',
        ],
        default => [
            'iconWrap' => 'bg-teal-500/10 border-teal-500/20',
            'icon' => 'text-teal-500',
            'button' => 'bg-teal-500 hover:bg-teal-400 focus:ring-teal-500',
        ],
    };
@endphp

<div
    id="{{ $id }}"
    {{ $attributes->merge(['class' => 'fixed inset-0 z-[100]']) }}
    x-data="{ 
        open: {{ $model ? '$wire.entangle(\''.$model.'\')' : 'false' }},
        isDirty: false,
        attemptClose(force = false) {
            if (!force && this.isDirty) {
                if (window.Livewire) {
                    window.Livewire.dispatch('confirm-action', {
                        title: 'Unsaved Changes', 
                        message: 'You have unsaved changes. Are you sure you want to close this window? Your changes will be lost.', 
                        action: 'force-close-modal', 
                        params: ['{{ $id }}']
                    });
                } else {
                    if (confirm('You have unsaved changes. Are you sure you want to close this window? Your changes will be lost.')) {
                        this.open = false;
                        this.isDirty = false;
                    }
                }
            } else {
                this.open = false;
                this.isDirty = false;
            }
        }
    }"
    x-init="$watch('open', value => { 
        if(value) { 
            isDirty = false; 
            document.body.style.overflow = 'hidden'; 
        } else { 
            setTimeout(() => {
                let openModals = 0;
                document.querySelectorAll('[role=\'dialog\'][aria-modal=\'true\']').forEach(el => {
                    if (window.getComputedStyle(el).display !== 'none') openModals++;
                });
                if (openModals === 0) {
                    document.body.style.overflow = '';
                }
            }, 300); 
        } 
    })"
    x-on:input.capture="isDirty = true"
    x-on:change.capture="isDirty = true"
    x-on:click.capture="if($event.target.tagName === 'INPUT' || $event.target.tagName === 'TEXTAREA' || $event.target.tagName === 'SELECT') isDirty = true;"
    x-show="open"
    x-cloak
    x-on:keydown.escape.window="attemptClose()"
    x-on:force-close-modal.window="if ($event.detail[0] === '{{ $id }}' || $event.detail.params?.[0] === '{{ $id }}') { open = false; isDirty = false; }"
    x-on:attempt-close-modal.window="if ($event.detail.id === '{{ $id }}' || $event.detail[0] === '{{ $id }}') attemptClose($event.detail.force || false)"
    x-on:open-modal.window="if ($event.detail.id === '{{ $id }}' || $event.detail[0] === '{{ $id }}') { open = true; }"
    x-on:close-modal.window="if ($event.detail.id === '{{ $id }}' || $event.detail[0] === '{{ $id }}') { open = false; isDirty = false; }"
    aria-labelledby="{{ $id }}-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Overlay -->
    <div
        class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        aria-hidden="true"
    ></div>

    <div class="absolute inset-0 z-10 overflow-x-hidden overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6 cursor-pointer"
             x-on:click.self="attemptClose()">
            
            <!-- Modal panel -->
            <div 
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-visible rounded-2xl bg-slate-900/95 backdrop-blur-xl border border-slate-700/50 text-left shadow-2xl shadow-black/50 transition-all w-full {{ $maxWidthClass }} cursor-default">
                @if(!$plain)
                <button type="button" x-on:click="attemptClose()" class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:text-white hover:bg-slate-700/80 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500/50 z-20 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50" title="Close Modal">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                @endif
                
                @if($plain)
                    {{ $slot }}
                @else
                <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        @if($showIcon)
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 {{ $confirmClasses['iconWrap'] }}">
                            <svg class="h-6 w-6 {{ $confirmClasses['icon'] }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        @endif
                        <div class="w-full text-center sm:ml-4 sm:mt-0 sm:text-left {{ $showIcon ? '' : 'sm:ml-0' }}">
                            <h3 class="text-lg font-semibold leading-6 text-white" id="{{ $id }}-title">{{ $title }}</h3>
                            <div class="mt-4">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(isset($footer))
                <div class="flex flex-col-reverse gap-3 border-t border-slate-700/50 bg-slate-900/50 px-4 py-3 sm:flex-row sm:justify-end sm:px-6 rounded-b-2xl">
                    {{ $footer }}
                </div>
                @elseif($showFooter)
                <div class="bg-slate-900/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-700/50 rounded-b-2xl">
                    <button type="button" onclick="submitModalForm(this, '{{ $id }}')" class="inline-flex w-full justify-center rounded-lg px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 border border-transparent {{ $confirmClasses['button'] }}">
                        {{ $confirmText }}
                    </button>
                    <button type="button" x-on:click="attemptClose()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-300 shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-slate-500">
                        Cancel
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
@once
<script>
    window.openModal = function(id) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: id } }));
    }

    window.closeModal = function(id, force = false) {
        window.dispatchEvent(new CustomEvent('attempt-close-modal', { detail: { id: id, force: force } }));
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

    // Listen for force close from the Livewire ConfirmationModal
    window.addEventListener('force-close-modal', function(event) {
        const modalId = event.detail[0];
        if (modalId) {
            closeModal(modalId, true);
        }
    });
</script>
@endonce
@endpush
