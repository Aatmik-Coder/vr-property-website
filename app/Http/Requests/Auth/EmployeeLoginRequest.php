<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EmployeeLoginRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'email' => ['required','string','email'],
            'password' => ['required','string']
        ];
    }

    public function authenticate() {

        info('this is the employee authenticate');
        $this->ensureIsNotRateLimited();
        // if(!Auth::guard('employee')->attempt($this->only('person_email','person_password'), $this->boolean('remember'))) {
        if(!Auth::guard('employee')->attempt(['person_email'=>$this->input('email'), 'password'=>$this->input('password')], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'person_email' => __('auth.falied'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited() {
        if(!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'person_email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey() {
        return Str::lower($this->input('person_email')).'|'.$this->ip();
    }
}