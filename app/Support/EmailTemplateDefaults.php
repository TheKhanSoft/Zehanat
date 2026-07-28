<?php

namespace App\Support;

use App\Enums\EmailTemplateKey;

final class EmailTemplateDefaults
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            EmailTemplateKey::MembershipRegistration->value => self::definition(
                'New membership registration',
                'Membership',
                'Sent immediately after a membership application is received.',
                'We received your Zehanat membership application',
                'Your application is now pending review.',
                '<h1>Application received</h1><p>Hello {{ recipient_name }},</p><p>Thank you for applying to join {{ app_name }}. We have received your <strong>{{ category }}</strong> membership application and it is now pending review.</p><div class="panel"><strong>Application details</strong><p>Email: {{ member_email }}<br>Phone: {{ phone }}<br>Institution/organization: {{ institution }}<br>Status: Pending</p></div><p>We will email you when the review is complete.</p><p><a class="button" href="{{ action_url }}">Explore Zehanat</a></p>',
                ['recipient_name', 'member_email', 'phone', 'category', 'institution', 'action_url'],
            ),
            EmailTemplateKey::MembershipApproved->value => self::definition(
                'Membership accepted',
                'Membership',
                'Sent when an administrator approves a pending member.',
                'Your Zehanat membership has been accepted',
                'Welcome—your membership application was approved.',
                '<h1>Membership accepted</h1><p>Hello {{ recipient_name }},</p><p>Great news—your <strong>{{ category }}</strong> membership application has been approved.</p><p>You now have an active membership with {{ app_name }}.</p><p><a class="button" href="{{ action_url }}">Visit Zehanat</a></p>',
                ['recipient_name', 'category', 'action_url'],
            ),
            EmailTemplateKey::MembershipRejected->value => self::definition(
                'Membership rejected',
                'Membership',
                'Sent when an administrator rejects a membership application.',
                'Update on your Zehanat membership application',
                'Your membership application has been reviewed.',
                '<h1>Membership application update</h1><p>Hello {{ recipient_name }},</p><p>Thank you for your interest in {{ app_name }}. After review, we are unable to approve your membership application at this time.</p><p>If you believe information was missing or incorrect, please contact us for guidance.</p><p><a class="button secondary" href="{{ action_url }}">Contact us</a></p>',
                ['recipient_name', 'action_url'],
            ),
            EmailTemplateKey::MembershipBanned->value => self::definition(
                'Membership banned',
                'Membership',
                'Sent when access for an approved member is banned.',
                'Your Zehanat membership access has been suspended',
                'Your membership access status has changed.',
                '<h1>Membership access suspended</h1><p>Hello {{ recipient_name }},</p><p>Your {{ app_name }} membership access has been suspended.</p><div class="panel"><strong>Reason</strong><p>{{ ban_reason }}</p></div><p>If you need clarification, contact our team.</p><p><a class="button secondary" href="{{ action_url }}">Contact us</a></p>',
                ['recipient_name', 'ban_reason', 'action_url'],
            ),
            EmailTemplateKey::MembershipUnbanned->value => self::definition(
                'Membership restored',
                'Membership',
                'Sent when a membership ban is removed.',
                'Your Zehanat membership access has been restored',
                'Your membership is active again.',
                '<h1>Membership restored</h1><p>Hello {{ recipient_name }},</p><p>Your {{ app_name }} membership access has been restored and is active again.</p><p><a class="button" href="{{ action_url }}">Visit Zehanat</a></p>',
                ['recipient_name', 'action_url'],
            ),
            EmailTemplateKey::UserAccountCreated->value => self::definition(
                'Admin account created',
                'Accounts',
                'Sent when an administrator creates a user account.',
                'Your {{ app_name }} account has been created',
                'An administrative account is ready for you.',
                '<h1>Your account is ready</h1><p>Hello {{ recipient_name }},</p><p>An account has been created for you at {{ app_name }} with the role <strong>{{ role }}</strong>.</p><p>Use your email address to sign in. For security, set a password using the link below if one was provided by your administrator.</p><p><a class="button" href="{{ action_url }}">Sign in</a></p>',
                ['recipient_name', 'role', 'action_url'],
            ),
            EmailTemplateKey::UserStatusChanged->value => self::definition(
                'Account status changed',
                'Accounts',
                'Reserved for active, suspended, or restored user-account status changes.',
                'Your {{ app_name }} account status changed',
                'There is an update to your account access.',
                '<h1>Account status updated</h1><p>Hello {{ recipient_name }},</p><p>Your account status is now <strong>{{ status }}</strong>.</p><p>{{ status_reason }}</p><p><a class="button" href="{{ action_url }}">View account</a></p>',
                ['recipient_name', 'status', 'status_reason', 'action_url'],
            ),
            EmailTemplateKey::EmailVerified->value => self::definition(
                'Email verified',
                'Verification',
                'Sent after an email address is successfully verified.',
                'Your email address has been verified',
                'Email verification is complete.',
                '<h1>Email verified</h1><p>Hello {{ recipient_name }},</p><p>Your email address <strong>{{ recipient_email }}</strong> has been verified successfully.</p><p><a class="button" href="{{ action_url }}">Continue to dashboard</a></p>',
                ['recipient_name', 'recipient_email', 'action_url'],
            ),
            EmailTemplateKey::EmailVerification->value => self::definition(
                'Email verification link',
                'Verification',
                'Sent when a user requests or receives an email verification link.',
                'Verify your {{ app_name }} email address',
                'Confirm that this email address belongs to you.',
                '<h1>Verify your email</h1><p>Hello {{ recipient_name }},</p><p>Click the button below to verify your email address. This secure link expires in {{ expires_in }} minutes.</p><p><a class="button" href="{{ action_url }}">Verify email address</a></p><p class="muted">If you did not create this account, you can safely ignore this email.</p>',
                ['recipient_name', 'expires_in', 'action_url'],
            ),
            EmailTemplateKey::PasswordResetAdmin->value => self::definition(
                'Admin-sent password reset',
                'Passwords',
                'Sent when an administrator manually sends a reset link.',
                'An administrator sent you a password reset link',
                'Use this secure link to choose a new password.',
                '<h1>Reset your password</h1><p>Hello {{ recipient_name }},</p><p>A {{ app_name }} administrator requested a password reset link for your account.</p><p><a class="button" href="{{ action_url }}">Choose a new password</a></p><p class="muted">This link expires in {{ expires_in }} minutes. If you were not expecting this email, contact an administrator.</p>',
                ['recipient_name', 'expires_in', 'action_url'],
            ),
            EmailTemplateKey::PasswordResetForgot->value => self::definition(
                'Forgot-password reset',
                'Passwords',
                'Sent from the public forgot-password form.',
                'Reset your {{ app_name }} password',
                'A password reset was requested for your account.',
                '<h1>Reset your password</h1><p>Hello {{ recipient_name }},</p><p>We received a password reset request for your account.</p><p><a class="button" href="{{ action_url }}">Reset password</a></p><p class="muted">This link expires in {{ expires_in }} minutes. If you did not request it, no action is required.</p>',
                ['recipient_name', 'expires_in', 'action_url'],
            ),
            EmailTemplateKey::AccountDeleted->value => self::definition(
                'Account deletion confirmation',
                'Accounts',
                'Sent when a user or administrator permanently deletes an account.',
                'Your {{ app_name }} account was deleted',
                'This confirms that the account is no longer active.',
                '<h1>Account deleted</h1><p>Hello {{ recipient_name }},</p><p>This email confirms that the account associated with <strong>{{ recipient_email }}</strong> was permanently deleted on {{ occurred_at }}.</p><p>If you did not expect this action, contact us immediately.</p><p><a class="button secondary" href="{{ action_url }}">Contact support</a></p>',
                ['recipient_name', 'recipient_email', 'occurred_at', 'action_url'],
            ),
            EmailTemplateKey::TwoFactorEnabled->value => self::definition(
                'Two-factor authentication enabled',
                'Security',
                'Sent after authenticator-app two-factor authentication is enabled.',
                'Two-factor authentication was enabled',
                'Your account now has additional sign-in protection.',
                '<h1>Two-factor authentication enabled</h1><p>Hello {{ recipient_name }},</p><p>Authenticator-app two-factor authentication was enabled for your {{ app_name }} account on {{ occurred_at }}.</p><p>If you did not make this change, contact an administrator immediately.</p><p><a class="button" href="{{ action_url }}">Review security settings</a></p>',
                ['recipient_name', 'occurred_at', 'action_url'],
            ),
            EmailTemplateKey::TwoFactorDisabled->value => self::definition(
                'Two-factor authentication disabled',
                'Security',
                'Sent after two-factor authentication is disabled.',
                'Two-factor authentication was disabled',
                'A security setting on your account changed.',
                '<h1>Two-factor authentication disabled</h1><p>Hello {{ recipient_name }},</p><p>Two-factor authentication was disabled for your {{ app_name }} account on {{ occurred_at }}.</p><p>If you did not make this change, reset your password and contact an administrator.</p><p><a class="button" href="{{ action_url }}">Review security settings</a></p>',
                ['recipient_name', 'occurred_at', 'action_url'],
            ),
            EmailTemplateKey::TwoFactorReset->value => self::definition(
                'Two-factor authentication reset by admin',
                'Security',
                'Sent when an administrator resets a user’s two-factor configuration.',
                'Your two-factor authentication was reset',
                'An administrator removed the existing 2FA configuration.',
                '<h1>Two-factor authentication reset</h1><p>Hello {{ recipient_name }},</p><p>An administrator reset two-factor authentication for your {{ app_name }} account on {{ occurred_at }}.</p><p>You can configure it again from security settings.</p><p><a class="button" href="{{ action_url }}">Open security settings</a></p>',
                ['recipient_name', 'occurred_at', 'action_url'],
            ),
            EmailTemplateKey::TwoFactorOtp->value => [
                ...self::definition(
                    'Email two-factor OTP',
                    'Security',
                    'Reserved for a future email-OTP channel. Current 2FA uses an authenticator app and never emails its TOTP code.',
                    'Your {{ app_name }} security code',
                    'Use this one-time code to continue.',
                    '<h1>Your security code</h1><p>Hello {{ recipient_name }},</p><div class="otp">{{ otp }}</div><p>This code expires in {{ expires_in }} minutes and can be used only once.</p><p class="muted">Never share this code. {{ app_name }} staff will never ask for it.</p>',
                    ['recipient_name', 'otp', 'expires_in'],
                ),
                'is_active' => false,
            ],
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function get(string $key): ?array
    {
        return self::all()[$key] ?? null;
    }

    /**
     * @return array<string, string>
     */
    public static function sampleData(string $key): array
    {
        return [
            'app_name' => config('app.name', 'Zehanat'),
            'support_email' => config('mail.from.address', 'support@example.com'),
            'recipient_name' => 'Ayesha Khan',
            'recipient_email' => 'ayesha@example.com',
            'member_email' => 'ayesha@example.com',
            'phone' => '+92 300 1234567',
            'category' => 'Institution',
            'institution' => 'Zehanat Academy',
            'role' => 'Editor',
            'status' => 'Active',
            'status_reason' => 'Your account is available and ready to use.',
            'ban_reason' => 'The membership terms require an account review.',
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'expires_in' => '60',
            'otp' => '482193',
            'action_url' => url('/'),
        ];
    }

    /**
     * @param  array<int, string>  $variables
     * @return array<string, mixed>
     */
    private static function definition(
        string $name,
        string $category,
        string $description,
        string $subject,
        string $preheader,
        string $bodyHtml,
        array $variables,
    ): array {
        return [
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'subject' => $subject,
            'preheader' => $preheader,
            'body_html' => $bodyHtml,
            'body_text' => null,
            'variables' => array_values(array_unique([
                'app_name',
                'support_email',
                ...$variables,
            ])),
            'is_active' => true,
            'is_system' => true,
            'sort_order' => 0,
        ];
    }
}
