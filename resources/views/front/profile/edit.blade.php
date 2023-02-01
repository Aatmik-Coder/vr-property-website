@extends('front.layouts.app')
@section('content')


<div class="login-sec">
    <div class="form-view singup">
        <form class="login-form" id="registerFrm" name="registerFrm" method="POST" action="{{ route('profile.update') }}">
            <h3 class="form-title">{!! $title !!}</h3>
            @csrf
            @method('patch')
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="first_name" class="form-label">{{ __('First name*') }}</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                        value="{{ old('first_name', $user->first_name) }}">
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
                        value="{{ old('last_name', $user->last_name) }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email address*') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                value="{{ old('email', $user->email) }}" autocomplete="new-email" data-msg="Please enter email address" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="nick_name" class="form-label">{{ __('Nickname(username)*') }}</label>
                <input id="nick_name" type="text" class="form-control @error('nick_name') is-invalid @enderror" name="nick_name"
                value="{{ old('nick_name', $user->nick_name) }}">
                @error('nick_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong> $user = auth()->user()->id;
                </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="business_name" class="form-label">{{ __('The name of your business(optional)') }}</label>
                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name"
                value="{{ old('business_name', $user->business_name) }}">
                @error('business_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-gredient">
                    {{ __('Update Profile') }}
                </button>
            </div>
        </form>
    </div>
</div>
<div class="login-sec">
    <div class="form-view singup">
        <form class="password-form" id="changeFrm" name="changeFrm" method="POST" action="{{ route('password.update') }}">
            <h3 class="form-title">{{__('Change Password')}}</h3>
            @csrf
            @method('put')
            <div class="form-group mt-3">
                <label for="password" class="form-label">{{ __('Current Password*') }}</label>
                <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="form-label">{{ __('New Password*') }}</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password*') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            
            <div class="form-group text-center">
                <button type="submit" class="btn btn-gredient">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
    
</div>
@endsection
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop


    
