@extends('layouts.admin')

@section('title', 'Member Details - Admin Panel')
@section('page_title', 'Member Details')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.members.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-teal-400 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Members
        </a>
        
        <div class="flex items-center space-x-3">
            @if(isset($member) && $member->status === 'pending')
                <form action="{{ route('admin.members.reject', $member) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <x-public.btn type="submit" variant="outline" class="border-rose-500/50 text-rose-400 hover:bg-rose-500/10 hover:border-rose-500">Reject</x-public.btn>
                </form>
                <form action="{{ route('admin.members.approve', $member) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <x-public.btn type="submit" variant="primary" class="bg-emerald-500 hover:bg-emerald-600 text-white">Approve</x-public.btn>
                </form>
            @endif
        </div>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">{{ $member->name ?? 'N/A' }}</h2>
                    <p class="text-slate-400">Registered on {{ isset($member) ? $member->created_at->format('F d, Y h:i A') : 'N/A' }}</p>
                </div>
                <div>
                    @if(isset($member))
                        @if($member->status === 'approved')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Approved</span>
                        @elseif($member->status === 'pending')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Pending Review</span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Rejected</span>
                        @endif
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Info -->
                <div>
                    <h3 class="text-lg font-semibold text-teal-400 mb-4 border-b border-slate-700 pb-2">Personal Information</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">Email Address</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->email ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">Phone Number</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->phone ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">City/Location</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->city ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Professional Info -->
                <div>
                    <h3 class="text-lg font-semibold text-teal-400 mb-4 border-b border-slate-700 pb-2">Professional Details</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">Category</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->category ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">Institution/Organization</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->institution ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 mb-1">Qualification</dt>
                            <dd class="text-base text-white bg-slate-900/50 rounded-lg px-4 py-2 border border-slate-700/50">{{ $member->qualification ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Message/Bio -->
            @if(isset($member) && $member->message)
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-teal-400 mb-4 border-b border-slate-700 pb-2">Additional Message / Bio</h3>
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50 text-slate-300 whitespace-pre-wrap leading-relaxed">
                    {{ $member->message }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
