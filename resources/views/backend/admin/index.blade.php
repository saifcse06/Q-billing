@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    User Lists
                </header>
                <div class="panel-body">
                    <div class="content">
                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}
                            <div class="col-md-2 col-md-offset-2">
                                {{ Form::text('name',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Name']) }}
                            </div>

                            <div class="col-md-2 ">
                                {{ Form::text('phone',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Phone Number']) }}
                            </div>
                            <div class="col-md-2">
                                {!! Form::select('type',['Admin'=>'Admin','Client'=>'Client','Customer'=>'Customer'],null,['class'=>'form-control','placeholder'=>'Select All']) !!}
                            </div>
                            @if(Auth::user()->type=='Admin')
                                <div class="col-md-2">
                                    {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive','Pending'=>'Pending','Rejected'=>'Rejected'],null,['class'=>'form-control','placeholder'=>'Select All']) !!}
                                </div>
                            @endif
                            @if(Auth::user()->type=='Client')
                                <div class="col-md-2">
                                    {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control','placeholder'=>'Select All']) !!}
                                </div>
                            @endif
                            <div class="col-md-2">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>

                    </div>
                    <br>
                    <div class="table-responsive userlistofadmin">
                        @if (count($alltypeofuser) > 0)
                     @include('backend.admin.table_load')
                        @else
                            <h3  style="text-align: center">No Data Found</h3>
                        @endif
                    </div>
                </div>
            </section>

            {{ csrf_field() }}
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                             <div class="deleteContent">
                                Are you Sure you want to Change Status <span class="dname"></span> ? <span
                                        class="hidden did"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn actionBtn" data-dismiss="modal">
                                    <span id="footer_action_button" class='fa'> </span>
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <span class='fa fa-times'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
@endpush
@push('js')

    @include('backend.admin._script')
@endpush