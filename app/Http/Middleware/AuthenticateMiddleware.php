<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
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
        // if (Auth::id() == null) {
        //     return redirect()->route('auth.login')->with('error', 'Bạn phải đăng nhập 
        //     để sử dụng chức năng này');
        // }
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Admin được phép truy cập
        }
        //return redirect()->route('index')->with('error', 'Bạn không có quyền truy cập.');
        return $next($request);
    }
}
