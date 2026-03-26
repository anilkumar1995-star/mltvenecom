<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\IpaymentsKycService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VendorKycController extends Controller
{
    public function index()
    {
        $user = auth('customer')->user();
        return view('frontend.vendor.kyc.index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pan_number' => 'required|string|min:10|max:10',
            'aadhar_number' => 'required|string|min:12|max:16',
        ]);

        $user = auth('customer')->user();
        
        // Update user documents
        $user->update([
            'pan_number' => $request->pan_number,
            'aadhar_number' => $request->aadhar_number,
            'kyc_status' => 'pending'
        ]);

        // Initiate KYC via Service
        $kycService = new IpaymentsKycService();

        $kycResult = $kycService->initiateKyc(
            $user->name,
            $user->email,
            $user->phone,
            $request->input('latitude', '28.6139'),
            $request->input('longitude', '77.2090')
        );

        if ($kycResult['success'] && !empty($kycResult['url'])) {
            $user->update([
                'kyc_kid' => $kycResult['kid'],
                'kyc_url' => $kycResult['url'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'KYC Initiated! Redirecting to verification...',
                'redirect_url' => $kycResult['url']
            ]);
        }

        Log::error('Dedicated KYC Initiation Failed', [
            'vendor_id' => $user->id,
            'error' => $kycResult['message'],
        ]);

        return response()->json([
            'status' => false,
            'message' => 'KYC Error: ' . ($kycResult['message'] ?? 'Could not initiate link. Please try again.')
        ], 422);
    }
}
