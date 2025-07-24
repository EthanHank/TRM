<x-mail::message>
<table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0; min-height: 100vh;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #667eea33; margin: 40px 0;">
                <tr>
                    <td style="padding: 48px 40px 32px 40px; text-align: center;">
                        <div style="margin-bottom: 24px;">
                            <h1 style="color: #667eea; font-size: 2rem; font-weight: bold; margin-bottom: 20px;">Tun Rice Milling</h1>
                            <h2 style="color: #667eea; font-size: 1.5rem; font-weight: bold; margin-bottom: 20px;">Welcome, {{ $merchant->full_name }}!</h2>
                        </div>
                        <p style="font-size: 1.15rem; color: #333; margin-bottom: 18px;">
                            <span style="display: inline-block; background: #198754; color: #fff; border-radius: 8px; padding: 4px 16px; font-weight: 600; font-size: 1rem; margin-bottom: 10px;">Merchant Confirmed</span><br>
                            Your merchant account has been <strong>confirmed</strong> and is now <span style="color: #198754;"><strong>active</strong></span>!
                        </p>
                        <a href="{{ config('app.url') . '/login' }}" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 14px 40px; border-radius: 8px; text-decoration: none; font-size: 1.1rem; font-weight: 600; margin: 24px 0 18px 0; box-shadow: 0 2px 8px #667eea22; transition: background 0.3s;">Login to Your Account</a>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 24px 20px; margin: 24px 0 18px 0; display: inline-block; text-align: left; box-shadow: 0 1px 4px #667eea11;">
                            <p style="font-size: 1rem; color: #667eea; margin: 0 0 8px 0; font-weight: 600;">Your Credentials</p>
                            <p style="font-size: 1rem; color: #333; margin: 0;">
                                <strong>Email:</strong> {{ $merchant->email }}<br>
                                <strong>Password:</strong> {{ $password }}
                            </p>
                        </div>
                        <hr style="margin: 32px 0; border: none; border-top: 1px solid #e2e8f0;">
                        <p style="color: #888; font-size: 0.98rem;">If you have any questions, feel free to reply to this email.<br>Thanks,<br><span style="color: #667eea; font-weight: 600;">{{ config('app.name') }}</span></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</x-mail::message>
