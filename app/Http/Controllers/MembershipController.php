<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Mail\WelcomeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MembershipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'category' => 'required|in:individual,institution,industry,student',
            'institution' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
        ]);
        
        $member = Member::create($validated);
        
        // Send welcome email
        Mail::to($member->email)->send(new WelcomeMember($member));
        
        return redirect()->back()->with('success', 'Your membership application has been submitted successfully! A welcome email has been sent to your address.');
    }
}
