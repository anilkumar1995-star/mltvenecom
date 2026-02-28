<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';

    public function home()
    {
        return view('frontend.home');
    }
    public function showLoginForm()
    {
        if (request()->is('admin/*') || request()->routeIs('admin.login')) {
            return view('auth-old.login');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard('customer')->attempt($this->credentials($request), $request->filled('remember'))) {
            $request->session()->regenerate();
            
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'redirect' => route('frontend.customer.dashboard')]);
            }
            // Customer -> frontend/customer/dashboard.blade.php
            return redirect()->intended(route('frontend.customer.dashboard'));
        }

        if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            if ($user->role === 'admin') {
                if ($request->wantsJson()) {
                    return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
                }
                return redirect()->intended(route('admin.dashboard'));
            }

            // Check for Vendor/User approval
            if ($user->status !== 'active') {
                Auth::guard('web')->logout();
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Your account is pending approval.'
                    ], 403);
                }
                return back()->withInput($request->only('email', 'remember'))
                             ->withErrors(['email' => 'Your account is pending approval.']);
            }

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'redirect' => route('frontend.customer.dashboard')]);
            }
            // Vendor/Others -> frontend/customer/dashboard.blade.php
            return redirect()->intended(route('frontend.customer.dashboard'));
        }

        $this->incrementLoginAttempts($request);
        
        if ($request->wantsJson()) {
            return response()->json([
                'error' => true,
                'message' => trans('auth.failed')
            ], 401);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        // 1. Customer Guard
        if (auth()->guard('customer')->check()) {
            return redirect()->route('frontend.customer.dashboard');
        }

        // 2. Web Guard
        if (auth()->guard('web')->check()) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.home');
            }
            // Vendor/Others -> Customer Dashboard
            return redirect()->route('frontend.customer.dashboard');
        }

        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function guard()
    {
        if (request()->is('admin/*')) {
            return Auth::guard('web');
        }
        return Auth::guard('customer');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Logout from web guard (admin/vendor)
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        // Logout from customer guard
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page
        // Redirect to home page
        return redirect('/');
    }

}
