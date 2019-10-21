<table class="table table-bordered dynamic-reportTable" id="load">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact Name</th>
        <th>Logo</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Tax</th>
        <th>Client TDR</th>
        <th>Services TDR</th>
        <th>TDR Type</th>
        <th>Status</th>

    </tr>
    </thead>
    <tbody>
    @foreach($allbusinesstype as $k=>$v)
        <tr class="item{{$v->id}}">
            <td>{{ $serial++ }}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->contact_name}}</td>
            <td><img src="{{ asset('project_files/client_logo') }}/{{$v->logo}}" style="width: 100px;height: 50px">  </td>
            <td>{{$v->phone_number}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->tax}} %</td>
            <td>{{$v->my_tdr}}  @if($v->tdr_type=='Percentage')<i>(%)</i>@endif</td>
            <td style="text-align: center;">{{$v->services_tdr}}  @if($v->tdr_type=='Percentage')<i>(%)</i>@endif </td>

            <td style="text-align: center;">{{$v->total_tdr}} @if($v->tdr_type=='Percentage')<i>(%)</i>@endif</td>
            <td class="status{{$v->id}}">
                <span class="label @if($v->status=='Pending') label-warning @elseif($v->status=='Inactive') label-warning @elseif($v->status=='Rejected') label-danger @elseif($v->status=='Active') label-success @endif">{{$v->status}} </span>

            </td>

        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{ route('clients.report') }}?type=Client" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>

