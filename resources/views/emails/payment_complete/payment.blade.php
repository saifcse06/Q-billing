@component('mail::message')
    Congratulations {{$payment_info->relUser->name}} !!!<br>
    Your Payment {{$payment_status}}<br>
    Payment Date: {{\Carbon\Carbon::parse($payment_data)->format('jS \o\f F, Y ')}}  <br>
    Invoice: {{$payment_info->invoice_no}}<br>
    Amount Due: Tk.{{ number_format($payment_info->total_amount,2)}} BDT<br>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
