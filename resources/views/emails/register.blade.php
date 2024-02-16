<x-mail::message>
# Verify your email address

Hi {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}

Verify your email address to complete the sigup and login into your account.
<x-mail::button :url="route('verify')">
Verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

