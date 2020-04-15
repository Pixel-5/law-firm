<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleUser
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
        if (Auth::user() &&  !empty(Auth::user()->roles)) {

            $roles = collect(Auth::user()->roles);
            $results = $roles->whereInStrict('title',[$this->className()]);

            if (empty($results->all())) {
                abort(401);
            }
        }
        return $next($request);
    }

    protected function className()
    {
        return class_basename($this);
    }
}
