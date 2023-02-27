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
            'person_email' => ['required','string','email'],
            'person_password' => ['required','string']
        ];
    }

    public function authenticate() {
        $this->ensureIsNotRateLimited();

        if(!Auth::guard('employee')->attempt(['person_email'=>$this->input('person_email'), 'password'=>$this->input('person_password')], $this->boolean('remember'))) {
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