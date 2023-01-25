@extends('front.layouts.app')
@section('content')
<form id="loginFrm" name="loginFrm" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <input id="email" type="email"
        class="input-material @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" data-msg="Please enter email address" autofocus>
        <label for="email" class="label-material">{{ __('E-Mail Address') }}</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="first_name" type="text" class="input-material @error('first_name') is-invalid @enderror" name="first_name"
        value="{{ old('first_name') }}">
        <label for="first_name" class="label-material">{{ __('First Name') }}</label>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="last_name" type="text" class="input-material @error('last_name') is-invalid @enderror" name="last_name"
        value="{{ old('last_name') }}">
        <label for="last_name" class="label-material">{{ __('Last Name') }}</label>
        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="nickname" type="text" class="input-material @error('nickname') is-invalid @enderror" name="nickname"
        value="{{ old('nickname') }}">
        <label for="nickname" class="label-material">{{ __('Add a nickname') }}</label>
        @error('nickname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="business_name" type="text" class="input-material @error('business_name') is-invalid @enderror" name="business_name"
        value="{{ old('business_name') }}">
        <label for="business_name" class="label-material">{{ __('Add the name of your business') }}</label>
        @error('business_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="password" type="password" class="input-material @error('password') is-invalid @enderror" name="password" autocomplete="current-password" data-msg="Please enter your password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password" class="label-material">{{ __('Password') }}</label>
    </div>
    <div class="form-group">
        <input id="password-confirm" name="password_confirmation" type="password" class="input-material @error('password') is-invalid @enderror" autocomplete="current-password-1" data-msg="Please enter your confirm password">
        <label for="password-confirm" class="label-material">{{ __('Confirm Password') }}</label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</form>

<a class="forgot-pass" href="{{ route('login') }}">
    {{ __('Already registered?') }}
</a>
<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
@endsection
