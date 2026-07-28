<?php

namespace App\Providers;

use App\Enums\EmailTemplateKey;
use App\Listeners\SendEmailVerifiedConfirmation;
use App\Mail\ManagedTemplateMail;
use App\Support\PasswordResetTemplateContext;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureManagedAuthEmails();
        Event::listen(Verified::class, SendEmailVerifiedConfirmation::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    private function configureManagedAuthEmails(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, string $token): ManagedTemplateMail {
            $key = PasswordResetTemplateContext::pull($token);
            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new ManagedTemplateMail($key, [
                'recipient_name' => $notifiable->name,
                'recipient_email' => $notifiable->email,
                'expires_in' => (string) config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                'action_url' => $resetUrl,
            ]))->to($notifiable->email);
        });

        VerifyEmail::toMailUsing(function ($notifiable, string $verificationUrl): ManagedTemplateMail {
            return (new ManagedTemplateMail(EmailTemplateKey::EmailVerification, [
                'recipient_name' => $notifiable->name,
                'recipient_email' => $notifiable->email,
                'expires_in' => (string) config('auth.verification.expire', 60),
                'action_url' => $verificationUrl,
            ]))->to($notifiable->email);
        });
    }
}
