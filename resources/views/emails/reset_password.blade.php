<x-mail::message>
# Reset Password Notification

Hello {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}!

You are receiving this email because we received a password reset request for your account.
<x-mail::button :url="route('password.reset',$token)">
Reset Password
</x-mail::button>

This password reset link will expire in 30 minutes.

If you did not request a password reset, no further action is required.
Regards,<br>
{{ config('app.name') }}
</x-mail::message>
