<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\Customer;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();
        $broker = 'users';

        if (!$user) {
            $user = Customer::where('email', $request->email)->first();
            $broker = 'customers';
        }

        if (!$user) {
            return back()->withErrors(['email' => trans('passwords.user')]);
        }

        $token = Password::broker($broker)->createToken($user);
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);

        try {
            $html = view('auth.emails.password-reset', [
                'user' => $user,
                'resetUrl' => $resetUrl,
                'appName' => 'iPaymnt Tech'
            ])->render();

            CommonHelper::sendZohoEmail($user->email, 'Reset Password Notification', $html);

            return back()->with('status', trans('passwords.sent'));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset link. Please try again later.']);
        }
    }
}
