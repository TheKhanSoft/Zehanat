<?php

namespace App\Support;

final class AdminPermissions
{
    public const MEMBER_APPROVE = 'approve members';

    public const MEMBER_REJECT = 'reject members';

    public const MEMBER_BAN = 'ban members';

    public const MEMBER_UNBAN = 'unban members';

    public const USER_VERIFY = 'verify users';

    public const USER_SEND_PASSWORD_RESET = 'send user password resets';

    public const USER_RESET_TWO_FACTOR = 'reset user two factor';

    public const USER_CHANGE_STATUS = 'change user status';

    public const EMAIL_TEMPLATE_SEND_TEST = 'send email template tests';

    public const GRANULAR_ACTIONS = [
        self::MEMBER_APPROVE,
        self::MEMBER_REJECT,
        self::MEMBER_BAN,
        self::MEMBER_UNBAN,
        self::USER_VERIFY,
        self::USER_SEND_PASSWORD_RESET,
        self::USER_RESET_TWO_FACTOR,
        self::USER_CHANGE_STATUS,
    ];
}
