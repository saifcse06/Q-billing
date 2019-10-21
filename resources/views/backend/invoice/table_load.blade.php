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
            <td class="td"> <a href="{{route('invoice.singlePreview',$v->id)}}" class="btn btn-primary"><i class="fa fa-file-text"></i>Preview </a> </td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination pagination-lg pull-right">{{ $allInvoiceLists->links() }}</ul>