@component('mail::message')
# Hello {{$content['name']}},
 
{{$content['body']}}
 
@component('mail::button', ['url' => $content['url']])
Click Here
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent