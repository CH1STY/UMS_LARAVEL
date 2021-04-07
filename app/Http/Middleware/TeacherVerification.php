<?php

namespace App\Http\Middleware;

use Closure;

class TeacherVerification
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
        if($request->session()->get('usertype')=='teacher'){
            return $next($request);
        }
        else{
            $request->session()->flash('teacher', 'It is Teacher Section');
            return redirect('/teacher');
        }
    }
}
