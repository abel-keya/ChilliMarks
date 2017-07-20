<?php

namespace chilliapp\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $role)
    {   
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return redirect('/');
            } else {
                return redirect('/');
            }
        }

        if ($this->auth->guest() || ! $request->user()->hasRole($role)) {
            return redirect('/')->with('error', 'Sorry, You do not have rights to access that page! Kindly, contact your administrator for further access.');
        }

        return $next($request);
    }
}
