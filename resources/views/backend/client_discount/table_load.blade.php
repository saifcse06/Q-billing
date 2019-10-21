<table class="table table-bordered" id="load"   >
    <thead>
    <tr>
        <th>ID</th>
        <th>Business Type</th>
        <th>Title</th>
        <th>Value</th>
        <th>Expire Date</th>

        <th>Status</th>
        <th class="hidden-phone">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alldiscout as $k=>$v)
        <tr class="item{{$v->id}}">
            <td>{{ $serial++ }}</td>
            <td>{{$v->relBusinessType->name}}</td>
            <td>{{$v->title}}</td>

            <td style="text-align: center;"> {{$v->value}} (<i>{{$v->type}}</i>) </td>
            <td> {{ Carbon\Carbon::parse($v->expire_date)->format('d-m-Y') }}</td>

            <td class="status{{$v->id}}">
                <span class="label @if($v->status=='Unused') label-danger    @elseif($v->status=='Used') label-warning @elseif($v->status=='Using') label-success @endif">{{$v->status}} </span>

            </td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu float-right">
                        <li>
                            <a href="{{route("client_discount.edit",$v->id)}}" ><i class="fa fa-edit"></i> Edit</a></li>
                        <li class="action{{$v->id}}">
                            @if($v->status=='Unused')
                                <a href="#" class="status-modal"  data-id="{{$v->id}}" data-title="Using" > <i class="fa  fa-check-square-o" ></i> Using </a>
                                <a href="#" class="status-modal" data-id="{{$v->id}}"  data-title="Unused" > <i class="fa  fa-times" ></i> Unused  </a>
                            @endif
                            @if($v->status=='Using')
                                <a href="#" class="status-modal" data-id="{{$v->id}}" data-title="Used" > <i class="fa fa-lock" ></i> Used </a>

                            @endif
                            @if($v->status=='Used')
                                <a href="#" class="status-modal" data-id="{{$v->id}}" data-title="Using" > <i class="fa  fa-check-square-o" ></i> Using </a>

                            @endif
                        </li>

                        <li class="divider"></li>
                        <li> <a href="#" class="delete-modal" data-id="{{$v->id}}"  data-name="{{$v->title}}"><i class="fa fa-trash-o"></i>  Delete</a></li>
                    </ul>
                </div>


            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<ul class="pagination pagination-lg pull-right">{{ $alldiscout->links() }}</ul>