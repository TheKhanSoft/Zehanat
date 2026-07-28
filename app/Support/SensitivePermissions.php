<?php

namespace App\Support;

final class SensitivePermissions
{
    public const MEMBER_IMPERSONATE = 'impersonate members';

    public const USER_IMPERSONATE = 'impersonate users';

    public const NAMES = [
        self::MEMBER_IMPERSONATE,
        self::USER_IMPERSONATE,
        'view roles',
        'create roles',
        'edit roles',
        'delete roles',
        'view permissions',
        'create permissions',
        'edit permissions',
        'delete permissions',
    ];

    public static function isSensitive(string $permission): bool
    {
        return in_array($permission, self::NAMES, true);
    }
}
