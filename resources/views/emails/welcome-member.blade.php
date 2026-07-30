<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Zehanat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
        }
        table {
            border-spacing: 0;
            width: 100%;
        }
        td {
            padding: 0;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #0f172a;
            padding-bottom: 40px;
        }
        .main {
            background-color: #1e293b;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #f8fafc;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            margin-top: 40px;
        }
        .header {
            background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo-text {
            color: #ffffff;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0;
        }
        .logo-urdu {
            color: #ccfbf1;
            font-size: 32px;
            font-weight: 700;
            margin-left: 10px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 20px 0 0 0;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #f8fafc;
        }
        .text {
            font-size: 16px;
            line-height: 1.6;
            color: #cbd5e1;
            margin-bottom: 25px;
        }
        .summary-card {
            background-color: #0f172a;
            border-left: 4px solid #14b8a6;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .summary-card h3 {
            margin-top: 0;
            color: #14b8a6;
            font-size: 16px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-item {
            margin-bottom: 10px;
            font-size: 15px;
        }
        .summary-label {
            color: #94a3b8;
            display: inline-block;
            width: 100px;
        }
        .summary-value {
            color: #f8fafc;
            font-weight: 600;
        }
        .steps {
            margin-bottom: 30px;
        }
        .steps h3 {
            color: #f8fafc;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .step {
            margin-bottom: 15px;
            display: flex;
        }
        .step-number {
            background-color: #14b8a6;
            color: #ffffff;
            width: 24px;
            height: 24px;
            border-radius: 12px;
            text-align: center;
            line-height: 24px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .step-text {
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.5;
        }
        .cta-container {
            text-align: center;
            margin: 40px 0;
        }
        .btn {
            background-color: #f59e0b;
            color: #0f172a;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer {
            background-color: #0f172a;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #334155;
        }
        .footer-text {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .footer-credits {
            color: #475569;
            font-size: 12px;
            margin-top: 20px;
        }
        .accent {
            color: #14b8a6;
        }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <!-- Header -->
            <tr>
                <td class="header" style="text-align: center;">
                    <img src="{{ asset('images/brand/zehanat_logo_horizontal_dark_1800x600.png') }}" alt="Zehanat" style="max-height: 50px; width: auto; max-width: 100%; display: inline-block;">
                    <h1>Welcome to the Family!</h1>
                </td>
            </tr>
            <!-- Body -->
            <tr>
                <td class="content">
                    <p class="greeting">Dear {{ $member->name }},</p>
                    <p class="text">We are thrilled to welcome you to Zehanat — the KP Society for AI in Education. Your application has been successfully received, and we are excited to have you join our growing community of educators, researchers, and innovators dedicated to shaping the future of education with Artificial Intelligence.</p>
                    
                    <div class="summary-card">
                        <h3>Registration Details</h3>
                        <div class="summary-item">
                            <span class="summary-label">Name:</span>
                            <span class="summary-value">{{ $member->name }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Category:</span>
                            <span class="summary-value" style="text-transform: capitalize;">{{ $member->category }}</span>
                        </div>
                        @if($member->institution)
                        <div class="summary-item">
                            <span class="summary-label">Institution:</span>
                            <span class="summary-value">{{ $member->institution }}</span>
                        </div>
                        @endif
                        <div class="summary-item">
                            <span class="summary-label">Status:</span>
                            <span class="summary-value" style="color: #f59e0b;">Pending Approval</span>
                        </div>
                    </div>

                    <div class="steps">
                        <h3>What's Next?</h3>
                        <table width="100%">
                            <tr>
                                <td width="40" valign="top">
                                    <div class="step-number">1</div>
                                </td>
                                <td>
                                    <p class="step-text" style="margin: 0 0 15px 0;">Our team will review your application shortly.</p>
                                </td>
                            </tr>
                            <tr>
                                <td width="40" valign="top">
                                    <div class="step-number">2</div>
                                </td>
                                <td>
                                    <p class="step-text" style="margin: 0 0 15px 0;">Once approved, you will receive another email with access to exclusive resources and community forums.</p>
                                </td>
                            </tr>
                            <tr>
                                <td width="40" valign="top">
                                    <div class="step-number">3</div>
                                </td>
                                <td>
                                    <p class="step-text" style="margin: 0 0 15px 0;">Stay tuned for invitations to our upcoming workshops and webinars.</p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="cta-container">
                        <a href="{{ url('/') }}" class="btn">Explore Our Programs</a>
                    </div>

                    <p class="text">If you have any questions or require immediate assistance, feel free to reply to this email or contact us through our website.</p>
                    
                    <p class="text" style="margin-bottom: 0;">Warm regards,<br><strong class="accent">The Zehanat Team</strong></p>
                </td>
            </tr>
            <!-- Footer -->
            <tr>
                <td class="footer">
                    <p class="footer-text">Abdul Wali Khan University Mardan<br>Garden Campus, Mardan<br>Khyber Pakhtunkhwa, Pakistan</p>
                    <p class="footer-credits">Developed by Kashif Ahmad Khan & Dr. Muhammad Ilyas Khalil</p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
