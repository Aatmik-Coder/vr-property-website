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
                            <h1 class="mb-5">Employee Login</h1>
                            <form id="devloginFrm" name="devloginFrm" method="POST" action="{{ route('employee.login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="person_email" class="label-material">{{ __('E-Mail Address') }}</label>
                                    <input id="person_email" type="email"
                                        class="input-material @error('person_email') is-invalid @enderror" name="person_email"
                                        value="{{ old('person_email') }}" autocomplete="person_email"
                                        data-msg="Please enter email address" autofocus>
                                    @error('person_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="person_password" class="label-material">{{ __('Password') }}</label>
                                    <input id="person_password" type="password"
                                        class="input-material @error('person_password') is-invalid @enderror" name="person_password"
                                        autocomplete="current-password" data-msg="Please enter your password">
                                    @error('person_password')
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

                            @if (Route::has('employee.password.request'))
                            <a class="forgot-pass" href="{{ route('employee.password.request') }}">
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
{{-- <script src="{{ asset('assets/admin/js/employee_auth.js') }}"></script> --}}
@stop
@endsection