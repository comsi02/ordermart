<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithAdmin
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
        if (\Auth::user()->admin_yn == 'Y') {
            return $next($request);
        }
        return redirect('/');
    }
}
