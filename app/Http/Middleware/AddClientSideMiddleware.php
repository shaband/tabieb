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
            $client_type = 'patient';
            $client_id = auth()->guard('patient')->id();
            $notifications = auth()->guard('patient')->user()->notifications->take(5);
        } elseif (auth('doctor')->check()) {
            $client_type = 'doctor';
            $client_id = auth()->guard('doctor')->id();
            $notifications = auth()->guard('doctor')->user()->notifications->take(5);

        } else {
            $client_type = null;
            $client_id = null;
            $notifications = [];
        }

        view()->share('client_type', $client_type);
        view()->share('client_id', $client_id);
        view()->share('notifications', $notifications);
        \JavaScript::put([
            'client_type' => $client_type,
            'client_id' => $client_id,
        ]);

        return $next($request);
    }
}
