<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithSalesman
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->salesman_yn == 'Y') {
            return $next($request);
        }
        return redirect('/');
    }
}
