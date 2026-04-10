<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\Customer;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    /**
     * Display the password reset view for the given token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->input('email');
        $broker = $this->broker();

        // Check if token exists for this email
        if (!$broker->tokenExists($this->getUserByEmail($email), $token)) {
            return redirect()->route('password.request')
                ->with('error', 'This password reset link is invalid or has expired. Please request a new one.');
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

    /**
     * Get the user for the given email.
     *
     * @param  string  $email
     * @return \Illuminate\Contracts\Auth\CanResetPassword|null
     */
    protected function getUserByEmail($email)
    {
        return \App\Models\User::where('email', $email)->first() 
               ?? \App\Models\Customer::where('email', $email)->first();
    }

    protected function sendResetResponse(Request $request, $response)
    {
        Auth::logout();
        
        return redirect($this->redirectPath())
            ->with('status', 'Your password has been reset successfully! You can now login with your new password.');
    }

    public function broker()
    {
        $email = request()->input('email');
        if (Customer::where('email', $email)->exists()) {
            return Password::broker('customers');
        }
        return Password::broker('users');
    }
}
