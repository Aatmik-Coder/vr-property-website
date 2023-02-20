<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $title = "Admin Login";
        return view('admin.auth.login',compact('title'));
    }

    public function developerCreate(): View
    {
        $title = "Admin developer Login";
        return view('admin.auth.developer-login',compact('title'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        // dd($request->session());
        $request->authenticate();
        $user = auth('admin')->user();

        if(!$user->is_active)
        {
            $this->guard()->logout();
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Your account is inactive. Please contact your administrator to get access!',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        foreach (array_keys($request->session()->all()) as $key) {
            //If the key is found in your string, set $found to true
            if (strpos($key, 'login_admin_') !== false) {
                $request->session($key)->forget();
                break;
            }
        }

        $request->session()->regenerateToken();

        return redirect()->to(RouteServiceProvider::ADMIN_HOME);
    }
}
