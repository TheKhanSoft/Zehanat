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
    class="fixed inset-0 z-[100] {{ $model ? '' : 'hidden' }}"
    @if($model)
        x-data="{ open: $wire.entangle(@js($model)) }"
        x-show="open"
        x-cloak
        x-on:keydown.escape.window="open = false"
    @endif
    aria-labelledby="{{ $id }}-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Overlay -->
    <div
        class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity {{ $model ? 'opacity-100' : 'opacity-0' }} modal-overlay"
        aria-hidden="true"
        @if($model) x-on:click="open = false" @else onclick="closeModal('{{ $id }}')" @endif
    ></div>

    <div class="absolute inset-0 z-10 overflow-x-hidden overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <!-- Modal panel -->
            <div class="relative transform overflow-hidden rounded-2xl bg-slate-900/95 backdrop-blur-xl border border-slate-700/50 text-left shadow-2xl shadow-black/50 transition-all w-full {{ $maxWidthClass }} {{ $model ? 'opacity-100 scale-100' : 'opacity-0 scale-95' }} modal-content duration-300">
                @if($plain)
                    {{ $slot }}
                @else
                <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        @if($showIcon)
                        @if($confirmColor === 'rose' || $confirmColor === 'red')
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 border {{ $confirmClasses['iconWrap'] }}">
                            <svg class="h-6 w-6 {{ $confirmClasses['icon'] }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        @else
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 border {{ $confirmClasses['iconWrap'] }}">
                            <svg class="h-6 w-6 {{ $confirmClasses['icon'] }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        @endif
                        @endif
                        <div class="mt-3 min-w-0 w-full flex-1 text-center sm:mt-0 sm:text-left {{ $showIcon ? 'sm:ml-4' : '' }}">
                            <h3 class="text-lg font-semibold leading-6 text-white" id="{{ $id }}-title">{{ $title }}</h3>
                            <div class="mt-2">
                                <div class="text-sm text-slate-300">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(isset($footer))
                <div class="flex flex-col-reverse gap-3 border-t border-slate-700/50 bg-slate-900/50 px-4 py-3 sm:flex-row sm:justify-end sm:px-6">
                    {{ $footer }}
                </div>
                @elseif($showFooter)
                <div class="bg-slate-900/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-700/50">
                    <button type="button" onclick="submitModalForm(this, '{{ $id }}')" class="inline-flex w-full justify-center rounded-lg px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 border border-transparent {{ $confirmClasses['button'] }}">
                        {{ $confirmText }}
                    </button>
                    <button type="button" onclick="closeModal('{{ $id }}')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-300 shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-slate-500">
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
