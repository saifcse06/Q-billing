@component('mail::message')
    Your {{ $business->name }} status has been changed to  {{$business->status}} !!<br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
