@extends('front.layouts.app')
@section('content')
<form id="loginFrm" name="loginFrm" method="POST" action="{{ route('password.email') }}">
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
        <button type="submit" class="btn btn-primary">
            {{ __('Email Password Reset Link') }}
        </button>
    </div>
</form>

<a class="forgot-pass" href="{{ route('login') }}">
    {{ __('Back to Login?') }}
</a>
<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
@endsection
