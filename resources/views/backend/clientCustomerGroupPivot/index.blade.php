@extends('layouts.backend.master')
@section('content')
    @include('backend.clientCustomerGroupPivot.create')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    All  Customer Group List
                    <div class="pull-right">
                    </div>
                </header>
                <div class="panel-body">
                    <div class="content">

                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}

                            <div class="col-md-3 col-md-offset-3">
                                {!! Form::select('group_id',$allcustomergroup,null,['class'=>'form-control','placeholder'=>'Select Group']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control','placeholder'=>'Select Status']) !!}
                            </div>

                            <div class="col-md-3">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>

                        <br>
                        @if (count($clientCustomerGroupPivot) > 0)
                            <div class="table-responsive businesstype">
                                @include('backend.clientCustomerGroupPivot.table_load')
                            </div>
                        @else
                            <h3 style="text-align: center">No Data Found</h3>
                        @endif
                    </div>
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
        .form-horizontal .form-group{
            margin-right:0px!important;
        }
    </style>

    <link href="{!! asset('assets/select2/css/select2.min.css') !!}" rel="stylesheet" />
    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{!! asset('assets/select2/js/select2.min.js') !!}"></script>
    @include('backend.clientCustomerGroupPivot._script')
@endpush