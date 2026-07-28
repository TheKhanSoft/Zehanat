<?php

namespace App\Services;

use App\Enums\EmailTemplateKey;
use App\Mail\ManagedTemplateMail;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ManagedEmailSender
{
    /**
     * @param  array<string, mixed>  $variables
     */
    public function send(string $recipient, EmailTemplateKey|string $key, array $variables = []): bool
    {
        if (! app(EmailTemplateRenderer::class)->isActive($key)) {
            return false;
        }

        try {
            Mail::to($recipient)->send(new ManagedTemplateMail($key, $variables));
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        return true;
    }
}
