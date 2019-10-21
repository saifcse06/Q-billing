@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-lg-7">
            <section class="panel">
                <header class="panel-heading">
                    Create Business
                </header>
                <div class="panel-body">
                    @include('layouts.backend._validationErrorMessages')
                    {!! Form::open(['route'=>'client_business_type.store','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                    @include('backend.client_business_type._form')
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::submit('Create',['class'=>'btn btn-success btnCreate pull-right']) !!}
                            <a href="{{ route('client_business_type.index') }}" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                          {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
    <style>
        .crposition {
            padding-right: 10px;
            float: left;
        }

    </style>
@endpush
@push('js')

    <script type="text/javascript" src="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>

    @include('backend.client_business_type._script')
@endpush