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
        // echo 123;
        //存入用户登录时的session
        $user=session('user');
         //dd($user);
        if(!$user){
            return redirect('/login');
        }
        
        return $next($request);
    }
}
