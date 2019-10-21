@extends('layouts.login')
@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <img src="{!! asset('img/logo.png') !!}" style="margin-top: 10px">
        <h2 class="form-signin-heading" style="padding-bottom: 0px">
            {{ __('Login') }} to ADN Quick Billing
        </h2>
        <div class="login-wrap" style="padding-top: 0px">
            @include('layouts.backend._validationErrorMessages')
            <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
            @if ($errors->has('username'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label class="checkbox">
                <label style="float: left;padding: 0px 0px 10px 0px;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
                {{--<span class="pull-right">--}}
                {{--<a data-toggle="modal"  href="#myModal" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>--}}

                {{--</span>--}}
            </label>
            <button type="submit" class="btn btn-lg btn-login btn-block">
                {{ __('Login') }}
            </button>
            <div class="registration">
                 Create an account
                <a class="" href="{{route('client.registration')}}">
                    Payee Account
                </a>||
                <a class="" href="{{route('customer.registration')}}">
                    Payer Account
                </a>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Forgot Password ?</h4>
                </div>
                <div class="modal-body">
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button class="btn btn-success" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
@endsection
