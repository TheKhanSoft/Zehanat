<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subject }}</title>
</head>
<body style="margin:0;background:#020617;color:#cbd5e1;font-family:Inter,Arial,sans-serif;">
    <span style="display:none!important;max-height:0;max-width:0;opacity:0;overflow:hidden;">{{ $preheader }}</span>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#020617;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;border:1px solid #1e293b;border-radius:24px;overflow:hidden;background:#0f172a;">
                    <tr>
                        <td style="padding:24px 32px;border-bottom:1px solid #1e293b;background:#111c2f;text-align:center;">
                            <img src="{{ asset('images/brand/zehanat_logo_horizontal_dark_1800x600.png') }}" alt="{{ config('app.name', 'Zehanat') }}" style="max-height: 45px; width: auto; max-width: 100%; display: inline-block;">
                            <div style="margin-top:10px;font-size:11px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:#2dd4bf;">Intelligence · Education · Impact</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-content" style="padding:36px 32px;font-size:15px;line-height:1.75;color:#cbd5e1;">
                            <style>
                                .email-content h1{margin:0 0 20px;color:#f8fafc;font-size:27px;line-height:1.25}
                                .email-content p{margin:0 0 18px}
                                .email-content .panel{margin:24px 0;padding:18px 20px;border:1px solid #334155;border-radius:16px;background:#020617}
                                .email-content .panel p{margin:8px 0 0}
                                .email-content .button{display:inline-block;padding:12px 20px;border-radius:12px;background:#14b8a6;color:#042f2e!important;font-weight:800;text-decoration:none}
                                .email-content .button.secondary{background:#1e293b;color:#e2e8f0!important}
                                .email-content .muted{color:#64748b;font-size:13px}
                                .email-content .otp{margin:24px 0;padding:18px;border:1px solid #2dd4bf;border-radius:16px;background:#042f2e;color:#5eead4;font-size:32px;font-weight:900;letter-spacing:.25em;text-align:center}
                            </style>
                            {!! $body !!}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:22px 32px;border-top:1px solid #1e293b;color:#64748b;font-size:12px;line-height:1.6;">
                            This is an automated message from {{ config('app.name', 'Zehanat') }}.<br>
                            Questions? Contact <a href="mailto:{{ config('mail.from.address') }}" style="color:#2dd4bf;">{{ config('mail.from.address') }}</a>.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
