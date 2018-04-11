<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() === null){
            return response('Insuficient permissions', 401);
        }

        $roles = array(1,2);
        if(($request->user()->role == 1 || $request->user()->role == 2) || !$roles){
            return $next($request);
        }
        return redirect('/');
    }
}