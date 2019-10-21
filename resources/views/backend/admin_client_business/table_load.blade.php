<table class="table table-bordered" id="load">
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
        <th class="hidden-phone">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allbusinesstype as $k=>$v)
        <tr class="item{{$v->id}}">
            <td>{{ $serial++ }}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->contact_name}}</td>
            <td>
                @if($v->logo)
                    <img src="{{ asset('project_files/client_logo') }}/{{$v->logo}}" style="width: 100px;height: 50px">
                @else
                    <img src="{{ asset('img/logo.png') }}" style="width: 100px;height: 50px">
                @endif</td>
            <td>{{$v->phone_number}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->tax}} %</td>
            <td>{{$v->my_tdr}}  @if($v->tdr_type=='Percentage')<i>(%)</i>@endif</td>
            <td style="text-align: center;">{{$v->services_tdr}}  @if($v->tdr_type=='Percentage')<i>(%)</i>@endif </td>

            <td style="text-align: center;">{{$v->total_tdr}} @if($v->tdr_type=='Percentage')<i>(%)</i>@endif</td>
            <td class="status{{$v->id}}">
                <span class="label @if($v->status=='Pending') label-warning @elseif($v->status=='Inactive') label-warning @elseif($v->status=='Rejected') label-danger @elseif($v->status=='Active') label-success @endif">{{$v->status}} </span>

            </td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu float-right">

                        <li class="action{{$v->id}}">
                        @if($v->status=='Pending')
                            <a href="#" class="status-modal"  data-id="{{$v->id}}" data-title="Active" > <i class="fa  fa-check-square-o" ></i> Active </a>
                            <a href="#" class="status-modal" data-id="{{$v->id}}"  data-title="Rejected" > <i class="fa  fa-times" ></i> Rejected  </a>
                        @endif
                        @if($v->status=='Active')
                            <a href="#" class="status-modal" data-id="{{$v->id}}" data-title="Inactive" > <i class="fa fa-lock" ></i> Inactive </a>

                        @endif
                        @if($v->status=='Inactive')
                            <a href="#" class="status-modal" data-id="{{$v->id}}" data-title="Active" > <i class="fa  fa-check-square-o" ></i> Active </a>

                        @endif
                        </li>

                      </ul>
                </div>


            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{ route('admin.index') }}?type=Client" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>

<ul class="pagination pagination-lg pull-right">{{ $allbusinesstype->links() }}</ul>