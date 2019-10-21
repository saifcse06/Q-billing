@component('mail::message')
Dear {{ $name }}.
#Congratulations !!<br>
We are very happy to inform you that, {{ $client }} added you as customer for his/er business. Here we send you the account details.
<br>
##Credentials
Email : {{ $email }}<br>
Phone : {{ $phone }}<br>
Password : {{ $password }}<br>
@component('mail::button', ['url' => $login_url])
    Active
@endcomponent

<b>N:B:</b><i>Please update your password as soon as possible.</i><br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
