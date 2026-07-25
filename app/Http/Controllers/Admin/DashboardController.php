<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\ContactMessage;
use App\Models\NewsEvent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $pendingMembers = Member::pending()->count();
        $unreadMessages = ContactMessage::unread()->count();
        $publishedNews = NewsEvent::published()->count();
        $recentMembers = Member::latest()->take(5)->get();
        $totalFaqs = \App\Models\Faq::count();
        
        $recentContacts = ContactMessage::latest()->take(5)->get();
        $membersByCategory = Member::selectRaw('category, count(*) as count')->groupBy('category')->pluck('count', 'category');
        
        $recentActivity = collect([
            ...$recentMembers->map(function($m) { $m->activity_type = 'member'; return $m; }),
            ...$recentContacts->map(function($c) { $c->activity_type = 'contact'; return $c; })
        ])->sortByDesc('created_at')->take(5);
        
        return view('admin.dashboard', compact(
            'totalMembers', 'pendingMembers', 'unreadMessages', 'publishedNews', 'recentMembers', 'totalFaqs', 'recentContacts', 'membersByCategory', 'recentActivity'
        ));
    }
}
