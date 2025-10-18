@component('mail::message')
# Reset Password

Kami menerima permintaan reset password untuk akun Anda.

@component('mail::button', ['url' => $actionUrl])
Reset Password
@endcomponent

Kode ini hanya berlaku selama 60 menit.

Terima kasih,<br>
{{ config('greenevent') }}
@endcomponent
