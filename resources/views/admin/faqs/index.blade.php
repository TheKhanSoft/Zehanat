@extends('layouts.admin')

@section('title', 'FAQs - Admin Panel')
@section('page_title', 'FAQs')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.faqs.create') }}">
            <x-public.btn variant="primary">
                <svg class="-ml-1 mr-2 h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New FAQ
            </x-public.btn>
        </a>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Question</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Sort Order</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($faqs ?? [] as $faq)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-white">
                        {{ Str::limit($faq->question, 60) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $faq->sort_order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($faq->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Active</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-teal-400 hover:text-teal-300">Edit</a>
                        
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-400 hover:text-rose-300">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>
                            </div>
                            <p class="text-slate-400 font-medium mb-1">No FAQs yet</p>
                            <p class="text-slate-500 text-sm">Create an FAQ to help your users find answers quickly.</p>
                            <a href="{{ route('admin.faqs.create') }}" class="mt-4 text-teal-400 hover:text-teal-300 text-sm font-medium">Add New FAQ &rarr;</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>
</div>
@endsection
