<?php

namespace App\Livewire\Settings;

use App\Concerns\PasswordValidationRules;
use App\Enums\EmailTemplateKey;
use App\Livewire\Actions\Logout;
use App\Services\ManagedEmailSender;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteUserForm extends Component
{
    use PasswordValidationRules;

    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        $user = Auth::user();
        app(ManagedEmailSender::class)->send($user->email, EmailTemplateKey::AccountDeleted, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'action_url' => route('contact'),
        ]);

        tap($user, $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}
