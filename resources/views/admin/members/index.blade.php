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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.members.show', $member) }}" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-teal-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            
                            @if($member->status === 'pending')
                                <form action="{{ route('admin.members.status', $member) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-emerald-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Approve">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.members.status', $member) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Reject">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0Zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0Z"/></svg>
                            </div>
                            <p class="text-slate-400 font-medium mb-1">No members found</p>
                            <p class="text-slate-500 text-sm">Members will appear here when they register through the website.</p>
                        </div>
                    </td>
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
