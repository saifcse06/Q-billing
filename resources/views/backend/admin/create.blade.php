@extends('layouts.backend.master')
@section('content')
<div class="row">
    <div class="col-md-offset-2 col-lg-7">
        <section class="panel">
            <header class="panel-heading">
                Create User
            </header>

            <div class="panel-body">
                @include('layouts.backend._validationErrorMessages')
                @if(isset($customerCheck))
                    <div class="col-sm-8 col-sm-offset-3">
                        <div class="bootstrap snippet">
                            <div class="panel-body inf-content">


                                <div class="table-responsive">
                                    <table class="table table-condensed table-responsive table-user-information">
                                        <tbody>

                                        <tr>
                                            <td>
                                                <strong>
                                                    <i class="fa fa-user  text-primary"></i>
                                                    Name
                                                </strong>
                                            </td>
                                            <td class="text-primary">
                                                {{$customerCheck->name}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>
                                                    <i class="fa fa-envelope-o"></i>
                                                    Email
                                                </strong>
                                            </td>
                                            <td class="text-primary">
                                                {{$customerCheck->email}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <strong>
                                                    <i class="fa fa-phone"></i>
                                                    Mobile
                                                </strong>
                                            </td>
                                            <td class="text-primary">
                                                {{$customerCheck->phone}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>
                                                    <i class="fa fa-user"></i>
                                                    Type
                                                </strong>
                                            </td>
                                            <td class="text-primary">
                                                {{$customerCheck->type}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {!! Form::open(['route'=>'customer-to-client']) !!}
                                    <input type="hidden" name="uid" value="{{$customerCheck->id}}">
                            <button class="btn btn-info"  type="submit">Change Type</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif<br>
                {!! Form::open(['route'=>'admin.store','class'=>'form-horizontal','enctype'=>"multipart/form-data",'id'=>'userform']) !!}
                    @include('backend.admin._form')
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Create',['class'=>'btn btn-success btnCreate pull-right']) !!}
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