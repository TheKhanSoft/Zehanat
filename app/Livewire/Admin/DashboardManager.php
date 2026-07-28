<?php

namespace App\Livewire\Admin;

use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Member;
use App\Models\NewsEvent;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class DashboardManager extends Component
{
    public int $range = 30;

    protected $queryString = [
        'range' => ['except' => 30],
    ];

    public function mount()
    {
        abort_if(! auth()->user()->can('view dashboard'), 403);

        if (! in_array($this->range, [7, 30, 90], true)) {
            $this->range = 30;
        }
    }

    public function setRange(int $range): void
    {
        if (in_array($range, [7, 30, 90], true)) {
            $this->range = $range;
        }
    }

    public function render()
    {
        $user = auth()->user();
        abort_if(! $user->can('view dashboard'), 403);

        $canViewMembers = $user->can('view members');
        $canViewContacts = $user->can('view contacts');
        $canViewNews = $user->can('view news');
        $canViewFaqs = $user->can('view faqs');

        $periodStart = now()->subDays($this->range - 1)->startOfDay();
        $previousStart = $periodStart->copy()->subDays($this->range);
        $previousEnd = $periodStart->copy()->subSecond();

        $totalMembers = $pendingMembers = $approvedMembers = 0;
        $memberPeriodCount = $memberPreviousCount = 0;
        $memberDates = collect();
        $memberCategories = collect();

        if ($canViewMembers) {
            $totalMembers = Member::count();
            $pendingMembers = Member::pending()->count();
            $approvedMembers = Member::approved()->count();
            $memberPeriodCount = Member::where('created_at', '>=', $periodStart)->count();
            $memberPreviousCount = Member::whereBetween('created_at', [$previousStart, $previousEnd])->count();
            $memberDates = Member::where('created_at', '>=', $periodStart)->pluck('created_at');
            $memberCategories = Member::selectRaw('category, COUNT(*) as total')
                ->groupBy('category')
                ->pluck('total', 'category');
        }

        $unreadMessages = $totalMessages = 0;
        $messagePeriodCount = $messagePreviousCount = 0;
        $messageDates = collect();

        if ($canViewContacts) {
            $unreadMessages = ContactMessage::unread()->count();
            $totalMessages = ContactMessage::count();
            $messagePeriodCount = ContactMessage::where('created_at', '>=', $periodStart)->count();
            $messagePreviousCount = ContactMessage::whereBetween('created_at', [$previousStart, $previousEnd])->count();
            $messageDates = ContactMessage::where('created_at', '>=', $periodStart)->pluck('created_at');
        }

        $publishedNews = $draftNews = 0;
        $contentPeriodCount = $contentPreviousCount = 0;

        if ($canViewNews) {
            $publishedNews = NewsEvent::published()->count();
            $draftNews = NewsEvent::where('is_published', false)->count();
            $contentPeriodCount = NewsEvent::where('created_at', '>=', $periodStart)->count();
            $contentPreviousCount = NewsEvent::whereBetween('created_at', [$previousStart, $previousEnd])->count();
        }

        $activeFaqs = $canViewFaqs ? Faq::active()->count() : 0;
        $activitySeries = $this->buildActivitySeries($periodStart, $memberDates, $messageDates);

        $recentMembers = $canViewMembers ? Member::latest()->take(5)->get() : collect();
        $recentContacts = $canViewContacts ? ContactMessage::latest()->take(5)->get() : collect();
        $recentNews = $canViewNews ? NewsEvent::latest()->take(4)->get() : collect();

        $recentActivity = $this->buildRecentActivity($recentMembers, $recentContacts, $recentNews);
        $upcomingEvents = $canViewNews
            ? NewsEvent::events()
                ->whereNotNull('event_date')
                ->whereDate('event_date', '>=', today())
                ->orderBy('event_date')
                ->take(4)
                ->get()
            : collect();

        return view('livewire.admin.dashboard-manager', [
            'totalMembers' => $totalMembers,
            'pendingMembers' => $pendingMembers,
            'approvedMembers' => $approvedMembers,
            'unreadMessages' => $unreadMessages,
            'totalMessages' => $totalMessages,
            'publishedNews' => $publishedNews,
            'draftNews' => $draftNews,
            'activeFaqs' => $activeFaqs,
            'memberPeriodCount' => $memberPeriodCount,
            'messagePeriodCount' => $messagePeriodCount,
            'activitySeries' => $activitySeries,
            'memberCategories' => $memberCategories,
            'recentActivity' => $recentActivity,
            'upcomingEvents' => $upcomingEvents,
            'memberTrend' => $this->percentageChange($memberPeriodCount, $memberPreviousCount),
            'messageTrend' => $this->percentageChange($messagePeriodCount, $messagePreviousCount),
            'contentTrend' => $this->percentageChange($contentPeriodCount, $contentPreviousCount),
            'approvalRate' => $totalMembers > 0 ? round(($approvedMembers / $totalMembers) * 100) : 0,
            'messageReadRate' => $totalMessages > 0 ? round((($totalMessages - $unreadMessages) / $totalMessages) * 100) : 0,
            'contentReadiness' => ($publishedNews + $draftNews) > 0 ? round(($publishedNews / ($publishedNews + $draftNews)) * 100) : 0,
            'canViewMembers' => $canViewMembers,
            'canViewContacts' => $canViewContacts,
            'canViewNews' => $canViewNews,
            'canViewFaqs' => $canViewFaqs,
        ])->layout('layouts.admin');
    }

    private function buildActivitySeries(CarbonInterface $start, Collection $memberDates, Collection $messageDates): array
    {
        $memberCounts = $memberDates->countBy(fn ($date) => $date->format('Y-m-d'));
        $messageCounts = $messageDates->countBy(fn ($date) => $date->format('Y-m-d'));
        $series = [];

        for ($day = $start->copy(); $day->lte(today()); $day = $day->addDay()) {
            $key = $day->format('Y-m-d');
            $series[] = [
                'date' => $key,
                'label' => $this->range <= 7 ? $day->format('D') : $day->format('M j'),
                'members' => (int) ($memberCounts[$key] ?? 0),
                'messages' => (int) ($messageCounts[$key] ?? 0),
            ];
        }

        return $series;
    }

    private function buildRecentActivity(Collection $members, Collection $contacts, Collection $news): Collection
    {
        return $members->map(fn (Member $member) => [
            'type' => 'member',
            'title' => $member->name,
            'description' => ucfirst($member->category).' membership application',
            'status' => $member->status,
            'date' => $member->created_at,
            'url' => route('admin.members.index'),
        ])->concat($contacts->map(fn (ContactMessage $message) => [
            'type' => 'message',
            'title' => $message->name,
            'description' => $message->subject,
            'status' => $message->is_read ? 'read' : 'unread',
            'date' => $message->created_at,
            'url' => route('admin.contacts.index'),
        ]))->concat($news->map(fn (NewsEvent $item) => [
            'type' => 'content',
            'title' => $item->title,
            'description' => ucfirst($item->type).' '.($item->is_published ? 'published' : 'saved as draft'),
            'status' => $item->is_published ? 'published' : 'draft',
            'date' => $item->created_at,
            'url' => route('admin.news.index'),
        ]))->sortByDesc('date')->take(8)->values();
    }

    private function percentageChange(int $current, int $previous): string
    {
        if ($previous === 0) {
            return $current > 0 ? '+100%' : '0%';
        }

        $change = round((($current - $previous) / $previous) * 100);

        return ($change > 0 ? '+' : '').$change.'%';
    }
}
