@component('mail::message')
<h2>Hi {{$user->username}}</h2>
<p>Thanks so much for creating an account with {{setting('app.name', 'ChargePanda')}}! We appreciate you becoming a part of our community.</p>
<p>Click the link below and start placing the orders today.</p>
@component('vendor.mail.html.button', ['url' => url('/')])
Visit site
@endcomponent
Regards,<br>
{{setting('app.name', 'ChargePanda')}}.
@endcomponent