<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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

        if($request->path() !=='login'){
//            print_r($request);
            if($request->_token === ''){
                return redirect('login');
            }
        }
        return $next($request);
    }
}
