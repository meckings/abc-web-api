@component('mail::message')
# Test

{{$message}}

{{--@component('mail::button', ['url' => 'google.com'])--}}
{{--Click here--}}
{{--@endcomponent--}}

{{--@component('mail::panel')--}}
    {{--This is a panel--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
