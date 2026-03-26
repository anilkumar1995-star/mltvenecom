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
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
            return redirect('/login')->with('error', 'Please login first.');
        }

        // Special case: 'vendor' role is stored as is_vendor = 1 on ec_customers table
        if ($role === 'vendor') {
            if (!$user->is_vendor) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Unauthorized.'], 403);
                }
                return redirect('/')->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        }

        // Generic role check (for users table with a 'role' column e.g. admin)
        if (!isset($user->role) || $user->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
