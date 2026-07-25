@extends('layouts.admin')

@section('title', 'Members - Admin Panel')
@section('page_title', 'Members')

@section('content')
<div class="space-y-6">
    <!-- Filter Bar -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-4 backdrop-blur-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form action="{{ route('admin.members.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <div>
                <select name="status" class="w-full sm:w-48 bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search members..." class="w-full bg-slate-900 border border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <x-public.btn type="submit" variant="primary" class="w-full sm:w-auto text-sm px-4 py-2">Filter</x-public.btn>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Contact</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Details</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($members ?? [] as $member)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $member->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                        <div>{{ $member->email }}</div>
                        <div class="text-xs text-slate-500">{{ $member->phone }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">
                        <div>{{ $member->category }}</div>
                        <div class="text-xs text-slate-500">{{ Str::limit($member->institution, 20) }}</div>
                    </td>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.members.show', $member) }}" class="text-teal-400 hover:text-teal-300">View</a>
                        
                        @if($member->status === 'pending')
                            <form action="{{ route('admin.members.approve', $member) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-emerald-400 hover:text-emerald-300">Approve</button>
                            </form>
                            <form action="{{ route('admin.members.reject', $member) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-rose-400 hover:text-rose-300">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">No members found.</td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>

    <!-- Pagination -->
    @if(isset($members) && $members->hasPages())
    <div class="mt-4">
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
