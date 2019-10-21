@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Client Business Type List
                </header>
                <div class="panel-body">
                    <div class="content">
                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::text('name',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Business Name']) }}
                            </div>

                            @if(Auth::user()->type=='Admin')
                                <div class="col-md-3">
                                    {!! Form::select('type',['Active'=>'Active','Inactive'=>'Inactive','Pending'=>'Pending','Rejected'=>'Rejected'],null,['class'=>'form-control','placeholder'=>'Select Status']) !!}
                                </div>
                            @endif
                            @if(Auth::user()->type=='Client')
                                <div class="col-md-3">
                                    {!! Form::select('type',['Active'=>'Active','Pending'=>'Pending','Inactive'=>'Inactive'],null,['class'=>'form-control','placeholder'=>'Select All']) !!}
                                </div>
                            @endif
                            <div class="col-md-3">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>

                    </div>
                    <br>

                    @if (count($allbusinesstype) > 0)
                        <div class="table-responsive businesstype">
                            @include('backend.client_business_type.table_load')
                        </div>
                    @else
                        <h3 style="text-align: center">No Data Found</h3>
                        <a href="{{route('client_business_type.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>

                    @endif
                </div>
            </section>

            {{ csrf_field() }}
            {{--delete modal content--}}
            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="deleteContent">
                                Are you Sure you want to Delete <span id="title_delete"></span> ? <span
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
            {{--change status modal--}}
            <div id="statusChange" class="modal fade" role="dialog">
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
                                        class="hidden changeStatusid"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn statusBtn" data-dismiss="modal">
                                    <span id="footer_status_button" class='fa'> </span>
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
<style>
    .crposition {
        padding-right: 10px;
        float: left;
    }
</style>
    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
@endpush
@push('js')


    @include('backend.client_business_type._script')
@endpush