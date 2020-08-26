@component('mail::message')
{!! trim(preg_replace('/\h+/', ' ', trans('email.verification.message', [
'username' => $user->username,
'url' => $verificationUrl,
'site_name' => setting('app.name', 'ChargePanda')
]))) !!}
@endcomponent