<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfPharmacyRep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'pharmacy_rep')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('pharmacy.dashboard');
        }

        return $next($request);
    }

}
