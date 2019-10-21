<table class="table table-bordered" id="load">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tran. No.</th>
        <th>Customer Name</th>
        <th>Payment Date</th>
        <th>Last Payment</th>
        <th>Total Amount</th>
        <th>Payment Status</th>

    </tr>
    </thead>
    <tbody>
    @foreach($all_history as $k=>$v)
        <tr class="item">
            <td>{{$serial++}}</td>
            <td>{{ $v->tran_id}} </td>
            <td> {{$v->relUser->name}}</td>
            <th>{{$v->payment_date}}</th>
            <td> {{\Carbon\Carbon::parse($v->payment_date)->format('jS \o\f F, Y g:i a')}} </td>
            <td style="text-align: right;"> ৳ {{number_format($v->payment_amount,2)}}</td>
            <td class="status">
                {{$v->status}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination pagination-lg pull-right">{{ $all_history->links() }}</ul>