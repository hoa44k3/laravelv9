<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckCTV
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }
    // public function handle($request, Closure $next)
    // {
    //     if (Auth::check() && Auth::user()->role === 'ctv') {
    //         return $next($request);
    //     }

    //     // return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập.');
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            return $next($request);  
        }

          //return redirect()->route('index')->with('error', 'Bạn không có quyền truy cập.');
          return $next($request);  
    }
}
