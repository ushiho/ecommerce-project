@component('mail::message')
Reset Password

Hi {{ $data['admin']->name }}, you sent a request for password resetting.

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Click to reset you password
@endcomponent
Or copy the url below:
<a href=" {{aurl('reset/password/'.$data['token'])}} ">{{aurl('reset/password/'.$data['token'])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
