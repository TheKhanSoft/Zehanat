<?php

namespace App\Livewire\Admin;

use App\Enums\EmailTemplateKey;
use App\Services\ManagedEmailSender;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Features;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProfileManager extends Component
{
    public string $activeTab = 'profile'; // 'profile' or 'security'

    // Profile State
    public string $name = '';
    public string $email = '';

    // Password State
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Delete User State
    public bool $showDeleteModal = false;
    public string $delete_password = '';

    // 2FA State
    #[Locked]
    public bool $canManageTwoFactor = false;
    #[Locked]
    public bool $twoFactorEnabled = false;
    #[Locked]
    public bool $requiresConfirmation = false;
    
    public bool $showTwoFactorModal = false;
    public bool $showVerificationStep = false;
    public string $qrCodeSvg = '';
    public string $manualSetupKey = '';
    public string $code = ''; // 6 digit 2fa code

    public bool $showRecoveryCodes = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        $this->canManageTwoFactor = Features::canManageTwoFactorAuthentication();
        
        if ($this->canManageTwoFactor) {
            $this->twoFactorEnabled = $user->hasEnabledTwoFactorAuthentication();
            $this->requiresConfirmation = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm');
            
            // Auto-disable if started but not confirmed
            if ($this->requiresConfirmation && $this->twoFactorEnabled && is_null($user->two_factor_confirmed_at)) {
                app(DisableTwoFactorAuthentication::class)($user);
                $this->twoFactorEnabled = false;
            }
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    // ==========================================
    // PROFILE INFORMATION
    // ==========================================

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('notify', message: 'Profile information updated successfully.', type: 'success');
    }

    public function resendVerificationNotification()
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();

        $this->dispatch('notify', message: 'A new verification link has been sent to your email address.', type: 'success');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        $user = Auth::user();
        return $user instanceof MustVerifyEmail && !$user->hasVerifiedEmail();
    }

    // ==========================================
    // PASSWORD
    // ==========================================

    public function updatePassword()
    {
        $validated = $this->validate([
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);
        
        $this->dispatch('notify', message: 'Password updated successfully.', type: 'success');
    }

    // ==========================================
    // TWO FACTOR AUTHENTICATION
    // ==========================================

    public function enableTwoFactor(EnableTwoFactorAuthentication $enableTwoFactorAuthentication)
    {
        $enableTwoFactorAuthentication(Auth::user());

        if (!$this->requiresConfirmation) {
            $this->twoFactorEnabled = Auth::user()->hasEnabledTwoFactorAuthentication();
            $this->sendTwoFactorEmail(EmailTemplateKey::TwoFactorEnabled);
        }

        $this->loadTwoFactorSetupData();
        $this->showVerificationStep = $this->requiresConfirmation;
        $this->showTwoFactorModal = true;
    }

    private function loadTwoFactorSetupData()
    {
        $user = Auth::user();

        try {
            $this->qrCodeSvg = $user?->twoFactorQrCodeSvg();
            $this->manualSetupKey = decrypt($user->two_factor_secret);
        } catch (Exception $e) {
            $this->reset('qrCodeSvg', 'manualSetupKey');
        }
    }

    public function confirmTwoFactor(ConfirmTwoFactorAuthentication $confirmTwoFactorAuthentication)
    {
        $this->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        try {
            $confirmTwoFactorAuthentication(Auth::user(), $this->code);
            $this->showTwoFactorModal = false;
            $this->twoFactorEnabled = true;
            $this->sendTwoFactorEmail(EmailTemplateKey::TwoFactorEnabled);
            $this->dispatch('notify', message: 'Two-factor authentication confirmed and enabled.', type: 'success');
        } catch (ValidationException $e) {
            $this->addError('code', 'The provided two-factor authentication code was invalid.');
        }
    }

    public function disableTwoFactor(DisableTwoFactorAuthentication $disableTwoFactorAuthentication)
    {
        $disableTwoFactorAuthentication(Auth::user());
        $this->twoFactorEnabled = false;
        $this->sendTwoFactorEmail(EmailTemplateKey::TwoFactorDisabled);
        $this->dispatch('notify', message: 'Two-factor authentication disabled.', type: 'success');
    }

    public function toggleRecoveryCodes()
    {
        $this->showRecoveryCodes = !$this->showRecoveryCodes;
    }

    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generateNewRecoveryCodes)
    {
        $generateNewRecoveryCodes(Auth::user());
        $this->dispatch('notify', message: 'Recovery codes regenerated.', type: 'success');
    }

    #[Computed]
    public function recoveryCodes()
    {
        return Auth::user()->recoveryCodes();
    }

    // ==========================================
    // DELETE ACCOUNT
    // ==========================================

    public function confirmDeleteAccount()
    {
        $this->resetErrorBag('delete_password');
        $this->delete_password = '';
        $this->showDeleteModal = true;
        $this->dispatch('open-modal', 'confirm-delete-account'); // Dispatch to alpine if needed
    }

    public function deleteAccount()
    {
        $this->validate([
            'delete_password' => ['required', 'string', 'current_password:web'],
        ]);

        $user = Auth::user();

        app(ManagedEmailSender::class)->send($user->email, EmailTemplateKey::AccountDeleted, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'action_url' => route('contact'),
        ]);
        Auth::logout();
        $user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.admin.profile-manager')->layout('layouts.admin');
    }

    private function sendTwoFactorEmail(EmailTemplateKey $key): void
    {
        $user = Auth::user();

        app(ManagedEmailSender::class)->send($user->email, $key, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'action_url' => route('admin.profile'),
        ]);
    }
}
