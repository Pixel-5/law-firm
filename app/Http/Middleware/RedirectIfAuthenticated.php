<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Gate;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch (Auth::user()->roles){
                case 'Admin':
                    return redirect()->route(RouteServiceProvider::ADMIN);

                case 'Lawyer':
                    return redirect()->route(RouteServiceProvider::LAWYER);

                case 'SuperAdmin':
                    return redirect()->route(RouteServiceProvider::SUPER);

                default:
                    Auth::logout();
                    abort_if(Gate::denies('system_access'),
                        Response::HTTP_UNAUTHORIZED);

            }
        }

        return $next($request);
    }
}
