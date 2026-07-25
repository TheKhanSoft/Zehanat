<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsEventController extends Controller
{
    public function index()
    {
        $newsEvents = NewsEvent::latest()->paginate(10);
        return view('admin.news.index', compact('newsEvents'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,event',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'event_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        
        if (!isset($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        NewsEvent::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News/Event created successfully.');
    }

    public function edit($id)
    {
        $newsEvent = NewsEvent::findOrFail($id);
        return view('admin.news.edit', compact('newsEvent'));
    }

    public function update(Request $request, $id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,event',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'event_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        $newsEvent->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News/Event updated successfully.');
    }

    public function destroy($id)
    {
        $newsEvent = NewsEvent::findOrFail($id);
        $newsEvent->delete();

        return redirect()->route('admin.news.index')->with('success', 'News/Event deleted successfully.');
    }
}
