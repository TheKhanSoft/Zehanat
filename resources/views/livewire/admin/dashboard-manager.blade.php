<div>
    @section('title', 'Dashboard - Admin Panel')
    @section('page_title', 'Command Center')

    @php
        $chartMax = max(1, collect($activitySeries)->max(fn ($item) => max($item['members'], $item['messages'])));
        $chartCount = max(1, count($activitySeries) - 1);
        $memberPoints = collect($activitySeries)->map(fn ($item, $index) => round(($index / $chartCount) * 100, 2).','.round(34 - (($item['members'] / $chartMax) * 28), 2))->implode(' ');
        $messagePoints = collect($activitySeries)->map(fn ($item, $index) => round(($index / $chartCount) * 100, 2).','.round(34 - (($item['messages'] / $chartMax) * 28), 2))->implode(' ');
        $categoryTotal = max(1, (int) collect($memberCategories)->sum());
        $categoryMeta = [
            'individual' => ['label' => 'Individuals', 'color' => 'bg-cyan-400'],
            'institution' => ['label' => 'Institutions', 'color' => 'bg-violet-400'],
            'industry' => ['label' => 'Industry', 'color' => 'bg-amber-400'],
            'student' => ['label' => 'Students', 'color' => 'bg-emerald-400'],
        ];
        $canCreateNews = auth()->user()->can('create news');
        $canCreateFaqs = auth()->user()->can('create faqs');
        $hasActivityAnalytics = $canViewMembers || $canViewContacts;
        $hasRecentActivity = $canViewMembers || $canViewContacts || $canViewNews;
        $hasQuickActions = $canViewMembers || $canViewContacts || $canCreateNews || $canCreateFaqs;
        $hasSidebarContent = $hasQuickActions || $canViewNews;
        $hasDashboardModules = $canViewMembers || $canViewContacts || $canViewNews || $canViewFaqs;
        $operationalMetrics = [];

        if ($canViewMembers) {
            $operationalMetrics[] = ['label' => 'Member approvals', 'value' => $approvalRate, 'color' => 'bg-cyan-400', 'detail' => number_format($approvedMembers).' approved'];
        }
        if ($canViewContacts) {
            $operationalMetrics[] = ['label' => 'Inbox response', 'value' => $messageReadRate, 'color' => 'bg-violet-400', 'detail' => number_format($totalMessages - $unreadMessages).' reviewed'];
        }
        if ($canViewNews) {
            $operationalMetrics[] = ['label' => 'Content readiness', 'value' => $contentReadiness, 'color' => 'bg-emerald-400', 'detail' => number_format($publishedNews).' published'];
        }
        $hasOperationalHealth = count($operationalMetrics) > 0;
    @endphp

    <div class="space-y-6" wire:loading.class="opacity-70">
        {{-- Command center header --}}
        <section class="admin-panel relative overflow-hidden p-5 sm:p-7">
            <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-teal-400/15 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-1/3 h-36 w-56 rounded-full bg-cyan-500/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
                <div>
                    <div class="mb-3 flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.16em] text-emerald-300">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-50"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                            </span>
                            System operational
                        </span>
                        <span class="text-xs font-medium text-slate-500">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                    <h1 class="text-2xl font-black tracking-tight text-white sm:text-4xl">
                        Welcome back, {{ str(auth()->user()->name)->before(' ') }}.
                    </h1>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-400 sm:text-base">
                        Your command center is personalized to the modules and workflows assigned to your role.
                    </p>
                </div>

                @if($canViewMembers || $canViewContacts || $canViewNews)
                    <div class="inline-flex w-full rounded-2xl border border-slate-700/70 bg-slate-950/55 p-1.5 shadow-inner sm:w-auto">
                        @foreach([7 => '7 days', 30 => '30 days', 90 => '90 days'] as $days => $label)
                            <button
                                type="button"
                                wire:click="setRange({{ $days }})"
                                class="flex-1 rounded-xl px-4 py-2 text-xs font-bold transition sm:flex-none {{ $range === $days ? 'bg-teal-500 text-white shadow-lg shadow-teal-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                            >
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- Primary metrics --}}
        @if($hasDashboardModules)
            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                @if($canViewMembers)
                    <x-admin.stat-card
                        title="Total Members"
                        value="{{ number_format($totalMembers) }}"
                        :trend="$memberTrend"
                        meta="{{ number_format($memberPeriodCount) }} new in period"
                        color="cyan"
                        href="{{ route('admin.members.index') }}"
                        icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z" /></svg>'
                    />
                    <x-admin.stat-card
                        title="Pending Approvals"
                        value="{{ number_format($pendingMembers) }}"
                        meta="{{ $approvalRate }}% overall approval rate"
                        color="amber"
                        href="{{ route('admin.members.index', ['status' => 'pending']) }}"
                        icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25m5-2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>'
                    />
                @endif
                @if($canViewContacts)
                    <x-admin.stat-card
                        title="Unread Messages"
                        value="{{ number_format($unreadMessages) }}"
                        :trend="$messageTrend"
                        meta="{{ number_format($messagePeriodCount) }} received in period"
                        color="rose"
                        href="{{ route('admin.contacts.index', ['status' => 'unread']) }}"
                        icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>'
                    />
                @endif
                @if($canViewNews)
                    <x-admin.stat-card
                        title="Published Content"
                        value="{{ number_format($publishedNews) }}"
                        :trend="$contentTrend"
                        meta="{{ $draftNews }} drafts awaiting review"
                        color="emerald"
                        href="{{ route('admin.news.index') }}"
                        icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5V6.75a3.375 3.375 0 0 0-3.375-3.375H8.625m0 12.75h7.5m-7.5 3h4.5M10.5 3.375H5.625c-.621 0-1.125.504-1.125 1.125v15c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V12.375a9 9 0 0 0-9-9Z" /></svg>'
                    />
                @endif
                @if($canViewFaqs)
                    <x-admin.stat-card
                        title="Active FAQs"
                        value="{{ number_format($activeFaqs) }}"
                        meta="Published help entries"
                        color="indigo"
                        href="{{ route('admin.faqs.index') }}"
                        icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" /></svg>'
                    />
                @endif
            </section>
        @else
            <section class="admin-panel border-dashed p-8 text-center">
                <p class="text-base font-black text-white">No operational modules assigned</p>
                <p class="mx-auto mt-2 max-w-xl text-sm leading-6 text-slate-500">Your account can access the dashboard, but no Members, Contacts, News, or FAQ reporting modules are currently assigned.</p>
            </section>
        @endif

        @if($hasActivityAnalytics || $hasOperationalHealth)
        <div class="grid gap-6 {{ $hasActivityAnalytics && $hasOperationalHealth ? 'xl:grid-cols-[minmax(0,1.65fr)_minmax(300px,0.75fr)]' : '' }}">
            {{-- Activity analytics --}}
            @if($hasActivityAnalytics)
            <section class="admin-panel overflow-hidden">
                <div class="flex flex-col gap-3 border-b border-slate-700/50 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h2 class="text-lg font-bold text-white">Growth & engagement</h2>
                        <p class="mt-1 text-sm text-slate-500">Applications and inquiries over the selected period.</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs font-semibold">
                        @if($canViewMembers)
                            <span class="inline-flex items-center gap-2 text-slate-400"><span class="h-2.5 w-2.5 rounded-full bg-cyan-400"></span>Members</span>
                        @endif
                        @if($canViewContacts)
                            <span class="inline-flex items-center gap-2 text-slate-400"><span class="h-2.5 w-2.5 rounded-full bg-violet-400"></span>Messages</span>
                        @endif
                    </div>
                </div>
                <div class="p-5 sm:p-6">
                    <div class="mb-5 grid gap-4 {{ $canViewMembers && $canViewContacts ? 'grid-cols-2' : 'grid-cols-1' }}">
                        @if($canViewMembers)
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">New applications</p>
                                <p class="mt-1 text-2xl font-black text-white">{{ number_format($memberPeriodCount) }}</p>
                            </div>
                        @endif
                        @if($canViewContacts)
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">New inquiries</p>
                                <p class="mt-1 text-2xl font-black text-white">{{ number_format($messagePeriodCount) }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="relative h-64 overflow-hidden rounded-2xl border border-slate-800 bg-slate-950/45 p-4">
                        <div class="pointer-events-none absolute inset-x-4 top-1/4 border-t border-dashed border-slate-800"></div>
                        <div class="pointer-events-none absolute inset-x-4 top-1/2 border-t border-dashed border-slate-800"></div>
                        <div class="pointer-events-none absolute inset-x-4 top-3/4 border-t border-dashed border-slate-800"></div>
                        <svg class="relative h-full w-full overflow-visible" viewBox="0 0 100 36" preserveAspectRatio="none" aria-label="Activity trend chart">
                            <defs>
                                <linearGradient id="member-area" x1="0" x2="0" y1="0" y2="1">
                                    <stop offset="0%" stop-color="#22d3ee" stop-opacity=".25" />
                                    <stop offset="100%" stop-color="#22d3ee" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            @if($canViewMembers)
                                <polygon points="0,36 {{ $memberPoints }} 100,36" fill="url(#member-area)" />
                                <polyline points="{{ $memberPoints }}" fill="none" stroke="#22d3ee" stroke-width="1.15" vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" />
                            @endif
                            @if($canViewContacts)
                                <polyline points="{{ $messagePoints }}" fill="none" stroke="#a78bfa" stroke-width="1.15" vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" />
                            @endif
                        </svg>
                        <div class="absolute inset-x-4 bottom-2 flex justify-between text-[10px] font-semibold text-slate-600">
                            <span>{{ data_get($activitySeries, '0.label') }}</span>
                            <span>{{ data_get($activitySeries, floor(count($activitySeries) / 2).'.label') }}</span>
                            <span>{{ data_get($activitySeries, (count($activitySeries) - 1).'.label') }}</span>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            {{-- Operational health --}}
            @if($hasOperationalHealth)
            <section class="admin-panel p-5 sm:p-6">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-white">Operational health</h2>
                    <p class="mt-1 text-sm text-slate-500">Workflow completion at a glance.</p>
                </div>
                <div class="space-y-6">
                    @foreach($operationalMetrics as $metric)
                        <div>
                            <div class="mb-2 flex items-end justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-300">{{ $metric['label'] }}</p>
                                    <p class="mt-0.5 text-xs text-slate-600">{{ $metric['detail'] }}</p>
                                </div>
                                <span class="text-sm font-black text-white">{{ $metric['value'] }}%</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-slate-800">
                                <div class="h-full rounded-full {{ $metric['color'] }} transition-all duration-700" style="width: {{ $metric['value'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($canViewNews)
                    <div class="mt-7 border-t border-slate-800 pt-5">
                        <div class="rounded-2xl bg-slate-950/50 p-3.5">
                            <p class="text-xs text-slate-500">Content drafts</p>
                            <p class="mt-1 text-xl font-black text-white">{{ number_format($draftNews) }}</p>
                        </div>
                    </div>
                @endif
            </section>
            @endif
        </div>
        @endif

        @if($hasRecentActivity || $hasSidebarContent)
        <div class="grid gap-6 {{ $hasRecentActivity && $hasSidebarContent ? 'xl:grid-cols-[minmax(0,1.25fr)_minmax(340px,0.75fr)]' : '' }}">
            {{-- Recent activity --}}
            @if($hasRecentActivity)
            <section class="admin-panel overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-700/50 px-5 py-5 sm:px-6">
                    <div>
                        <h2 class="text-lg font-bold text-white">Recent activity</h2>
                        <p class="mt-1 text-sm text-slate-500">Latest changes across every module.</p>
                    </div>
                    <span class="hidden rounded-full border border-slate-700 bg-slate-800/70 px-3 py-1 text-xs font-bold text-slate-400 sm:inline-flex">Live feed</span>
                </div>
                <div class="divide-y divide-slate-800/80">
                    @forelse($recentActivity as $activity)
                        <a href="{{ $activity['url'] }}" class="group flex items-center gap-4 px-5 py-4 transition hover:bg-slate-800/35 sm:px-6">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl border
                                {{ $activity['type'] === 'member' ? 'border-cyan-400/20 bg-cyan-400/10 text-cyan-300' : ($activity['type'] === 'message' ? 'border-violet-400/20 bg-violet-400/10 text-violet-300' : 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300') }}">
                                @if($activity['type'] === 'member')
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                @elseif($activity['type'] === 'message')
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0L13.18 12.524a2.25 2.25 0 0 1-2.36 0L2.25 6.75" /></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5V6.75a3.375 3.375 0 0 0-3.375-3.375H8.625m0 12.75h7.5m-7.5 3h4.5M10.5 3.375H5.625c-.621 0-1.125.504-1.125 1.125v15c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V12.375a9 9 0 0 0-9-9Z" /></svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="truncate text-sm font-bold text-slate-200 transition group-hover:text-white">{{ $activity['title'] }}</p>
                                    <span class="rounded-full px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide
                                        {{ in_array($activity['status'], ['approved', 'published', 'read']) ? 'bg-emerald-400/10 text-emerald-300' : (in_array($activity['status'], ['pending', 'draft']) ? 'bg-amber-400/10 text-amber-300' : 'bg-rose-400/10 text-rose-300') }}">
                                        {{ $activity['status'] }}
                                    </span>
                                </div>
                                <p class="mt-1 truncate text-xs text-slate-500">{{ $activity['description'] }}</p>
                            </div>
                            <div class="flex-none text-right">
                                <p class="text-xs font-medium text-slate-500">{{ $activity['date']->diffForHumans(short: true) }}</p>
                                <svg class="ml-auto mt-1 h-4 w-4 text-slate-700 transition group-hover:translate-x-0.5 group-hover:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" /></svg>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-14 text-center text-sm text-slate-500">Activity will appear here as your team works.</div>
                    @endforelse
                </div>
            </section>
            @endif

            @if($hasSidebarContent)
            <div class="space-y-6">
                {{-- Quick actions --}}
                @if($hasQuickActions)
                <section class="admin-panel p-5 sm:p-6">
                    <h2 class="text-lg font-bold text-white">Quick actions</h2>
                    <p class="mt-1 text-sm text-slate-500">Jump directly into common workflows.</p>
                    <div class="mt-5 grid grid-cols-2 gap-3">
                        @can('view members')
                            <a href="{{ route('admin.members.index', ['status' => 'pending']) }}" class="admin-quick-action">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.25m5-2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                </span>
                                Review members
                            </a>
                        @endcan
                        @can('view contacts')
                            <a href="{{ route('admin.contacts.index', ['status' => 'unread']) }}" class="admin-quick-action">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-violet-400/10 text-violet-300">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0L13.18 12.524a2.25 2.25 0 0 1-2.36 0L2.25 6.75" /></svg>
                                </span>
                                Open inbox
                            </a>
                        @endcan
                        @can('create news')
                            <a href="{{ route('admin.news.index') }}" class="admin-quick-action">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                </span>
                                Create content
                            </a>
                        @endcan
                        @can('create faqs')
                            <a href="{{ route('admin.faqs.index') }}" class="admin-quick-action">
                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-cyan-400/10 text-cyan-300">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.625 9.75a3.375 3.375 0 1 1 6.75 0c0 1.205-.633 2.263-1.584 2.86-.806.506-1.791 1.188-1.791 2.265v.375M12 18h.008v.008H12V18Z" /></svg>
                                </span>
                                Add an FAQ
                            </a>
                        @endcan
                    </div>
                </section>
                @endif

                {{-- Upcoming events --}}
                @if($canViewNews)
                <section class="admin-panel overflow-hidden">
                    <div class="flex items-center justify-between border-b border-slate-700/50 px-5 py-4">
                        <div>
                            <h2 class="font-bold text-white">Upcoming events</h2>
                            <p class="mt-0.5 text-xs text-slate-500">Scheduled dates</p>
                        </div>
                        @can('view news')
                            <a href="{{ route('admin.news.index') }}" class="text-xs font-bold text-teal-400 transition hover:text-teal-300">View all</a>
                        @endcan
                    </div>
                    <div class="divide-y divide-slate-800">
                        @forelse($upcomingEvents as $event)
                            <a href="{{ route('admin.news.index') }}" class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-800/35">
                                <div class="flex h-12 w-12 flex-none flex-col items-center justify-center rounded-xl border border-teal-400/20 bg-teal-400/10">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-teal-300">{{ $event->event_date->format('M') }}</span>
                                    <span class="text-lg font-black leading-none text-white">{{ $event->event_date->format('d') }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-slate-200">{{ $event->title }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $event->event_date->diffForHumans() }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="px-5 py-8 text-center">
                                <p class="text-sm font-medium text-slate-400">No upcoming events</p>
                                <p class="mt-1 text-xs text-slate-600">New scheduled events will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
                @endif
            </div>
            @endif
        </div>
        @endif

        {{-- Membership composition --}}
        @if($canViewMembers)
        <section class="admin-panel p-5 sm:p-6">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-md">
                    <h2 class="text-lg font-bold text-white">Membership composition</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500">Understand who makes up the Zehanat network and where outreach can improve.</p>
                </div>
                <div class="grid flex-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach($categoryMeta as $key => $meta)
                        @php
                            $categoryCount = (int) ($memberCategories[$key] ?? 0);
                            $categoryPercentage = round(($categoryCount / $categoryTotal) * 100);
                        @endphp
                        <div class="rounded-2xl border border-slate-800 bg-slate-950/35 p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400">{{ $meta['label'] }}</span>
                                <span class="h-2.5 w-2.5 rounded-full {{ $meta['color'] }}"></span>
                            </div>
                            <div class="mt-3 flex items-end justify-between">
                                <span class="text-2xl font-black text-white">{{ number_format($categoryCount) }}</span>
                                <span class="text-xs font-bold text-slate-500">{{ $categoryPercentage }}%</span>
                            </div>
                            <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-800">
                                <div class="h-full rounded-full {{ $meta['color'] }}" style="width: {{ $categoryPercentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </div>
</div>
