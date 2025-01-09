<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        if (Auth::user()->status != 1) {
            return redirect()->route('admin.login')->with('error', 'Tài khoản của bạn chưa được kích hoạt!');
        }
        // if (Auth::user()->role != 0)
        if(!in_array(Auth::user()->role, [0, 1]))
        {
            return redirect()->route('admin.login')->with('error', 'Tài khoản đăng nhập không đủ quyền!');
        }
        
        return $next($request);
    }
    public function client(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('home.modal.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        if (Auth::user()->status != 1) {
            return redirect()->route('home.modal.login')->with('error', 'Tài khoản của bạn chưa được kích hoạt!');
        }
        // if (Auth::user()->role != 0)
        if(!in_array(Auth::user()->role, [2, 3]))
        {
            return redirect()->route('home.modal.login')->with('error', 'Tài khoản không tồn tại!');
        }
        return $next($request);
    }
}
