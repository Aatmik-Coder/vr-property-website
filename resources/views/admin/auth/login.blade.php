@extends('admin.layouts.app')

@section('content')
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder">
            <div class="row">
                <!-- Form Panel -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <h1 class="mb-5">Login</h1>
                            <form id="loginFrm" name="loginFrm" method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="dropDown" class="label-material">{{ __('Login as') }}</label>
                                    <select name="dropDown" id="dropDown" @error('email') is-invalid @enderror" class="form-control dropDown">
                                        <option value="">Select Login</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Agency">Agency</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="label-material">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                        class="input-material @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email"
                                        data-msg="Please enter email address" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="label-material">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="input-material @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password" data-msg="Please enter your password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>

                            @if (Route::has('admin.password.request'))
                            <a class="forgot-pass" href="{{ route('admin.password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content text-center logo-content">
                            <div class="logo">
                                <div class="logo-inner">
                                    <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="logo-img">
                                </div>
                                <h1>Admin Panel</h1>
                            </div>
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
<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
@stop
@endsection