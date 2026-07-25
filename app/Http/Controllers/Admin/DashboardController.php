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
        
        return view('admin.dashboard', compact(
            'totalMembers', 'pendingMembers', 'unreadMessages', 'publishedNews', 'recentMembers'
        ));
    }
}
