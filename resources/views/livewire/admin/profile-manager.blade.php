<div>
    @section('title', 'Profile Settings - Admin Panel')
    @section('page_title', 'Profile Settings')

    <x-admin.page-header 
        title="Account Settings" 
        description="Manage your profile, security preferences, and two-factor authentication." 
        module="Account" 
        icon="cog-6-tooth" 
    />

    <div class="mt-8 flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar Tabs -->
        <div class="lg:w-64 shrink-0">
            <nav class="flex lg:flex-col gap-2 overflow-x-auto pb-4 lg:pb-0">
                <button 
                    wire:click="switchTab('profile')"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium whitespace-nowrap {{ $activeTab === 'profile' ? 'bg-teal-500/10 text-teal-400 border border-teal-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile Details
                </button>
                <button 
                    wire:click="switchTab('security')"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium whitespace-nowrap {{ $activeTab === 'security' ? 'bg-teal-500/10 text-teal-400 border border-teal-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Security & 2FA
                </button>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 space-y-8">
            
            <!-- ============================ -->
            <!-- PROFILE TAB                  -->
            <!-- ============================ -->
            @if($activeTab === 'profile')
                
                <!-- Profile Information Card -->
                <div class="bg-slate-800/50 rounded-3xl border border-slate-700/50 backdrop-blur-sm shadow-xl overflow-hidden">
                    <div class="border-b border-slate-700/50 bg-slate-900/50 px-6 py-5">
                        <h3 class="text-lg font-bold text-white">Profile Information</h3>
                        <p class="mt-1 text-sm text-slate-400">Update your account's profile information and email address.</p>
                    </div>
                    <div class="p-6">
                        <form wire:submit="updateProfileInformation" class="space-y-6">
                            <x-admin.form-group label="Name" name="name" required>
                                <input type="text" wire:model="name" id="name" required class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors" />
                            </x-admin.form-group>
                            
                            <x-admin.form-group label="Email" name="email" required>
                                <input type="email" wire:model="email" id="email" required class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors" />
                                
                                @if($this->hasUnverifiedEmail)
                                    <div class="mt-3 p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <p class="text-sm text-amber-400">Your email address is unverified.</p>
                                        <button type="button" wire:click="resendVerificationNotification" class="text-sm font-medium text-amber-400 hover:text-amber-300 underline transition-colors whitespace-nowrap">
                                            Resend Verification Email
                                        </button>
                                    </div>
                                @endif
                            </x-admin.form-group>

                            <div class="flex items-center pt-2">
                                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition-all hover:bg-teal-500">
                                    Save Changes
                                    <div wire:loading wire:target="updateProfileInformation" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="bg-rose-950/20 rounded-3xl border border-rose-900/30 backdrop-blur-sm overflow-hidden">
                    <div class="px-6 py-6">
                        <h3 class="text-lg font-bold text-rose-400">Delete Account</h3>
                        <p class="mt-1 text-sm text-slate-400 max-w-2xl">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                        
                        <div class="mt-5">
                            <button type="button" wire:click="confirmDeleteAccount" class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-500/10 border border-rose-500/20 px-5 py-2.5 text-sm font-bold text-rose-400 transition-all hover:bg-rose-500/20">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>

            @endif

            <!-- ============================ -->
            <!-- SECURITY TAB                 -->
            <!-- ============================ -->
            @if($activeTab === 'security')

                <!-- Update Password Card -->
                <div class="bg-slate-800/50 rounded-3xl border border-slate-700/50 backdrop-blur-sm shadow-xl overflow-hidden">
                    <div class="border-b border-slate-700/50 bg-slate-900/50 px-6 py-5">
                        <h3 class="text-lg font-bold text-white">Update Password</h3>
                        <p class="mt-1 text-sm text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="p-6">
                        <form wire:submit="updatePassword" class="space-y-6">
                            <x-admin.form-group label="Current Password" name="current_password" required>
                                <input type="password" wire:model="current_password" id="current_password" required class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors" />
                            </x-admin.form-group>
                            
                            <x-admin.form-group label="New Password" name="password" required>
                                <input type="password" wire:model="password" id="password" required class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors" />
                            </x-admin.form-group>

                            <x-admin.form-group label="Confirm Password" name="password_confirmation" required>
                                <input type="password" wire:model="password_confirmation" id="password_confirmation" required class="block w-full max-w-md rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors" />
                            </x-admin.form-group>

                            <div class="flex items-center pt-2">
                                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition-all hover:bg-teal-500">
                                    Update Password
                                    <div wire:loading wire:target="updatePassword" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Two Factor Auth Card -->
                @if($canManageTwoFactor)
                <div class="bg-slate-800/50 rounded-3xl border border-slate-700/50 backdrop-blur-sm shadow-xl overflow-hidden">
                    <div class="border-b border-slate-700/50 bg-slate-900/50 px-6 py-5">
                        <h3 class="text-lg font-bold text-white">Two-Factor Authentication</h3>
                        <p class="mt-1 text-sm text-slate-400">Add additional security to your account using two-factor authentication.</p>
                    </div>
                    <div class="p-6">
                        @if($twoFactorEnabled)
                            <h4 class="text-md font-bold text-white">You have enabled two-factor authentication.</h4>
                            <p class="mt-2 text-sm text-slate-400 max-w-2xl">
                                When you login, you will be prompted for a secure, random pin from the authenticator app on your phone.
                            </p>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <button type="button" wire:click="toggleRecoveryCodes" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-700/50 px-4 py-2 text-sm font-bold text-white hover:bg-slate-700 transition-colors">
                                    {{ $showRecoveryCodes ? 'Hide Recovery Codes' : 'Show Recovery Codes' }}
                                </button>
                                
                                @if($showRecoveryCodes && count($this->recoveryCodes))
                                    <button type="button" wire:click="regenerateRecoveryCodes" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-700/50 px-4 py-2 text-sm font-bold text-white hover:bg-slate-700 transition-colors">
                                        Regenerate Codes
                                    </button>
                                @endif

                                <button type="button" wire:click="disableTwoFactor" class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-500/10 border border-rose-500/20 px-4 py-2 text-sm font-bold text-rose-400 hover:bg-rose-500/20 transition-colors">
                                    Disable 2FA
                                    <div wire:loading wire:target="disableTwoFactor" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-rose-400 border-t-transparent"></div>
                                </button>
                            </div>

                            @if($showRecoveryCodes && count($this->recoveryCodes))
                                <div class="mt-6 max-w-xl rounded-xl bg-slate-900/80 p-5 font-mono text-sm text-slate-300 border border-slate-700/50 shadow-inner">
                                    <p class="text-xs text-slate-500 mb-4 font-sans">Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two-factor authentication device is lost.</p>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($this->recoveryCodes as $code)
                                            <div>{{ $code }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        @else
                            <h4 class="text-md font-bold text-white">You have not enabled two-factor authentication.</h4>
                            <p class="mt-2 text-sm text-slate-400 max-w-2xl">
                                When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                            </p>
                            <div class="mt-6">
                                <button type="button" wire:click="enableTwoFactor" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/20 transition-all hover:bg-teal-500">
                                    Enable 2FA
                                    <div wire:loading wire:target="enableTwoFactor" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
                
            @endif

        </div>
    </div>

    <!-- Modals -->

    <!-- Enable 2FA Modal -->
    <x-admin.modal model="showTwoFactorModal" maxWidth="md" :showFooter="false" :plain="true">
        <div class="p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-bold text-white">Finish Enabling 2FA</h2>
                <button type="button" wire:click="$set('showTwoFactorModal', false)" class="text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <p class="text-sm text-slate-300 mb-6">
                To finish enabling two-factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.
            </p>

            <div class="flex justify-center mb-6">
                <div class="p-3 bg-white rounded-xl inline-block shadow-lg">
                    {!! $qrCodeSvg !!}
                </div>
            </div>

            <div class="mb-6">
                <p class="text-sm text-slate-400 font-medium mb-1">Setup Key:</p>
                <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 text-slate-300 font-mono text-sm break-all select-all">
                    {{ $manualSetupKey }}
                </div>
            </div>

            <form wire:submit="confirmTwoFactor">
                <x-admin.form-group label="OTP Code" name="code" required>
                    <input type="text" inputmode="numeric" wire:model="code" required autofocus autocomplete="one-time-code" class="block w-full text-center tracking-widest text-lg rounded-xl border border-slate-700/50 bg-slate-950/50 py-3 px-4 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500" placeholder="123456" />
                </x-admin.form-group>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-teal-500">
                        Confirm & Enable
                        <div wire:loading wire:target="confirmTwoFactor" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                    </button>
                </div>
            </form>
        </div>
    </x-admin.modal>

    <!-- Delete Account Modal -->
    <x-admin.modal model="showDeleteModal" maxWidth="md" :showFooter="false" :plain="true">
        <div class="p-6">
            <div class="flex items-center gap-4 text-rose-500 mb-4">
                <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-full bg-rose-500/10">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white">Delete Account</h3>
            </div>
            
            <p class="text-sm text-slate-300 mb-6">
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <form wire:submit="deleteAccount">
                <x-admin.form-group label="Password" name="delete_password" required>
                    <input type="password" wire:model="delete_password" required class="block w-full rounded-xl border border-slate-700/50 bg-slate-950/50 py-2.5 px-4 text-sm text-white focus:border-rose-500 focus:ring-1 focus:ring-rose-500" placeholder="Enter your password" />
                </x-admin.form-group>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="$set('showDeleteModal', false)" class="inline-flex items-center justify-center rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-rose-500 transition-colors">
                        Permanently Delete
                        <div wire:loading wire:target="deleteAccount" class="ml-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                    </button>
                </div>
            </form>
        </div>
    </x-admin.modal>
</div>
