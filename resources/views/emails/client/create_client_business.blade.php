@component('mail::message')
    {{ $client->name }} Create a New Business !!<br>
    Email : {{ $client->email }}<br>
    Phone : {{ $client->phone }}<br>
    Business: {{$business->name}}<br>
    Tax:{{$business->tax}}<br>
    My TDR:{{$business->my_tdr}}<br>
    Services TDR:{{$business->services_tdr}}<br>
    Total TDR:{{$business->total_tdr}}<i>@if($business->tdr_type=='Percentage')(%)@endif</i><br>
    <b>N:B:</b><i>Please Active Business go to admin panel.</i><br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
