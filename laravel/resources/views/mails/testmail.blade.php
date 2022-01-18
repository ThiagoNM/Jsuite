@component('mail::message')
# Dear, {{$content['name']}}

You are receiving this email because we received a signup request for your this mail account.

@component('mail::button', ['url' => 'website.com')])
Click Here
@endcomponent

If you did not request a signup , no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent