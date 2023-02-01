@extends('front.layouts.app')
@section('content')
<div class="login-sec">
    <div class="form-view singup">
        <form class="login-form" id="registerFrm" name="registerFrm" method="POST" action="{{ route('register') }}">
            <h3 class="form-title">{!! $title !!}</h3>
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email address*') }}</label>
                <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="new-email" data-msg="Please enter email address" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="first_name" class="form-label">{{ __('First name*') }}</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                        value="{{ old('first_name') }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="last_name" class="form-label">{{ __('Last name*') }}</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                        value="{{ old('last_name') }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="nick_name" class="form-label">{{ __('Add a nickname*') }}</label>
                <input id="nick_name" type="text" class="form-control @error('nick_name') is-invalid @enderror" name="nick_name"
                value="{{ old('nick_name') }}">
                @error('nick_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="business_name" class="form-label">{{ __('Add the name of your business (optional)') }}</label>
                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name"
                value="{{ old('business_name') }}">
                @error('business_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="form-label">{{ __('Create Password*') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" data-msg="Please enter your password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password-confirm" class="form-label">{{ __('Re-enter Password*') }}</label>
                <input id="password-confirm" name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password-1" data-msg="Please enter your confirm password">
            </div>
            <div class="form-group form-check">
                <label class="form-check-label " for="exampleCheck1"> By clicking to create an account I have read and agree to the <a href="javascript:void(0)">Terms & Conditions</a> and the <a href="javascript:void(0)">Privacy Policy.</a>
                </label>
                <input type="checkbox" class="form-check-input" id="agree" name="agree">
              </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-gradient">
                    {{ __('Sign Up') }}
                </button>
            </div>
            <div class="mt-4">
                <a class="forgot-pass" href="{{ route('password.request') }}">
                    {{ __("I have an account, but I’ve forgotten my password") }}
                </a>
            </div>
        </form>
    </div>
    <div class="logo-view">
        <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="img-fluid logo" alt="logo-colored" />
        <div class="text-center mt-5">
            <a href="{!! route('payment-info') !!}" class="btn btn-black mb-3">
                {{ __('Why Sign Up?') }}
            </a>
            <a href="{!! route('payment-info') !!}" class="btn btn-black">
                {{ __('Learn More') }}
            </a>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
