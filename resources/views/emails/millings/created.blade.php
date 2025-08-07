<x-mail::message>
<table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0; min-height: 100vh;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #667eea33; margin: 40px 0;">
                <tr>
                    <td style="padding: 48px 40px 32px 40px; text-align: center;">
                        <div style="margin-bottom: 24px;">
                            <h1 style="color: #667eea; font-size: 2rem; font-weight: bold; margin-bottom: 20px;">Tun Rice Milling</h1>
                            <h2 style="color: #667eea; font-size: 1.5rem; font-weight: bold; margin-bottom: 20px;">Hello, {{ $milling->user->name }}!</h2>
                        </div>
                        <p style="font-size: 1.15rem; color: #333; margin-bottom: 18px;">
                            <span style="display: inline-block; background: #28a745; color: #fff; border-radius: 8px; padding: 4px 16px; font-weight: 600; font-size: 1rem; margin-bottom: 10px;">Milling Process Initiated</span><br>
                            This email confirms that the milling process for your paddy has been successfully initiated.
                        </p>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 24px 20px; margin: 24px 0 18px 0; display: inline-block; text-align: left; box-shadow: 0 1px 4px #667eea11; min-width: 320px;">
                            <p style="font-size: 1rem; color: #667eea; margin: 0 0 8px 0; font-weight: 600;">Milling Details</p>
                            <p style="font-size: 1rem; color: #333; margin: 0;">
                                <strong>Milling ID:</strong> {{ $milling->id }}<br>
                                <strong>Paddy:</strong> {{ $milling->paddy->name }}<br>
                                <strong>Date Initiated:</strong> {{ $milling->milling_start_date->format('F d, Y') }}
                            </p>
                        </div>
                        <div style="margin: 24px 0;">
                            <a href="{{ url('users/millings') }}" style="display: inline-block; background: #667eea; color: #fff; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 1.1rem; box-shadow: 0 2px 8px #667eea22;">View My Millings</a>
                        </div>
                        <hr style="margin: 32px 0; border: none; border-top: 1px solid #e2e8f0;">
                        <p style="color: #888; font-size: 0.98rem;">You will receive another notification once the milling process is complete.<br>Thanks,<br><span style="color: #667eea; font-weight: 600;">{{ config('app.name') }}</span></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</x-mail::message>
