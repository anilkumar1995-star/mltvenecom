<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        if (!$user) {
            $user = auth('customer')->user();
        }

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 200);
            }
            return redirect('/login')->with('error', 'Please login first.');
        }
        if ($role === 'vendor') {
            $user = $user ?: auth('customer')->user();
            if (!$user || !$user->is_vendor) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Unauthorized.'], 200);
                }
                return redirect('/')->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        }

        if (!isset($user->role) || $user->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 200);
            }
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
