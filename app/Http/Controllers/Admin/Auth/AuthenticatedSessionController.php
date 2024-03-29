<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\DeveloperLoginRequest;
use App\Http\Requests\Auth\AgencyLoginRequest;
use App\Http\Requests\Auth\EmployeeLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    public function __construct(Request $request) {
        // dd($request);
        $this->request = $request;
    }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $title = "Admin Login";
        return view('admin.auth.login',compact('title'));
    }

    // public function developerCreate(): View
    // {
    //     $title = "Admin developer Login";
    //     return view('admin.auth.developer-login',compact('title'));
    // }

    // public function agencyCreate(): View
    // {
    //     $title = "Admin Agency Login";
    //     return view('admin.auth.agency-login', compact('title'));
    // }

    public function employeeCreate(): View
    {
        $title = 'Admin Employee Login';
        return view('admin.auth.login', compact('title'));
    }

    protected function guard()
    {
        // info($this->request->segment(1));
        if($this->request->segment(1) == 'admin') {
            info('admin');
            return Auth::guard('admin');
        }
        if($this->request->segment(1) == 'developer'){
            return Auth::guard('developer');
        } 
        if($this->request->segment(1) == 'agency') {
            return Auth::guard('agency');
        }
        if($this->request->segment(1) == 'employee') {
            info('this will return employee guard');
            return Auth::guard('employee');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        info("admin");
        $request->authenticate();
        $user = auth('admin')->user();
        // $developer = auth('developer')->user();
        // $employee = auth('employee')->user();
        // $agency = auth('agency')->user();
        // // dd($user);
        // if($developer) {
        //     Auth::guard('developer');
        // }
        // if($employee) {
        //     Auth::guard('employee');
        // }
        // if($agency) {
        //     Auth::guard('agency');
        // }
            // dd($user);
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

    public function developerStore(DeveloperLoginRequest $request): RedirectResponse
    {
        info("developer");
        $request->authenticate();
        $developer = auth('developer')->user();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::DEVELOPER_HOME);
    }

    public function agencyStore(AgencyLoginRequest $request): RedirectResponse
    {
        info("agency");
        $request->authenticate();
        $agency = auth('agency')->user();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::AGENCY_HOME);
    }

    public function employeeStore(EmployeeLoginRequest $request): RedirectResponse
    {
        info("employee");
        $request->authenticate();
        $employee = auth('employee')->user();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->guard()->logout();
        info('logout');
        info($request->session()->all());
        foreach (array_keys($request->session()->all()) as $key) {
            info($key);
            info(strpos($key, 'login_$request->segment(1)_'));
            //If the key is found in your string, set $found to true
            if (strpos($key, 'login_$request->segment(1)_') !== false) {
                $request->session($key)->forget();
                break;
            }
            info('ended');
        }

        $request->session()->regenerateToken();
        info('return back');
        return redirect('/admin/login');
    }
}
