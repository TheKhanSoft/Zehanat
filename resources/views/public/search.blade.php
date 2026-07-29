@extends('layouts.public')

@section('title', 'Search Results - Zehanat')
@section('meta_description', 'Search results for Zehanat.')

@section('content')
<x-public.page-banner title="Search Results" :breadcrumbs="[['label' => 'Home', 'url' => '/'], ['label' => 'Search']]">
    @if($query)
        Showing results for "{{ $query }}"
    @else
        Search our website
    @endif
</x-public.page-banner>

<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('search') }}" method="GET" class="relative mb-12 animate-fade-up">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search again..." class="w-full bg-[#f4f6f9] border border-slate-200 rounded-xl px-6 py-4 text-[#1b1d21] placeholder-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-lg font-heading">
            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </form>

        @if($query && $results->isEmpty())
            <div class="text-center py-16 animate-fade-up stagger-2 bg-[#f4f6f9] rounded-2xl border border-slate-100">
                <div class="w-20 h-20 mx-auto bg-slate-200 rounded-full flex items-center justify-center mb-6 text-slate-400">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-2xl font-heading font-bold text-[#1b1d21] mb-2">No results found</h3>
                <p class="text-slate-500">We couldn't find anything matching "{{ $query }}". Please try another search term.</p>
            </div>
        @elseif($query && $results->isNotEmpty())
            <div class="space-y-6">
                <div class="mb-8 border-b border-slate-100 pb-4">
                    <h2 class="text-xl font-heading font-bold text-[#1b1d21]">Found {{ $results->count() }} {{ Str::plural('result', $results->count()) }}</h2>
                </div>
                
                @foreach($results as $index => $result)
                    <div class="group bg-white border border-slate-100 rounded-2xl p-6 md:p-8 hover:border-primary hover:shadow-xl transition-all duration-300 animate-fade-up" style="animation-delay: {{ min($index * 100, 500) }}ms">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 bg-[#f4f6f9] text-primary text-xs font-bold uppercase tracking-wider rounded-md">{{ $result->type }}</span>
                        </div>
                        <a href="{{ $result->url }}" class="block">
                            <h3 class="text-2xl font-heading font-extrabold text-[#1b1d21] mb-3 group-hover:text-primary transition-colors">{{ $result->title }}</h3>
                        </a>
                        <p class="text-slate-500 line-clamp-3 leading-relaxed">{{ strip_tags($result->excerpt) }}</p>
                        
                        <div class="mt-6">
                            <a href="{{ $result->url }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#1b1d21] group-hover:text-primary transition-colors uppercase tracking-wider">
                                View Details 
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
