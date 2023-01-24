@extends('admin.layouts.app')

@section('content')
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content text-center logo-content">
                            <div class="logo">
                                <div class="logo-inner">
                                    <img src="{{ asset('assets/common/images/logo.png') }}" class="logo-img">
                                </div>
                                <h1>Reset Password</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form id="resetFrm" name="resetFrm" method="POST" action="{{ route('admin.password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="form-group">
                                    <input id="email" type="email"
                                    class="input-material @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" autocomplete="email" data-msg="Please enter email address" autofocus>
                                    <label for="email" class="label-material">{{ __('E-Mail Address') }}</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <input id="password" type="password"
                                    class="input-material @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password" data-msg="Please enter your password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="password" class="label-material">{{ __('Password') }}</label>
                                </div>

                                <div class="form-group">

                                    <input id="password-confirm" name="password_confirmation" type="password"
                                    class="input-material @error('password') is-invalid @enderror"
                                    autocomplete="current-password-1" data-msg="Please enter your confirm password">


                                    <label for="password-confirm" class="label-material">{{ __('Confirm Password') }}</label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Design by <a href="{!! url('/') !!}" target="_blank">{{ config('app.name')}}</a></p>
    </div>
</div>
@section('js')
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
@stop
@endsection
