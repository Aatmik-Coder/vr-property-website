@extends('front.layouts.app')
@section('content')

<div class="login-sec">
    <div class="form-view">
        <form class="login-form" id="loginFrm" name="loginFrm" method="POST" action="{{ route('password.email') }}">
            <h3 class="form-title">Forgot your Password?</h3>
            <p class="para">Type in your email address below and we’ll reset it for you.</p>
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" data-msg="Please enter email address" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-outline-gredient">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
    <div class="logo-view">
        <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="img-fluid logo" alt="logo-colored" />
        <div class="text-center mt-5">
            <a href="{!! route('payment-info') !!}" class="btn btn-black mb-3 border-gradient">
                {{ __('Why Sign Up?') }}
            </a>
            <br>
            <a href="{!! route('payment-info') !!}" class="btn btn-black border-gradient">
                {{ __('Learn More') }}
            </a>
        </div>
    </div>
</div>
<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
@endsection
