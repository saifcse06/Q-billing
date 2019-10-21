@component('mail::message')
#Congratulations {{ $status->name }}!!<br>
We are very happy to inform you that,You Convert Customer to Client.
<br>
Email : {{ $status->email }}<br>
Phone : {{ $status->phone }}<br>
<b>N:B:</b><i>Please update your password as soon as possible.</i><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent