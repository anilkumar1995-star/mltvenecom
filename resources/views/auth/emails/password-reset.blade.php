<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Notification</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f4f7f6; padding-bottom: 40px; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; color: #4a4a4a; border-radius: 8px; overflow: hidden; margin-top: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .header { background-color: #3498db; padding: 30px; text-align: center; color: #ffffff; }
        .content { padding: 40px 30px; line-height: 1.6; }
        .btn-container { text-align: center; padding: 20px 0; }
        .btn { background-color: #3498db; color: #ffffff !important; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #999999; }
        .divider { height: 1px; background-color: #eeeeee; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1 style="margin: 0; font-size: 24px;">iPaymnt Tech</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2 style="margin-top: 0; font-size: 20px;">Hello {{ $user->name }},</h2>
                    <p>You are receiving this email because we received a password reset request for your account.</p>
                    <div class="btn-container">
                        <a href="{{ $resetUrl }}" class="btn">Reset Password</a>
                    </div>
                    <p>This password reset link will expire in 60 minutes.</p>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <div class="divider"></div>
                    <p style="font-size: 13px; color: #888;">If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                    <p style="font-size: 12px; word-break: break-all;"><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} iPaymnt Tech. All rights reserved.<br>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
