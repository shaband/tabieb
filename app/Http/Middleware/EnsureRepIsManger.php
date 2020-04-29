<?php

namespace App\Http\Middleware;

use Closure;

class EnsureRepIsManger
{
    /**
     * Handle an incoming request.
     * check if user role is not manger abort to 404
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('pharmacy_rep')->check() && auth()->guard('pharmacy_rep')->user()->role == 1) {
            return $next($request);
        }/*
        toast(__("User Don't Have Permission"), 'error');
        redirect()->route('pharmacy.dashboard');*/

        abort(404);
    }
}
