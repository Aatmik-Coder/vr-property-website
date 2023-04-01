<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Agency{
    public function handle(Request $request, Closure $next) {
        if(!Auth::guard('agency')->check()) {
            return redirect()->route('agency.login');
        }
        return $next($request);
    }
}