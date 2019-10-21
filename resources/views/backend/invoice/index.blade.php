@extends('layouts.backend.master')
@section('content')
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
                            <div class="col-md-3 col-md-offset-2">
                                {!! Form::select('business_type_id',$allBusinessType,null,['class'=>'form-control','placeholder'=>'Select Business Type ']) !!}
                            </div>

                            <div class="col-md-3">
                                {!! Form::select('status',['Paid'=>'Paid','Unpaid'=>'Unpaid'],null,['class'=>'form-control','placeholder'=>'Select Type']) !!}
                            </div>

                            <div class="col-md-2">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>
                        <br>
                        @if (count($allInvoiceLists) > 0)
                            <div class="table-responsive businesstype">
                                @include('backend.invoice.table_load')
                            </div>
                        @else
                            <h3 style="text-align: center">No Data Found<br>
                                <a href="{{route('invoice.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
                            </h3>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('css')

    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
@endpush
@push('js')
    @include('backend.invoice._script')
@endpush