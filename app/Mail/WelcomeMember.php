<?php

namespace App\Mail;

use App\Enums\EmailTemplateKey;
use App\Models\Member;

class WelcomeMember extends ManagedTemplateMail
{
    public Member $member;

    public function __construct(Member $member)
    {
        $this->member = $member;

        parent::__construct(EmailTemplateKey::MembershipRegistration, [
            'recipient_name' => $member->name,
            'recipient_email' => $member->email,
            'member_email' => $member->email,
            'phone' => $member->phone ?: 'Not provided',
            'category' => ucfirst($member->category),
            'institution' => $member->institution ?: 'Not provided',
            'action_url' => route('home'),
        ]);
    }
}
