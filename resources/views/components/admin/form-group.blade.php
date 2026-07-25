@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'rows' => 4, 'error' => null])

<div class="mb-5">
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-300 mb-2">
        {{ $label }} @if($required)<span class="text-rose-400 ml-1" title="Required">*</span>@endif
    </label>
    
    <div class="relative">
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($type === 'textarea')
                <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" {{ $required ? 'required' : '' }} class="w-full bg-slate-950 border border-slate-700/80 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 outline-none transition-colors" placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>
            @else
                <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} class="w-full bg-slate-950 border border-slate-700/80 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 outline-none transition-colors {{ $type === 'date' ? '[color-scheme:dark]' : '' }}" placeholder="{{ $placeholder }}">
            @endif
        @endif
    </div>
    
    @if($error || $errors->has($name))
        <p class="mt-2 text-sm text-rose-400 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            {{ $error ?? $errors->first($name) }}
        </p>
    @endif
</div>
