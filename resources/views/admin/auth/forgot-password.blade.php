@extends('admin.layouts.app')

@section('content')
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder">
            <div class="row">
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <h1 class="mb-5">Forgot Password</h1>
                            <form id="passwordFrm" name="passwordFrm" method="POST"
                                action="{{ route('admin.password.email') }}">
                                @csrf
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

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-gradient">
                                        {{ __('Send Password Reset Link') }}
                                    </button>

                                    <button type="button" class="btn btn-dark"
                                        onclick="location.href='{{ route('admin.login') }}';">
                                        {{ __('Back To Login') }}
                                    </button>
                                </div>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
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
                                <h1>Forgot Password</h1>
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
@section('js')
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
@stop
@endsection