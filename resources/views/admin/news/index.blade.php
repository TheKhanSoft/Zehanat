@extends('layouts.admin')

@section('title', 'News & Events - Admin Panel')
@section('page_title', 'News & Events')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.news.create') }}">
            <x-public.btn variant="primary">
                <svg class="-ml-1 mr-2 h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New
            </x-public.btn>
        </a>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Event Date</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Published</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($newsEvents ?? [] as $item)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-white">
                        {{ Str::limit($item->title, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->type === 'event')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Event</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">News</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                        {{ $item->type === 'event' && $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('M d, Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->is_published)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Yes</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $item->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                        <a href="{{ route('admin.news.edit', $item) }}" class="text-teal-400 hover:text-teal-300">Edit</a>
                        
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-400 hover:text-rose-300">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 6h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5h1.875c.621 0 1.125-.504 1.125-1.125V3.375c0-.621-.504-1.125-1.125-1.125h-1.5A1.125 1.125 0 0015 3.375V7.5z" /></svg>
                            </div>
                            <p class="text-slate-400 font-medium mb-1">No news or events yet</p>
                            <p class="text-slate-500 text-sm">Publish news updates or upcoming events for your community.</p>
                            <a href="{{ route('admin.news.create') }}" class="mt-4 text-teal-400 hover:text-teal-300 text-sm font-medium">Add New &rarr;</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>

    @if(isset($newsEvents) && $newsEvents->hasPages())
    <div class="mt-4">
        {{ $newsEvents->links() }}
    </div>
    @endif
</div>
@endsection
