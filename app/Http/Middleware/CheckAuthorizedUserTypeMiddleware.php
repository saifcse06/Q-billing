<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthorizedUserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$userType)
    {

        if($userType!=auth()->user()->type)
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
