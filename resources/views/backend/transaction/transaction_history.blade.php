@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    All  Transaction List
                </header>
                <div class="panel-body">
                    <div class="content">

                        {{--<div class="row">--}}
                            {{--{{ Form::open(['method'=>'get']) }}--}}

                            {{--<div class="col-md-3">--}}
                                {{--{{ Form::text('name',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Item Name']) }}--}}
                            {{--</div>--}}

                            {{--<div class="col-md-3">--}}
                                {{--{!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control','placeholder'=>'Select Type']) !!}--}}
                            {{--</div>--}}

                            {{--<div class="col-md-2">--}}
                                {{--{{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}--}}
                            {{--</div>--}}

                            {{--{{ Form::close() }}--}}
                        {{--</div>--}}

                        {{--<br>--}}
                        @if (count($all_history) > 0)
                            <div class="table-responsive businesstype">
                                @include('backend.transaction.table_load')
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


    @include('backend.transaction._script')
@endpush