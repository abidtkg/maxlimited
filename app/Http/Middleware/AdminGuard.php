<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (!Auth::user()) {
            return redirect()->route('login');
        } else if (Auth::user()->user_type == 'admin') {
            return $next($request);
        } else if (Auth::user()->user_type == 'client') {
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
}
