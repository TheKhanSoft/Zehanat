@extends('layouts.admin')

@section('title', 'Edit FAQ - Admin Panel')
@section('page_title', 'Edit FAQ')

@section('content')
<div class="max-w-3xl">
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm p-6 md:p-8">
        <form action="{{ route('admin.faqs.update', $faq ?? 0) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <x-admin.form-group 
                name="question" 
                label="Question" 
                type="text" 
                :value="old('question', $faq->question ?? '')" 
                placeholder="e.g. How do I join Zehanat?"
                required="true"
            />
            
            <div class="space-y-2">
                <label for="answer" class="block text-sm font-medium text-slate-300">Answer <span class="text-rose-500">*</span></label>
                <textarea 
                    name="answer" 
                    id="answer" 
                    rows="6" 
                    required
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none transition-colors"
                    placeholder="Provide the answer here..."
                >{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')
                    <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-admin.form-group 
                    name="sort_order" 
                    label="Sort Order" 
                    type="number" 
                    :value="old('sort_order', $faq->sort_order ?? 0)" 
                    placeholder="0"
                />
                
                <div class="space-y-2 flex flex-col justify-center pt-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-teal-500 rounded bg-slate-900 border-slate-700 focus:ring-teal-500 focus:ring-offset-slate-900">
                        <span class="text-slate-300 font-medium">Is Active</span>
                    </label>
                </div>
            </div>
            
            <div class="pt-6 border-t border-slate-700/50 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.faqs.index') }}" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">Cancel</a>
                <x-public.btn type="submit" variant="primary">Update FAQ</x-public.btn>
            </div>
        </form>
    </div>
</div>
@endsection
