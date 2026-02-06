<?php

namespace Botble\ACL\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if ($request->is('/') || $request->route()->getName() == 'home' || $request->route()->getName() == 'frontend.home') {
            return $next($request);
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                if ($guard === 'customer') {
                     return redirect(route('frontend.customer.dashboard'));
                }

                if ($guard === 'web' || $guard === null) {
                    if ($user->role === 'admin') {
                        return redirect(route('home'));
                    }
                    // For vendors and customers in users table
                    return redirect(route('frontend.customer.dashboard'));
                }
                
                return redirect('/');
            }
        }

        return $next($request);
    }
}
