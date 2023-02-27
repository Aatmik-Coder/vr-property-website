<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Employee{
    public function handle(Request $request, Closure $next) {
        if(!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login');
        }
        return $next($request);
    }
}