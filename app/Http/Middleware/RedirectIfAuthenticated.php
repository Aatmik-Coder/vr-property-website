<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            info("this is the check ".Auth::guard($guard)->check());
            info($guard);
            if (Auth::guard($guard)->check()) {
                if($guard == 'employee') {
                    return redirect(RouteServiceProvider::EMPLOYEE_HOME);
                }
                if($guard == "admin") {
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                }
                if($guard == 'developer') {
                    return redirect(RouteServiceProvider::DEVELOPER_HOME);
                } 
                if($guard == 'agency') {
                    return redirect(RouteServiceProvider::AGENCY_HOME);
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
