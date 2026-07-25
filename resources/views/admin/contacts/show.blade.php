@extends('layouts.admin')

@section('title', 'Message Details - Admin Panel')
@section('page_title', isset($contact) ? 'Message from ' . $contact->name : 'Message Details')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-teal-400 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Messages
        </a>
        
        <div class="flex items-center space-x-3">
            @if(isset($contact) && !$contact->is_read)
                <form action="{{ route('admin.contacts.read', $contact) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <x-public.btn type="submit" variant="primary">Mark as Read</x-public.btn>
                </form>
            @endif
        </div>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden p-6 md:p-8">
        <div class="border-b border-slate-700/50 pb-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between md:items-start gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ $contact->subject ?? 'No Subject' }}</h2>
                    <div class="flex items-center space-x-2 text-slate-400">
                        <span class="font-medium text-teal-400">{{ $contact->name ?? 'Unknown' }}</span>
                        <span>&bull;</span>
                        <a href="mailto:{{ $contact->email ?? '' }}" class="hover:text-white transition-colors">{{ $contact->email ?? 'N/A' }}</a>
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-sm text-slate-500 mb-2">{{ isset($contact) ? $contact->created_at->format('F d, Y h:i A') : '' }}</p>
                    @if(isset($contact))
                        @if(!$contact->is_read)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Unread</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">Read</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="prose prose-invert max-w-none">
            <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50 text-slate-300 whitespace-pre-wrap leading-relaxed text-base">
                {{ $contact->message ?? 'No message content.' }}
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-slate-700/50 flex space-x-4">
            <a href="mailto:{{ $contact->email ?? '' }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-600 rounded-xl text-sm font-medium text-white hover:bg-slate-700 transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection
