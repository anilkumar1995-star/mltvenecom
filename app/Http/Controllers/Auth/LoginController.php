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
    protected $redirectTo = '/home';

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
            // Customer -> frontend/customer/dashboard.blade.php
            return redirect()->intended(route('frontend.customer.dashboard'));
        }

        if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::guard('web')->user();
            
            if ($user->role === 'admin') {
                return redirect()->intended(route('home'));
            }

            // Vendor/Others -> frontend/customer/dashboard.blade.php
            return redirect()->intended(route('frontend.customer.dashboard'));
        }

        $this->incrementLoginAttempts($request);
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
                return redirect()->route('home');
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

}
