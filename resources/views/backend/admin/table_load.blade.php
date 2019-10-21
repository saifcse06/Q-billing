<table  class="display table table-bordered table-striped" id="load"  >
    <thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Status</th>
        <th class="hidden-phone">Actions</th>
    </tr>


    </thead>
    <tbody>
    @foreach($alltypeofuser as $k=>$v)
    <tr>
        <td>{{ $serial++ }}</td>
        <td>{{$v->type}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->phone}}</td>
        <td>{{$v->email}}</td>
        <td>{{$v->address}}</td>
        <td class="status{{$v->id}}">

    <span class="label @if($v->status=='Pending') label-warning @elseif($v->status=='Inactive') label-warning @elseif($v->status=='Suspended') label-danger @elseif($v->status=='Active') label-success @endif">{{$v->status}} </span>

        </td>
        <td>
            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu float-right">
                    <li>
                        <a href="{{route("admin.edit",$v->id)}}" ><i class="fa fa-edit"></i> Edit</a>
                    </li>
                    <li>
                        <a href="{{route('admin.show',$v->id)}}"><i class="fa fa-user"></i> Profile</a>
                    </li>
                    @if($v->type=='Client')
                    <li>
                        <a href="{{route('client.business',$v->id)}}"> <i class="fa fa-briefcase"></i> Client Business</a>
                    </li>
                    @endif
                    <li class="divider"></li>

                    <li class="action{{$v->id}}">
                        @if($v->status=='Pending')
                            <a href="#" class="status-modal"  data-id="{{$v->id}}" data-status="Active" > <i class="fa  fa-check-square-o" ></i> Active </a>
                            <a href="#" class="status-modal" data-id="{{$v->id}}"  data-status="Suspended" > <i class="fa  fa-times" ></i> Suspended  </a>
                        @endif
                        @if($v->status=='Active')
                            <a href="#" class="status-modal" data-id="{{$v->id}}" data-status="Inactive" > <i class="fa fa-lock" ></i> Inactive </a>

                        @endif
                        @if($v->status=='Inactive')
                            <a href="#" class="status-modal" data-id="{{$v->id}}" data-status="Active" > <i class="fa  fa-check-square-o" ></i> Active </a>

                        @endif
                    </li>



                </ul>
            </div>
        </td>
    </tr>
        @endforeach
    </tbody>
</table>

<ul class="pagination pagination-lg pull-right">{{$alltypeofuser->links()}}</ul>