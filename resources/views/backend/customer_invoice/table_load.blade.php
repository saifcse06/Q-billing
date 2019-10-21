<table class="table table-bordered" id="load"   >
    <thead>
    <tr>
        <th>ID</th>
        <th>Invoice No.</th>
        <th>Customer Name</th>
        <th>Business</th>
        <th>Published Date</th>
        <th>Last Payment</th>
        <th>Total Amount</th>
        <th>Payment Status</th>
        <td class="th">Action</td>

    </tr>
    </thead>
    <tbody>
    @foreach($allInvoiceLists as $k=>$v)
        <tr class="item">
            <td>{{$serial++}}</td>
            <td>{{ $v->invoice_no}} </td>
            <td> {{$v->relUser->name}}</td>
            <td> {{$v->relBusinessType->name}}</td>
            <td> {{\Carbon\Carbon::parse($v->publish_date)->format('jS \o\f F, Y g:i a')}} </td>
            <td> {{\Carbon\Carbon::parse($v->last_payment_date)->format('jS \o\f F, Y g:i a')}} </td>
            <td style="text-align: right;"> ৳ {{number_format($v->total_amount,2)}}</td>
            <td class="status">
                {{$v->payment_status}}
            </td>
            <td class="td">
                <a href="{{route('invoice.details',$v->id)}}" style="margin-bottom: 5px;" class="btn btn-primary"><i class="fa fa-file-text"></i> Preview </a>

                @if($v->payment_status=='Unpaid')
                    <form  id="payment_gw" action="https://sandbox.sslcommerz.com/gwprocess/v3/process.php" method="post" name="payment_gw">
                        <input type="hidden" name="store_id" value="test" />
                        <input type="hidden" name="value_a" value="{{$v->id}}">
                        <input type="hidden" name="value_b" value="{{$v->relUser->email}}">
                        <input type="hidden" name="total_amount" value="{{$v->total_amount}}" />
                        <input type="hidden" name="tran_id" value="t{{time().rand(000,999) }}" />
                        <input type="hidden" name="success_url" value="{{ url('invoice/payment/success') }}" />
                        <input type="hidden" name="fail_url" value="{{url('invoice/payment/failed')}}" />
                        <input type="hidden" name="cancel_url" value="{{url('invoice/payment/cancel')}}" />
                        <button type="submit" class="btn btn-info"  ><i class="fa fa-money"></i> Pay Now </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>