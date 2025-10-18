@component('mail::message')
# Halo, {{ $user->name }}

Klik tombol di bawah untuk login ke akunmu tanpa perlu password.

@component('mail::button', ['url' => $magicLink])
Login Sekarang
@endcomponent

Link ini berlaku selama 15 menit.

Terima kasih,<br>
{{ config('greenevent') }}
@endcomponent
