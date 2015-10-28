<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleWare
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
        if ($request->user()->type != 'user')
        {
            abort(403,'Dear '.$request->user()->name.', You are not authorized to use this service');
        }
        return $next($request);
    }
}
