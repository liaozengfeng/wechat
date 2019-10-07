<?php

namespace App\Http\Middleware;

use Closure;

class IndexLogin
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
        if (empty(session("userinfo"))){
            return redirect("/index/login");
        }
        return $next($request);
    }
}
