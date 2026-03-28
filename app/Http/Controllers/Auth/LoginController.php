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

        $isAdminLogin = $request->is('admin/*') || $request->routeIs('admin.login');

        if ($isAdminLogin) {
            // ADMIN LOGIN ATTEMPT (users table)
            if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
                $user = Auth::guard('web')->user();
                
                if ($user->role === 'admin') {
                    $request->session()->regenerate();
                    if ($request->wantsJson()) {
                        return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
                    }
                    return redirect()->intended(route('admin.dashboard'));
                } else {
                    Auth::guard('web')->logout();
                    $msg = 'This login is for administrators only.';
                    if ($request->wantsJson()) {
                        return response()->json(['error' => true, 'message' => $msg], 403);
                    }
                    return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => $msg]);
                }
            }
        } else {
            // FRONTEND LOGIN ATTEMPT (Customer + Vendor both from ec_customers)
            if (Auth::guard('customer')->attempt($this->credentials($request), $request->filled('remember'))) {
                $customer = Auth::guard('customer')->user();

                // Check if account is activated
                if ($customer->status !== 'activated') {
                    Auth::guard('customer')->logout();
                    $msg = 'Your account is pending approval.';
                    if ($request->wantsJson()) {
                        return response()->json(['error' => true, 'message' => $msg], 403);
                    }
                    return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => $msg]);
                }

                $request->session()->regenerate();

                // Redirect both vendor and customer to ONLY customer dashboard for now
                $redirect = route('frontend.customer.dashboard');

                if ($request->wantsJson()) {
                    return response()->json(['success' => true, 'redirect' => $redirect]);
                }
                return redirect()->intended($redirect);
            }

            // Fallback: Try Web Guard for legacy vendor accounts still in users table
            if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
                $user = Auth::guard('web')->user();

                // Block Admin from logging in via frontend customer page
                if ($user->role === 'admin') {
                    Auth::guard('web')->logout();
                    $msg = 'Administrators must log in via the admin portal.';
                    if ($request->wantsJson()) {
                        return response()->json(['error' => true, 'message' => $msg], 403);
                    }
                    return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => $msg]);
                }

                // Check for Vendor/User approval
                if ($user->status !== 'active') {
                    Auth::guard('web')->logout();
                    $msg = 'Your account is pending approval.';
                    if ($request->wantsJson()) {
                        return response()->json(['error' => true, 'message' => $msg], 403);
                    }
                    return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => $msg]);
                }

                $request->session()->regenerate();
                if ($request->wantsJson()) {
                    return response()->json(['success' => true, 'redirect' => route('frontend.customer.dashboard')]);
                }
                return redirect()->intended(route('frontend.customer.dashboard'));
            }
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
        // 1. Customer Guard (customers + vendors from ec_customers)
        if (auth()->guard('customer')->check()) {
            return redirect()->route('frontend.customer.dashboard');
        }

        // 2. Web Guard (admin only)
        if (auth()->guard('web')->check()) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
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
        $this->middleware('guest:web,customer')->except('logout');
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
        // Logout from web guard (admin)
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        // Logout from customer guard (customer + vendor)
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home page
        return redirect('/');
    }

}
