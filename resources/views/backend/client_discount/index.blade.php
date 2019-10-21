@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    All  Discount List
                </header>
                <div class="panel-body">
                    <div class="content">

                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}
                            <div class="col-md-3 col-md-offset-1">
                                {!! Form::select('client_business_type_id',$allBusinessType,null,['class'=>'form-control','placeholder'=>'Select Business Type ']) !!}
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('title',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Discount Title']) }}
                            </div>

                            <div class="col-md-3">
                                {!! Form::select('status',['Used'=>'Used','Using'=>'Using','Unused'=>'Unused'],null,['class'=>'form-control','placeholder'=>'Select Status']) !!}
                            </div>

                            <div class="col-md-2">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>

                        <br>
                        @if (count($alldiscout) > 0)
                            <div class="table-responsive discount">
                                @include('backend.client_discount.table_load')
                            </div>
                        @else

                            <h3 style="text-align: center">No Data Found <br>
                                <a href="{{route('client_discount.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
                            </h3>

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

    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
@endpush
@push('js')


    @include('backend.client_discount._script')
@endpush