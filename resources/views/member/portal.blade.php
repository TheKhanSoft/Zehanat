@extends('layouts.public')

@section('title', 'Member Portal Preview — Zehanat')

@section('content')
<section class="relative overflow-hidden py-12 sm:py-16">
    <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 rounded-full bg-teal-400/10 blur-3xl"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-teal-400/20 bg-teal-400/10 px-3 py-1 text-xs font-black uppercase tracking-[0.16em] text-teal-300">
                    Member portal preview
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-white sm:text-5xl">Welcome, {{ str($member->name)->before(' ') }}.</h1>
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-400">This is the experience available to this approved member. Administrative controls remain protected while impersonation is active.</p>
            </div>
            <div class="flex items-center gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-emerald-300">Membership active</p>
                    <p class="mt-0.5 text-xs text-slate-500">Joined {{ $member->created_at->format('F Y') }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.5fr)_minmax(300px,.7fr)]">
            <div class="space-y-6">
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach([
                        ['label' => 'Membership', 'value' => ucfirst($member->category), 'color' => 'text-cyan-300 bg-cyan-400/10'],
                        ['label' => 'Status', 'value' => ucfirst($member->status), 'color' => 'text-emerald-300 bg-emerald-400/10'],
                        ['label' => 'Member since', 'value' => $member->created_at->format('M Y'), 'color' => 'text-violet-300 bg-violet-400/10'],
                    ] as $item)
                        <div class="rounded-3xl border border-slate-700/60 bg-slate-900/65 p-5 backdrop-blur-xl">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ $item['label'] }}</p>
                            <p class="mt-3 inline-flex rounded-xl px-3 py-1.5 text-sm font-black {{ $item['color'] }}">{{ $item['value'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="rounded-3xl border border-slate-700/60 bg-slate-900/65 p-6 backdrop-blur-xl sm:p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-black text-white">Explore Zehanat</h2>
                            <p class="mt-1 text-sm text-slate-500">Member resources and opportunities.</p>
                        </div>
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <a href="{{ route('programs') }}" class="group rounded-2xl border border-slate-700/60 bg-slate-950/40 p-5 transition hover:-translate-y-0.5 hover:border-teal-400/30 hover:bg-slate-800/60">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-400/10 text-teal-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 19.5h15m-13.5-3 3.75-4.5 3 3L18 8.25" /></svg>
                            </span>
                            <h3 class="mt-4 font-black text-white">Programs</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">Discover workshops, initiatives, and learning opportunities.</p>
                        </a>
                        <a href="{{ route('resources') }}" class="group rounded-2xl border border-slate-700/60 bg-slate-950/40 p-5 transition hover:-translate-y-0.5 hover:border-violet-400/30 hover:bg-slate-800/60">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-400/10 text-violet-300">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 5.25h16.5v13.5H3.75V5.25Zm4.5 3h7.5m-7.5 3h7.5m-7.5 3h4.5" /></svg>
                            </span>
                            <h3 class="mt-4 font-black text-white">Resources</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">Browse useful AI education materials and publications.</p>
                        </a>
                    </div>
                </div>
            </div>

            <aside class="rounded-3xl border border-slate-700/60 bg-slate-900/65 p-6 backdrop-blur-xl">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 text-xl font-black text-white shadow-lg shadow-teal-500/20">
                    {{ collect(explode(' ', $member->name))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('') }}
                </div>
                <h2 class="mt-5 text-xl font-black text-white">{{ $member->name }}</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $member->email }}</p>
                <div class="mt-6 space-y-4 border-t border-slate-800 pt-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-600">Institution</p>
                        <p class="mt-1 text-sm font-semibold text-slate-300">{{ $member->institution ?: 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-600">Phone</p>
                        <p class="mt-1 text-sm font-semibold text-slate-300">{{ $member->phone ?: 'Not provided' }}</p>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="mt-7 inline-flex w-full items-center justify-center rounded-xl bg-teal-500 px-4 py-3 text-sm font-black text-white transition hover:bg-teal-400">Contact the Zehanat team</a>
            </aside>
        </div>
    </div>
</section>
@endsection
