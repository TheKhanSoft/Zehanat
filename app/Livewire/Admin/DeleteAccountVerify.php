<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DeleteAccountVerify extends Component
{
    public User $user;
    public string $otp = '';

    public function mount(User $user)
    {
        $this->user = $user;

        // Ensure the logged in user is the one trying to delete their account
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function verify()
    {
        $this->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $cacheKey = 'delete_account_otp_' . $this->user->id;
        $hashedOtp = Cache::get($cacheKey);

        if (! $hashedOtp || ! Hash::check($this->otp, $hashedOtp)) {
            $this->addError('otp', 'The verification code is invalid or has expired.');
            return;
        }

        // OTP is valid, proceed with deletion
        Auth::logout();
        $this->user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Cache::forget($cacheKey);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.admin.delete-account-verify')->layout('layouts.admin');
    }
}
