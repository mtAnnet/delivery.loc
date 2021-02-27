<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUser
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
        if ((!Auth::check()) ||( Auth::check() && Auth::user()->isNotAdmin())) {
            return $next($request);
        }
        return redirect('/admin');
//        if (Auth::check() && Auth::user()->isUser()) {
//            return $next($request);
//        }
//        return redirect('/');
    }
}
