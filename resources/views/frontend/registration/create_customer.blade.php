@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('layouts.backend._validationErrorMessages')
            {!! Form::open(['route'=>'customer.registration','class'=>'form-signin formwidth','enctype'=>"multipart/form-data",'id'=>'userform']) !!}
            <img src="{!! asset('img/logo.png') !!}" style="margin-top: 10px">
            <h2 class="form-signin-heading">registration  Payer Account</h2>
            <div class="login-wrap">
                @include('frontend.registration._form')

                {!! Form::submit('Submit',['class'=>'btn btn-lg btn-login btn-block btnCreate']) !!}
                <div class="registration">
                    Already Registered.
                    <a class="" href="{{route('login')}}">
                        Login
                    </a>
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
