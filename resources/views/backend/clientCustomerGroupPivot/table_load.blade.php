<table class="table table-bordered" id="load"   >
    <thead>
    <tr>
        <th>ID</th>

        <th>Customer Name</th>
        <th>Phone</th>
        <th>Group Name</th>

        <th>Status</th>
        <th class="hidden-phone">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clientCustomerGroupPivot as $k=>$v)
        <tr class="item{{$v->id}}">
            <td>{{ $serial++ }}</td>
            <td>{{$v->relUser->name}}</td>
            <td>{{$v->relUser->phone}}</td>
            <td>{{$v->relCustomerGroup->name}}</td>
            <td class="status{{$v->id}}">
                <span class="label @if($v->status=='Pending') label-warning @elseif($v->status=='Inactive') label-warning @elseif($v->status=='Rejected') label-danger @elseif($v->status=='Active') label-success @endif">{{$v->status}} </span>

            </td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu float-right">
                        <li>
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

                        <li class="divider"></li>
                        <li> <a href="#" class="delete-modal" data-id="{{$v->id}}"  data-name="{{$v->name}}"><i class="fa fa-trash-o"></i>  Delete</a></li>
                    </ul>
                </div>


            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination pagination-lg pull-right">{{ $clientCustomerGroupPivot->links() }}</ul>