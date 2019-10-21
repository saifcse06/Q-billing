<table class="table table-bordered dynamic-reportTable" id="load"   >
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Business</th>
        <th>Items</th>
        <th>Customer Groups</th>
        <th>Invoice</th>
        <th>Paid Invoice</th>
        <th>UnPaid Invoice</th>
        <th>Total TDR</th>
        <th>Status</th>
        <th class="hidden-phone">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allClientInfo as $k=>$v)
        <tr class="item{{$v->id}}">
            <td>{{ $serial++ }}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->phone}}</td>
            <td>{{$v->email}}</td>
            <td>{{count($v->relClientBusinessType)}}</td>
            <td>{{count($v->relClientBusinessItems)}}</td>
            <td>{{count($v->relCustomerGroup)}}</td>
            <td>{{count($v->relInvoice)}} </td>
            <td>{{count($v->relInvoice->where('payment_status','Paid'))}} </td>
            <td>{{count($v->relInvoice->where('payment_status','Unpaid'))}} </td>
            <td  style="text-align: right;">{{$v->relInvoice->where('payment_status','Paid')->sum('tdr_value')}}  </td>

            <td class="status{{$v->id}}">
                <span class="label @if($v->status=='Pending') label-warning @elseif($v->status=='Inactive') label-warning @elseif($v->status=='Rejected') label-danger @elseif($v->status=='Active') label-success @endif">{{$v->status}} </span>

            </td>
            <td>

<a href="{{route('client.business_report',$v->id)}}" class="btn btn-info btn-xs">Business</a>
 {{--<a href="{{route('client.invoice',$v->id)}}" class="btn btn-default btn-xs">Invoice</a>--}}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination pagination-lg pull-right">{{ $allClientInfo->links() }}</ul>