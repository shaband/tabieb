<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotPharamacyRep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $guard = 'pharamacy_rep')
    {
        if (Auth::guard($guard)->check()) {
            auth()->setDefaultDriver($guard);

            return $next($request);
        }

        $redirectToRoute = $request->expectsJson() ? '' : 'pharamacyrep/login';

        throw new AuthenticationException(
            'Unauthenticated.', [$guard], $redirectToRoute
        );
    }

}
