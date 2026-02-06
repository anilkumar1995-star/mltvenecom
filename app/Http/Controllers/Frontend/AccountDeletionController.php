<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AccountDeletionRequest;
use App\Models\CustomerDeletionRequest;
use App\Notifications\ConfirmDeletionRequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccountDeletionController extends Controller
{
    public function store(AccountDeletionRequest $request)
    {
        $user = Auth::guard('customer')->user();

        $deletionRequest = CustomerDeletionRequest::firstOrCreate([
            'customer_id' => $user->id,
        ], [
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone,
            'token' => Str::random(60),
            'status' => 'waiting_for_confirmation',
            'reason' => $request->input('reason'),
        ]);

        $user->notify(new ConfirmDeletionRequestNotification($deletionRequest));

        return back()->with('success', 'Account deletion request submitted. Please check your email to confirm.');
    }

    public function confirm($token)
    {
        $deletionRequest = CustomerDeletionRequest::where('token', $token)
            ->where('status', 'waiting_for_confirmation')
            ->firstOrFail();

        if (Auth::guard('customer')->check() && Auth::guard('customer')->id() !== $deletionRequest->customer_id) {
            abort(403);
        }

        $deletionRequest->update([
            'status' => 'confirmed',
            'confirmed_at' => Carbon::now(),
        ]);

        Auth::guard('customer')->logout();

        // Ideally invoke a job here to process deletion
        // CustomerDeleteAccountJob::dispatch($deletionRequest);

        return redirect()->route('login')->with('success', 'Your account deletion request has been confirmed.');
    }
}
