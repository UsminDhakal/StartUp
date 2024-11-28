<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_role == 1) {
                return $next($request);
            } else {
                return redirect()->route('welcome')->with('confirm_toast', [
                    'type' => 'error',
                    'title' => 'You went on wrong address.',
                ]);
            }
        } else {
            return redirect()->route('login')->with('info_toast', [
                'type' => 'error',
                'title' => 'Login First',
            ]);
        }
    }
}
