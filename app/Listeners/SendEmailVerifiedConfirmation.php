<?php

namespace App\Listeners;

use App\Enums\EmailTemplateKey;
use App\Models\User;
use App\Services\ManagedEmailSender;
use Illuminate\Auth\Events\Verified;

class SendEmailVerifiedConfirmation
{
    public function __construct(private ManagedEmailSender $emailSender) {}

    public function handle(Verified $event): void
    {
        $user = $event->user;
        if (! $user instanceof User) {
            return;
        }

        $this->emailSender->send($user->email, EmailTemplateKey::EmailVerified, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'action_url' => route('dashboard'),
        ]);
    }
}
