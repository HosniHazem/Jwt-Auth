<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->RoleID == '1') //0=user , 1=admin
            {
                return $next($request);
            }
            else
            {
                return redirect('http://localhost:3000/')->with('status', 'Access Denied!');
            }
        }
        else
            {
                return redirect('http://localhost:3000/')->with('status', 'Login first!');
            }

    }
}
