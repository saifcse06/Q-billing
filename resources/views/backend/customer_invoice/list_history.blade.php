@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Invoice List
                    <div class="pull-right">
                    </div>
                </header>
                <div class="panel-body">
                    <div class="content">

                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}


                            <div class="col-md-3 col-sm-offset-3">
                                {!! Form::select('payment_status',['Paid'=>'Paid','Unpaid'=>'Unpaid'],null,['class'=>'form-control','placeholder'=>'Select Type']) !!}
                            </div>

                            <div class="col-md-3">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>
                        <br>

                        @if (count($allInvoiceLists) > 0)
                            <div class="table-responsive businesstype">
                                @include('backend.customer_invoice.table_load')
                            </div>
                        @else
                            <h3 style="text-align: center">No Data Found</h3>
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