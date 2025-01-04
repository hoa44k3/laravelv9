<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra nếu người dùng đăng nhập và có vai trò phù hợp
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request); // Cho phép tiếp tục
        }

        // Nếu không, trả về trang 403 (cấm truy cập)
        abort(403, 'Bạn không có quyền truy cập.');
    }

}
