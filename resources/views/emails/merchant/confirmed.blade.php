<x-mail::message>
<table width="100%" cellpadding="0" cellspacing="0" style="background: #f8fafc; padding: 40px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #e2e8f0;">
                <tr>
                    <td style="padding: 40px; text-align: center;">
                        <h1 style="color: #667eea; font-size: 28px;">🎉 Welcome, {{ $merchant->full_name }}!</h1>
                        <p style="font-size: 18px; color: #333;">
                            Your merchant account has been <strong>confirmed</strong> and is now <span style="color: #198754;"><strong>active</strong></span>!
                        </p>
                        <a href="{{ config('app.url') . '/login' }}" style="display: inline-block; background: #667eea; color: #fff; padding: 12px 32px; border-radius: 4px; text-decoration: none; font-size: 18px; margin: 24px 0;">Login</a>
                        <p style="font-size: 16px; color: #333;">
                            <strong>Your email:</strong> {{ $merchant->email }}<br>
                            <strong>Your password:</strong> {{ $password }}
                        </p>
                        <hr style="margin: 32px 0;">
                        <p style="color: #888;">If you have any questions, feel free to reply to this email.</p>
                        <p style="color: #888;">Thanks,<br>{{ config('app.name') }}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</x-mail::message>
