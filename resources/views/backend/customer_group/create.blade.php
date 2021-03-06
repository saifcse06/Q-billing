@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-lg-7">
            <section class="panel">
                <header class="panel-heading">
                    Create  Customer Group
                </header>
                <div class="panel-body">
                    @include('layouts.backend._validationErrorMessages')
                    {!! Form::open(['route'=>'customer_group.store','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                    @include('backend.customer_group._form')
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::submit('Create',['class'=>'btn btn-success btnCreate pull-right']) !!}
                            <a href="{{ route('customer_group.index') }}" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>
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
@endpush

@push('js')

@include('backend.customer_group._script')

@endpush