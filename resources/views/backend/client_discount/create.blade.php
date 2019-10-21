@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-lg-7">
            <section class="panel">
                <header class="panel-heading">
                    Create  Discount
                </header>
                <div class="panel-body">
                    @include('layouts.backend._validationErrorMessages')
                    {!! Form::open(['route'=>'client_discount.store','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                    @include('backend.client_discount._form')
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::submit('Create',['class'=>'btn btn-success btnCreate pull-right']) !!}
                            <a href="{{ route('client_discount.index') }}" class="btn btn-warning pull-left"> <i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-datepicker/css/datepicker.css') }}" />
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-daterangepicker/moment.min.js') }}"></script>

    @include('backend.client_discount._script')
@endpush