@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <x-admin.stat-card title="Total Members" value="{{ $totalMembers ?? 0 }}" icon="👥" color="teal" />
        <x-admin.stat-card title="Pending Members" value="{{ $pendingMembers ?? 0 }}" icon="📋" color="amber" />
        <x-admin.stat-card title="Unread Messages" value="{{ $unreadMessages ?? 0 }}" icon="✉️" color="rose" />
        <x-admin.stat-card title="Published News" value="{{ $publishedNews ?? 0 }}" icon="📰" color="blue" />
        <x-admin.stat-card title="Total FAQs" value="{{ $totalFaqs ?? 0 }}" icon="❓" color="purple" />
    </div>

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.faqs.create') }}" class="flex items-center justify-center gap-3 p-4 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl text-slate-300 hover:text-white hover:bg-slate-700/50 hover:border-teal-500/50 hover:shadow-[0_0_15px_rgba(20,184,166,0.15)] transition-all duration-300 group">
            <div class="p-2 bg-teal-500/10 rounded-lg text-teal-400 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="font-medium">Add New FAQ</span>
        </a>
        <a href="{{ route('admin.news.create') }}" class="flex items-center justify-center gap-3 p-4 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl text-slate-300 hover:text-white hover:bg-slate-700/50 hover:border-blue-500/50 hover:shadow-[0_0_15px_rgba(59,130,246,0.15)] transition-all duration-300 group">
            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20" /></svg>
            </div>
            <span class="font-medium">Create News/Event</span>
        </a>
        <a href="{{ route('admin.members.index') }}" class="flex items-center justify-center gap-3 p-4 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl text-slate-300 hover:text-white hover:bg-slate-700/50 hover:border-indigo-500/50 hover:shadow-[0_0_15px_rgba(99,102,241,0.15)] transition-all duration-300 group">
            <div class="p-2 bg-indigo-500/10 rounded-lg text-indigo-400 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <span class="font-medium">View All Members</span>
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="flex items-center justify-center gap-3 p-4 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl text-slate-300 hover:text-white hover:bg-slate-700/50 hover:border-rose-500/50 hover:shadow-[0_0_15px_rgba(244,63,94,0.15)] transition-all duration-300 group">
            <div class="p-2 bg-rose-500/10 rounded-lg text-rose-400 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
            <span class="font-medium">Check Messages</span>
        </a>
    </div>

    <!-- Main Content Area -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Recent Members
            </h3>
            <a href="{{ route('admin.members.index') }}" class="text-teal-400 hover:text-teal-300 text-sm font-medium transition-colors">
                View All &rarr;
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
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0Zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0Z"/></svg>
                            </div>
                            <p class="text-slate-400 font-medium mb-1">No recent members</p>
                            <p class="text-slate-500 text-sm">New member registrations will appear here.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>

    <!-- Two-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Contacts -->
        <div class="lg:col-span-2 bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 backdrop-blur-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    Recent Contact Messages
                </h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-rose-400 hover:text-rose-300 text-sm font-medium transition-colors">
                    View All &rarr;
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-800/80">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-slate-400 uppercase rounded-l-lg">Name</th>
                            <th class="px-4 py-3 text-xs font-medium text-slate-400 uppercase">Subject</th>
                            <th class="px-4 py-3 text-xs font-medium text-slate-400 uppercase">Date</th>
                            <th class="px-4 py-3 text-xs font-medium text-slate-400 uppercase rounded-r-lg">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($recentContacts ?? [] as $contact)
                        <tr class="hover:bg-slate-700/20 transition-colors">
                            <td class="px-4 py-3 text-sm font-medium text-white">{{ $contact->name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-300">{{ Str::limit($contact->subject, 30) }}</td>
                            <td class="px-4 py-3 text-sm text-slate-400">{{ $contact->created_at->format('M d') }}</td>
                            <td class="px-4 py-3">
                                @if(!$contact->is_read)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-amber-500/20 text-amber-400 border border-amber-500/30">Unread</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-500/20 text-slate-400 border border-slate-500/30">Read</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-sm text-slate-500">No messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Membership Breakdown -->
        <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 backdrop-blur-sm">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                Membership Breakdown
            </h3>
            
            <div class="space-y-5">
                @php 
                    $total = isset($membersByCategory) && $membersByCategory->count() > 0 ? $membersByCategory->sum() : 1; 
                    $colors = ['Individual' => 'bg-teal-500', 'Institution' => 'bg-blue-500', 'Industry' => 'bg-purple-500', 'Student' => 'bg-amber-500'];
                @endphp
                @if(isset($membersByCategory) && $membersByCategory->count() > 0)
                    @foreach($membersByCategory as $category => $count)
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="text-slate-300 font-medium">{{ $category }}</span>
                            <span class="text-slate-400">{{ $count }} ({{ round(($count / $total) * 100) }}%)</span>
                        </div>
                        <div class="w-full bg-slate-700/50 rounded-full h-2">
                            <div class="{{ $colors[$category] ?? 'bg-slate-500' }} h-2 rounded-full" style="width: {{ ($count / $total) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8 text-slate-500 text-sm">
                        No membership data available.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 backdrop-blur-sm">
        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Recent Activity
        </h3>
        
        <div class="space-y-4">
            @forelse($recentActivity ?? [] as $activity)
                <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-slate-700/30 transition-colors">
                    @if($activity->activity_type === 'member')
                        <div class="w-10 h-10 rounded-full bg-teal-500/10 text-teal-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-300"><span class="font-bold text-white">{{ $activity->name }}</span> registered as a new <span class="text-teal-400">{{ $activity->category }}</span> member.</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-full bg-rose-500/10 text-rose-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-300">New contact message from <span class="font-bold text-white">{{ $activity->name }}</span> regarding <span class="text-rose-400">"{{ Str::limit($activity->subject, 30) }}"</span>.</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-6 text-slate-500 text-sm">
                    No recent activity to show.
                </div>
            @endforelse
        </div>
    </div>

    <!-- System Info -->
    <div class="bg-slate-800/30 rounded-xl border border-slate-700/30 p-4 flex flex-wrap items-center justify-between text-xs text-slate-500 gap-4">
        <div class="flex items-center gap-6">
            <span class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-emerald-500"></div> System Online</span>
            <span>Laravel v{{ app()->version() }}</span>
            <span>PHP v{{ phpversion() }}</span>
        </div>
        <div class="flex items-center gap-6">
            <span>Total FAQs: <span class="font-medium text-slate-400">{{ $totalFaqs ?? 0 }}</span></span>
            <span>Published News: <span class="font-medium text-slate-400">{{ $publishedNews ?? 0 }}</span></span>
        </div>
    </div>
</div>
@endsection
