<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Symfony\Component\HttpFoundation\Response;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {   
        \Log::debug('User:', [Auth::user()]);
        \Log::debug('Request URL: ' . $request->url()); // Ghi lại URL của yêu cầu
        \Log::debug('User authenticated: ' . (Auth::check() ? 'Yes' : 'No')); // Kiểm tra xem người dùng đã đăng nhập chưa
        \Log::debug('Session data: ', session()->all());
        if($request ->is('admin/*') && !Auth::check()){
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized', 'error' => 'User is not logged in.'], 401);
            }
            return redirect()->route('admin.auth.login');
        }
        return $next($request);
        
    }
}
