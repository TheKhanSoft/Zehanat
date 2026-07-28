@if(session()->has('user_impersonation') && auth()->check())
    <div class="relative z-[130] border-b border-violet-300/30 bg-violet-400 px-4 py-2 text-slate-950 shadow-xl shadow-violet-950/20">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 sm:flex-row">
            <div class="flex items-center gap-2 text-center text-xs font-bold sm:text-left">
                <svg class="h-4 w-4 flex-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM18 21a6 6 0 0 0-12 0m12.75-9.75 1.5 1.5-1.5 1.5m1.5-1.5H15" />
                </svg>
                Logged in as {{ session('user_impersonation.target_name') }} through a secure super-admin impersonation session.
            </div>
            <form method="POST" action="{{ route('user.impersonation.stop') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-slate-950 px-3 py-1.5 text-xs font-black text-white transition hover:bg-slate-800">
                    Return to super-admin
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
@endif
