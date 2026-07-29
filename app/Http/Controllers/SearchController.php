<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsEvent;
use App\Models\Faq;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (empty(trim($query))) {
            return view('public.search', ['results' => collect(), 'query' => $query]);
        }

        // Search News/Events
        $newsEvents = NewsEvent::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('body', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'News & Events',
                    'title' => $item->title,
                    'excerpt' => $item->excerpt ?? str($item->body)->limit(150),
                    'url' => '#', // Since there's no detail page yet
                ];
            });

        // Search FAQs
        $faqs = Faq::active()
            ->where(function($q) use ($query) {
                $q->where('question', 'like', "%{$query}%")
                  ->orWhere('answer', 'like', "%{$query}%");
            })
            ->get()
            ->map(function ($item) {
                return (object)[
                    'type' => 'FAQ',
                    'title' => $item->question,
                    'excerpt' => str($item->answer)->limit(150),
                    'url' => route('faq') . '#faq-' . $item->id,
                ];
            });

        // Search Static Pages - basic matching on standard terms
        $pages = collect([
            ['title' => 'About Zehanat', 'url' => route('about'), 'terms' => ['about', 'story', 'history', 'mission', 'vision', 'governance', 'patron']],
            ['title' => 'Our Six Pillars', 'url' => route('pillars'), 'terms' => ['pillars', 'six pillars', 'research', 'education', 'innovation', 'ethics', 'collaboration', 'policy']],
            ['title' => 'Programs', 'url' => route('programs'), 'terms' => ['programs', 'schools', 'colleges', 'universities', 'industry', 'public']],
            ['title' => 'Membership', 'url' => route('membership'), 'terms' => ['membership', 'join', 'register', 'individual', 'institution', 'industry', 'student chapter']],
            ['title' => 'Contact Us', 'url' => route('contact'), 'terms' => ['contact', 'email', 'phone', 'location', 'address', 'get in touch']],
        ]);

        $pageResults = $pages->filter(function($page) use ($query) {
            $lowerQuery = strtolower($query);
            if (str_contains(strtolower($page['title']), $lowerQuery)) {
                return true;
            }
            foreach ($page['terms'] as $term) {
                if (str_contains($term, $lowerQuery)) {
                    return true;
                }
            }
            return false;
        })->map(function ($item) {
            return (object)[
                'type' => 'Page',
                'title' => $item['title'],
                'excerpt' => 'Information about ' . $item['title'],
                'url' => $item['url'],
            ];
        });

        // Combine all results
        $results = $newsEvents->concat($faqs)->concat($pageResults);

        return view('public.search', compact('results', 'query'));
    }
}
