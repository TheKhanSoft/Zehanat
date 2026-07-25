@extends('layouts.admin')

@section('title', 'Contact Messages - Admin Panel')
@section('page_title', 'Contact Messages')

@section('content')
<div class="space-y-6">
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($contacts ?? [] as $contact)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors {{ !$contact->is_read ? 'bg-slate-700/10' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ !$contact->is_read ? 'font-bold text-white' : 'font-medium text-slate-200' }}">
                        {{ $contact->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                        {{ $contact->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ !$contact->is_read ? 'font-bold text-white' : 'text-slate-300' }}">
                        {{ Str::limit($contact->subject, 40) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if(!$contact->is_read)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Unread</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">Read</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $contact->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-teal-400 hover:text-teal-300">View</a>
                        
                        @if(!$contact->is_read)
                        <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-emerald-400 hover:text-emerald-300">Mark Read</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">No contact messages found.</td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>

    @if(isset($contacts) && $contacts->hasPages())
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
    @endif
</div>
@endsection
