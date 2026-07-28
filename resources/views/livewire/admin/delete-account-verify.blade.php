<div>
    @section('title', 'Verify Account Deletion')
    @section('page_title', 'Verify Deletion')

    <div class="max-w-2xl mx-auto mt-12">
        <div class="bg-slate-800/50 rounded-3xl border border-slate-700/50 backdrop-blur-sm shadow-xl overflow-hidden">
            <div class="border-b border-slate-700/50 bg-slate-900/50 px-6 py-5">
                <div class="flex items-center gap-4 text-rose-500 mb-2">
                    <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-full bg-rose-500/10">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Confirm Account Deletion</h3>
                </div>
                <p class="mt-1 text-sm text-slate-400">
                    We've sent a verification code to your email address. Please enter it below to permanently delete your account.
                </p>
            </div>
            
            <div class="p-6">
                <form wire:submit="verify" class="space-y-6">
                    <x-admin.form-group label="Verification Code" name="otp" required>
                        <input type="text" wire:model="otp" required inputmode="numeric" autofocus class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-3 px-4 text-xl tracking-[0.5em] text-center text-white focus:border-rose-500 focus:ring-1 focus:ring-rose-500" placeholder="------" maxlength="6" />
                    </x-admin.form-group>

                    <div class="flex items-center pt-4">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/20 transition-all hover:bg-rose-500">
                            Permanently Delete Account
                            <div wire:loading wire:target="verify" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                        </button>
                        <a href="{{ route('admin.profile') }}" class="ml-4 text-sm text-slate-400 hover:text-white transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
