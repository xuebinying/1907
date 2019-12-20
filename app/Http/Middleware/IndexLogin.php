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
        //echo 123;
        $user=session('user'); //存储session
           // dd($user);
        if(!$user){
            return redirect('/login');//如果没有登录就跳回登录页面
        }
        return $next($request);
    }
}
