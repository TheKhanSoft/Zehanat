@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-admin.stat-card 
            title="Total Members" 
            value="{{ $totalMembers ?? 0 }}" 
            icon="👥" 
            color="teal" 
        />
        <x-admin.stat-card 
            title="Pending Members" 
            value="{{ $pendingMembers ?? 0 }}" 
            icon="📋" 
            color="amber" 
        />
        <x-admin.stat-card 
            title="Unread Messages" 
            value="{{ $unreadMessages ?? 0 }}" 
            icon="✉️" 
            color="rose" 
        />
        <x-admin.stat-card 
            title="Published News" 
            value="{{ $publishedNews ?? 0 }}" 
            icon="📰" 
            color="blue" 
        />
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Recent Members</h3>
            <a href="{{ route('admin.members.index') }}" class="text-teal-400 hover:text-teal-300 text-sm font-medium transition-colors">
                View All Members &rarr;
            </a>
        </div>
        
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Category</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($recentMembers ?? [] as $member)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $member->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $member->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $member->category }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($member->status === 'approved')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Approved</span>
                        @elseif($member->status === 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Pending</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Rejected</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ $member->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-400">No recent members found.</td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>
</div>
@endsection
