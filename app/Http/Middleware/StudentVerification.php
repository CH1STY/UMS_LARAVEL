<?php

namespace App\Http\Middleware;

use Closure;

class StudentVerification
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
        if($request->session()->get('usertype')=="student")
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
