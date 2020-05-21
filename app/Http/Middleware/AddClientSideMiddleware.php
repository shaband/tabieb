<?php

namespace App\Http\Middleware;

use Closure;

class AddClientSideMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth('patient')->check()) {
            view()->share('client_type', 'patient');
            view()->share('client_id', auth()->guard('patient')->id());
        } elseif (auth('doctor')->check()) {

            view()->share('client_type', 'doctor');
            view()->share('client_id', auth()->guard('doctor')->id());
        } else {
            view()->share('client_type', null);
            view()->share('client_id', null);
        }
        return $next($request);
    }
}
