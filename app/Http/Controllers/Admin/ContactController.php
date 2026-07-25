<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactMessage::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = ContactMessage::findOrFail($id);
        
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead($id)
    {
        $contact = ContactMessage::findOrFail($id);
        $contact->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'Message marked as read.');
    }
}
