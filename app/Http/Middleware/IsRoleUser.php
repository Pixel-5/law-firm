<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::user() &&  !empty(Auth::user()->roles)) {

            $roles = collect(Auth::user()->roles);
            $results = $roles->whereInStrict('title',[$role]);

            if (empty($results->all()))
                abort(401);
        }
        return $next($request);
    }
}
