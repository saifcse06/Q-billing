<section>
    <div class="panel panel-primary">
        <!--<div class="panel-heading navyblue"> INVOICE</div>-->
        <div class="panel-body">


            <div class="row invoice-list">
                <div class="text-center corporate-id">
                    <img src="{{url('/')}}/img/logo.png" alt="">
                </div>
                <div class="col-lg-4 col-sm-4">
                    <h4>BILLING ADDRESS</h4>
                    <p>
                        {{Auth::user()->name}}<br>
                    <address style="margin-bottom:5px;">{{Auth::user()->address}}</address>
                    Tel: {{Auth::user()->phone}}
                    </p>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <h4>SHIPPING ADDRESS</h4>
                    <p>
                        {{$single_invoice->relUser->name}}<br>
                    <address style="margin-bottom:5px;">{{$single_invoice->relUser->address}}</address>
                    Cell: {{$single_invoice->relUser->phone}}<br>
                    </p>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <h4>INVOICE INFO</h4>
                    <ul class="unstyled">
                        <li>Invoice Number		: <strong>{{$single_invoice->invoice_no}}</strong></li>
                        <li>Invoice Date		: {{\Carbon\Carbon::parse($single_invoice->created_at)->format('jS \o\f F, Y ')}}</li>
                        <li>Due Date			: {{\Carbon\Carbon::parse($single_invoice->last_payment_date)->format('jS \o\f F, Y g:i a')}}</li>
                        <li>Invoice Status		: {{$single_invoice->payment_status}}</li>
                    </ul>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th class="hidden-phone">Description</th>
                    <th class="valalign">Unit Cost</th>
                    <th class="valalign">Quantity</th>
                    <th class="valalign">Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach($single_invoice->relInvoiceDetails as $k=>$i)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->item_name}}</td>
                        <td class="hidden-phone"> {{\App\ItemsModel::where('id',$i->item_id)->first()->details}}</td>
                        <td class="valalign">৳ {{number_format($i->unit_price,2)}}</td>
                        <td class="valalign">{{$i->quantity}}</td>
                        <td class="valalign">৳ {{ number_format($i->total_amount,2) }} </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div class="row">


                <div class="col-lg-4 invoice-block pull-right">
                    <table style="float: right;" class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <td style="text-align: left;" class="col-6">
                                <strong>Sub - Total amount :</strong>
                            </td>
                            <td style="text-align: right;" class="col-6">

                                ৳ {{  number_format($single_invoice->subtotal,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;" class="col-6">
                                <strong>Discount <b>(-)</b> <i>
                                        @if($discount->type=="Percentage")
                                            {{$discount->value}}%  @endif</i> :</strong>
                            </td>
                            <td style="text-align: right;" class="col-6">

                                ৳ {{ number_format($single_invoice->discount_amount,2) }}

                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;" class="col-6">
                                <strong>VAT  {{ $business_type->tax}}<i>%</i>:</strong>
                            </td>
                            <td style="text-align: right;" class="col-6">

                                ৳ {{  number_format($single_invoice->tax,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;" class="col-6">
                                <strong>TDR  <i>
                                        @if($business_type->tdr_type=="Percentage")
                                            {{$business_type->total_tdr}}%  @endif
                                    </i>:</strong>
                            </td>
                            <td style="text-align: right;" class="col-6">

                                ৳ {{  number_format($single_invoice->tdr_value,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;" class="col-6">
                                <strong>Grand Total:</strong>
                            </td>
                            <td style="text-align: right;" class="col-6">

                                ৳ {{ number_format($single_invoice->total_amount,2)}}


                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="text-center invoice-btn">
                <a href="{{route('invoice.history')}}"  class="btn btn-danger btn-lg pull-left"><i class="fa fa-arrow-left"></i> Back </a>
                @if($single_invoice->payment_status=='Unpaid')
                    <form  id="payment_gw" action="https://sandbox.sslcommerz.com/gwprocess/v3/process.php" method="post" name="payment_gw">
                        <input type="hidden" name="store_id" value="test" />
                        <input type="hidden" name="value_a" value="{{$single_invoice->id}}">
                        <input type="hidden" name="value_b" value="{{$single_invoice->relUser->email}}">
                        <input type="hidden" name="total_amount" value="{{$single_invoice->total_amount}}" />
                        <input type="hidden" name="tran_id" value="t{{time().rand(000,999) }}" />
                        <input type="hidden" name="success_url" value="{{ url('invoice/payment/success') }}" />
                        <input type="hidden" name="fail_url" value="{{url('invoice/payment/failed')}}" />
                        <input type="hidden" name="cancel_url" value="{{url('invoice/payment/cancel')}}" />
                         <button type="submit" class="btn btn-info btn-lg"  ><i class="fa fa-money"></i> Pay </button>
                   </form>
                @endif
            </div>


        </div>

    </div>
</section>
{{--<script type='text/javascript'>--}}
    {{--document.payment_gw.submit();--}}
{{--</script>--}}