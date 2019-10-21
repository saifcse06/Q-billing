@component('mail::message')
 <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
<div class="container">
 <div class="row">

  <div class="col-sm-12">
   Dear {{$single_invoice->relUser->name}} ,<br>
   This is the  billing notice that your invoice no. {{$single_invoice->invoice_no}} which was generated on {{\Carbon\Carbon::parse($single_invoice->created_at)->format('jS \o\f F, Y ')}}  <br>
   Invoice: {{$single_invoice->invoice_no}}<br>
   Amount Due: Tk.{{ number_format($single_invoice->total_amount,2)}} BDT<br>
   Due Date: {{ $single_invoice->last_payment_date}}<br>
   @include('backend.invoice._invoice_design')
   <a class="btn btn-primary pull-right" style="color: white;" href="{{url('invoice/details',$single_invoice->id)}}"><i class="fa fa-money"></i> Pay Now</a>
   <br>
   Thanks,<br>
  </div>
 </div>
</div>
 {{ config('app.name') }}
@endcomponent
