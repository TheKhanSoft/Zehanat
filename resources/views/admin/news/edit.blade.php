@extends('layouts.admin')

@section('title', 'Edit News/Event - Admin Panel')
@section('page_title', 'Edit News/Event')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Edit News/Event</h1>
            <p class="text-slate-400 mt-2">Update an existing article or event.</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.news.index') }}" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">Cancel</a>
        </div>
    </div>

    <form id="news-form" action="{{ route('admin.news.update', $newsEvent ?? 0) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
        
        <!-- Left Column (Main Content) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card wrapper -->
            <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6">
                <div class="space-y-6">
                    <x-admin.form-group 
                        name="title" 
                        label="Title" 
                        type="text" 
                        :value="old('title', $newsEvent->title ?? '')" 
                        placeholder="Enter an engaging title"
                        required="true"
                    />

                    <x-admin.form-group 
                        name="excerpt" 
                        label="Excerpt (Short Summary)" 
                        type="textarea"
                        rows="3" 
                        :value="old('excerpt', $newsEvent->excerpt ?? '')" 
                        placeholder="Brief summary for listings and SEO"
                    />
                    
                    <x-admin.form-group 
                        name="body" 
                        label="Content Body" 
                        type="textarea"
                        rows="12" 
                        :value="old('body', $newsEvent->body ?? '')" 
                        placeholder="Write your full content here..."
                        required="true"
                    />
                </div>
            </div>
        </div>

        <!-- Right Column (Sidebar Settings) -->
        <div class="space-y-6">
            <!-- Card wrapper -->
            <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6">
                <h3 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Settings
                </h3>
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-medium text-slate-300">Content Type <span class="text-rose-500">*</span></label>
                        <select name="type" id="type" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors">
                            <option value="news" {{ old('type', $newsEvent->type ?? '') === 'news' ? 'selected' : '' }}>News Article</option>
                            <option value="event" {{ old('type', $newsEvent->type ?? '') === 'event' ? 'selected' : '' }}>Upcoming Event</option>
                        </select>
                        @error('type')
                            <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2" id="event_date_wrapper" style="display: {{ old('type', $newsEvent->type ?? '') === 'event' ? 'block' : 'none' }}">
                        @php
                            $dateValue = old('event_date', isset($newsEvent) && $newsEvent->event_date ? \Carbon\Carbon::parse($newsEvent->event_date)->format('Y-m-d') : '');
                        @endphp
                        <x-admin.form-group 
                            name="event_date" 
                            label="Event Date" 
                            type="date" 
                            :value="$dateValue" 
                        />
                    </div>

                    <x-admin.form-group 
                        name="image_url" 
                        label="Featured Image URL" 
                        type="url" 
                        :value="old('image_url', $newsEvent->image_url ?? '')" 
                        placeholder="https://..."
                    />

                    <div class="pt-4 border-t border-slate-700/50">
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $newsEvent->is_published ?? true) ? 'checked' : '' }} class="peer sr-only">
                                <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-teal-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                            </div>
                            <span class="text-slate-300 font-medium group-hover:text-white transition-colors">Publish Content</span>
                        </label>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-700/50">
                        <button type="submit" class="w-full bg-teal-500 hover:bg-teal-400 text-slate-900 font-semibold px-6 py-3 rounded-xl shadow-lg shadow-teal-500/20 transition-all flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 0 1 0 1.414l-8 8a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L8 12.586l7.293-7.293a1 1 0 0 1 1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Update Content</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
