@extends('front.layouts.app')
@section('content')
<form id="loginFrm" name="loginFrm" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input id="email" type="email"
        class="input-material @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" autocomplete="email" data-msg="Please enter email address" autofocus>
        <label for="email" class="label-material">{{ __('E-Mail Address') }}</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="password" type="password"
        class="input-material @error('password') is-invalid @enderror" name="password" autocomplete="current-password" data-msg="Please enter your password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password" class="label-material">{{ __('Password') }}</label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
    </div>
</form>

@if (Route::has('password.request'))
<a class="forgot-pass" href="{{ route('password.request') }}">
    {{ __('Forgot Your Password?') }}
</a>
@endif
<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
@endsection
