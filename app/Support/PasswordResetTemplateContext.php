<?php

namespace App\Support;

use App\Enums\EmailTemplateKey;

final class PasswordResetTemplateContext
{
    /** @var array<string, EmailTemplateKey> */
    private static array $templates = [];

    public static function use(string $token, EmailTemplateKey $template): void
    {
        self::$templates[hash('sha256', $token)] = $template;
    }

    public static function pull(string $token): EmailTemplateKey
    {
        $hash = hash('sha256', $token);
        $template = self::$templates[$hash] ?? EmailTemplateKey::PasswordResetForgot;
        unset(self::$templates[$hash]);

        return $template;
    }
}
