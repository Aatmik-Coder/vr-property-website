<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $title = "Sign In";
        return view('front.auth.login',compact('title'));
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $user = auth('web')->user();
        if(!$user->is_active)
        {
            $this->guard()->logout();
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Your account is inactive. Please contact your administrator to get access!',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        foreach (array_keys($request->session()->all()) as $key) {
            //If the key is found in your string, set $found to true
            if (strpos($key, 'login_web_') !== false) {
                $request->session($key)->forget();
                break;
            }
        }
        $request->session()->regenerateToken();
        return redirect()->back()->with(['alert-class' => 'success', 'message' => "You have signed out of your account."]);
    }
}
