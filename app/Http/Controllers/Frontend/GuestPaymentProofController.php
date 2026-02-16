<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class GuestPaymentProofController extends Controller
{
    private function getOrder(string $token): Order
    {
        abort_if(strlen($token) < 10, 404);

        $key = 'payment-proof:' . request()->ip();

        abort_if(
            RateLimiter::tooManyAttempts($key, 10),
            Response::HTTP_TOO_MANY_REQUESTS,
            'Too many attempts'
        );

        RateLimiter::hit($key, 60);

        $order = Order::where('token', $token)->first();
        abort_unless($order, 404);

        return $order;
    }

    public function upload(string $token, Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $order = $this->getOrder($token);

        // old file delete
        if ($order->proof_file) {
            Storage::disk('public')->delete($order->proof_file);
        }

        $path = $request->file('file')->store('proofs', 'public');

        $order->update([
            'proof_file' => $path,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Proof uploaded successfully',
        ]);
    }

    public function download(string $token)
    {
        $order = $this->getOrder($token);

        abort_unless($order->proof_file, 404);

        return Storage::disk('public')->download($order->proof_file);
    }
}
