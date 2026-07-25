@extends('layouts.admin')

@section('title', 'Edit News/Event - Admin Panel')
@section('page_title', 'Edit News/Event')

@section('content')
<div class="max-w-4xl">
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm p-6 md:p-8">
        <form action="{{ route('admin.news.update', $newsEvent ?? 0) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <x-admin.form-group 
                        name="title" 
                        label="Title" 
                        type="text" 
                        :value="old('title', $newsEvent->title ?? '')" 
                        placeholder="Enter title"
                        required="true"
                    />
                </div>
                
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-medium text-slate-300">Type <span class="text-rose-500">*</span></label>
                    <select name="type" id="type" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                        <option value="news" {{ old('type', $newsEvent->type ?? '') === 'news' ? 'selected' : '' }}>News</option>
                        <option value="event" {{ old('type', $newsEvent->type ?? '') === 'event' ? 'selected' : '' }}>Event</option>
                    </select>
                    @error('type')
                        <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <x-admin.form-group 
                name="excerpt" 
                label="Excerpt (Short Summary)" 
                type="text" 
                :value="old('excerpt', $newsEvent->excerpt ?? '')" 
                placeholder="Brief summary for listings"
            />
            
            <div class="space-y-2">
                <label for="body" class="block text-sm font-medium text-slate-300">Content Body <span class="text-rose-500">*</span></label>
                <textarea 
                    name="body" 
                    id="body" 
                    rows="10" 
                    required
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors"
                    placeholder="Full content..."
                >{{ old('body', $newsEvent->body ?? '') }}</textarea>
                @error('body')
                    <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2" id="event_date_wrapper" style="display: {{ old('type', $newsEvent->type ?? '') === 'event' ? 'block' : 'none' }}">
                    <label for="event_date" class="block text-sm font-medium text-slate-300">Event Date</label>
                    @php
                        $dateValue = old('event_date', isset($newsEvent) && $newsEvent->event_date ? \Carbon\Carbon::parse($newsEvent->event_date)->format('Y-m-d') : '');
                    @endphp
                    <input type="date" name="event_date" id="event_date" value="{{ $dateValue }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors [color-scheme:dark]">
                    @error('event_date')
                        <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-admin.form-group 
                    name="image_url" 
                    label="Image URL (Optional)" 
                    type="text" 
                    :value="old('image_url', $newsEvent->image_url ?? '')" 
                    placeholder="https://example.com/image.jpg"
                />
            </div>
            
            <div class="space-y-2 pt-2">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $newsEvent->is_published ?? true) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-teal-500 rounded bg-slate-900 border-slate-700 focus:ring-teal-500 focus:ring-offset-slate-900">
                    <span class="text-slate-300 font-medium">Publish</span>
                </label>
            </div>
            
            <div class="pt-6 border-t border-slate-700/50 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.news.index') }}" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">Cancel</a>
                <x-public.btn type="submit" variant="primary">Update</x-public.btn>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const eventDateWrapper = document.getElementById('event_date_wrapper');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'event') {
                eventDateWrapper.style.display = 'block';
            } else {
                eventDateWrapper.style.display = 'none';
                document.getElementById('event_date').value = '';
            }
        });
    });
</script>
@endsection
