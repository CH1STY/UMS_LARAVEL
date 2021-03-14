<?php

namespace App\Http\Middleware;

use Closure;

class SessionVerification
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
        if($request->session()->has('username') && $request->session()->has('usertype'))
        {
            return $next($request);

        }
        else
        {
            $request->session()->flash('msg','Session Validation Error!');
            return redirect()->route('login');
        }
    }
}
