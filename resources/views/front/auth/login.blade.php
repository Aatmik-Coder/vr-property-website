@extends('front.layouts.app')
@section('content')

<div class="login-sec">
    <div class="form-view">
        <form class="login-form" id="loginFrm" name="loginFrm" method="POST" action="{{ route('login') }}">
            <h3 class="form-title">{!! $title !!}</h3>
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="email" data-msg="Please enter email address" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="current-password" data-msg="Please enter your password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @if (Route::has('password.request'))
            <div class="my-4">
                <a class="forgot-pass" href="{{ route('password.request') }}">
                    {{ __("I’ve forgotten my password?") }}
                </a>
            </div>
            @endif
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-gredient mb-3">
                    {{ __('Log In') }}
                </button>
                <br>
                <a href="{{ route('register') }}" class="btn btn-gredient">
                    {{ __('Sign Up') }}
                </a>
            </div>
        </form>
    </div>
    <div class="logo-view">
        <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="img-fluid logo" alt="logo-colored" />
        <div class="text-center mt-5">
            <a href="javascript:void(0)" class="btn btn-gredient mb-3">
                {{ __('Why Sign Up?') }}
            </a>
            <br>
            <a href="javascript:void(0)" class="btn btn-gredient">
                {{ __('Learn More') }}
            </a>
        </div>
    </div>
</div>


<!-- JavaScript files-->
@endsection
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
