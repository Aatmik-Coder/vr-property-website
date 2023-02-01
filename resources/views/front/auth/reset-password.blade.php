@extends('front.layouts.app')
@section('content')

<div class="login-sec">
    <div class="form-view">
        <form class="login-form" id="resetFrm" name="resetFrm" method="POST" action="{{ route('password.store') }}">
            <h3 class="form-title">Reset your Password</h3>
            <p class="para">Type in your email address below and we’ll reset it for you.</p>
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" autocomplete="email" data-msg="Please enter email address" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="form-label">{{ __('New Password*') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" data-msg="Please enter your password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password*') }}</label>
                <input id="password-confirm" name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password-1" data-msg="Please enter your confirm password">
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-gradient">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
    <div class="logo-view">
        <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="img-fluid logo" alt="logo-colored" />
        <div class="text-center mt-5">
            <a href="{!! route('payment-info') !!}" class="btn btn-black mb-3">
                {{ __('Why Sign Up?') }}
            </button>
            <br>
            <a href="{!! route('payment-info') !!}" class="btn btn-black">
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
