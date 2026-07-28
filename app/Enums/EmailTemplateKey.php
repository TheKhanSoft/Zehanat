<?php

namespace App\Enums;

enum EmailTemplateKey: string
{
    case MembershipRegistration = 'membership.registration';
    case MembershipApproved = 'membership.approved';
    case MembershipRejected = 'membership.rejected';
    case MembershipBanned = 'membership.banned';
    case MembershipUnbanned = 'membership.unbanned';
    case UserAccountCreated = 'user.account_created';
    case UserStatusChanged = 'user.status_changed';
    case EmailVerified = 'auth.email_verified';
    case EmailVerification = 'auth.email_verification';
    case PasswordResetAdmin = 'auth.password_reset.admin';
    case PasswordResetForgot = 'auth.password_reset.forgot';
    case AccountDeleted = 'auth.account_deleted';
    case TwoFactorEnabled = 'auth.two_factor.enabled';
    case TwoFactorDisabled = 'auth.two_factor.disabled';
    case TwoFactorReset = 'auth.two_factor.reset';
    case TwoFactorOtp = 'auth.two_factor.otp';
    case AccountDeletionOtp = 'auth.account_deletion_otp';
}
