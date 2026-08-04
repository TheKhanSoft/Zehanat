@extends('layouts.public')

@section('title', $newsEvent->title . ' - Zehanat')
@section('meta_description', Str::limit(strip_tags($newsEvent->excerpt ?? $newsEvent->body), 150))

@section('content')
<x-public.page-banner title="{{ $newsEvent->title }}" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'News & Events', 'url' => '/news-events'], ['label' => $newsEvent->title]]">
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-[#f4f6f9] relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white p-8 sm:p-12 border border-slate-100 shadow-xl relative overflow-hidden rounded-2xl">
            @if($newsEvent->image)
            <div class="mb-8 rounded-xl overflow-hidden shadow-sm border border-slate-100">
                <img src="{{ str_starts_with($newsEvent->image, 'http') || str_starts_with($newsEvent->image, '/') ? $newsEvent->image : asset('storage/'.$newsEvent->image) }}" alt="{{ $newsEvent->title }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>
            @endif

            <div class="flex flex-wrap gap-4 pt-2 mb-6 text-xs font-heading font-bold text-[#1b1d21]">
                @if($newsEvent->event_date)
                <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                    <span class="text-[#43baff]">📅 Date:</span> {{ $newsEvent->event_date->format('F d, Y') }}
                </div>
                @else
                <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200">
                    <span class="text-[#43baff]">📅 Published:</span> {{ $newsEvent->created_at->format('F d, Y') }}
                </div>
                @endif
                <div class="flex items-center gap-2 bg-[#f4f6f9] px-4 py-2 rounded-xl border border-slate-200 uppercase">
                    <span class="text-[#43baff]">🏷️ Type:</span> {{ $newsEvent->type }}
                </div>
            </div>

            <h1 class="text-3xl sm:text-4xl font-heading font-extrabold text-[#1b1d21] mb-6">{{ $newsEvent->title }}</h1>
            
            @if($newsEvent->excerpt)
            <div class="text-[#1b1d21] font-semibold text-lg mb-8 p-4 bg-[#f4f6f9] rounded-xl border-l-4 border-[#43baff]">
                {{ $newsEvent->excerpt }}
            </div>
            @endif

            <div class="prose prose-lg prose-slate max-w-none text-[#5e6278]">
                {!! $newsEvent->body !!}
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex justify-between items-center">
                <a href="/news-events" class="inline-flex items-center gap-2 text-sm font-bold text-[#43baff] hover:text-[#1b1d21] transition-colors">
                    &larr; Back to News & Events
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
