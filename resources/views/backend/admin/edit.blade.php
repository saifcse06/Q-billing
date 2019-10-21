@extends('layouts.backend.master')
@section('content')
<div class="row">
    <div class="col-md-offset-2 col-lg-7">
        <section class="panel">
            <header class="panel-heading">
                Create admin
            </header>
            <div class="panel-body">
                @include('layouts.backend._validationErrorMessages')
                {!! Form::model($admin,['route'=>['admin.update',$admin->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data",'id'=>'userform']) !!}
                    @include('backend.admin._form')
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Update',['class'=>'btn btn-success btnCreate pull-right']) !!}
                            <a href="{{ route('admin.index') }}" class="btn btn-warning pull-left"> <i class="fa fa-arrow-left"></i> Back</a>
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
@endpush
@push('js')

    <script type="text/javascript" src="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <!--this page  script only-->
    <script src="{{ asset('js/advanced-form-components.js') }}"></script>
    @include('backend.admin._script')
@endpush