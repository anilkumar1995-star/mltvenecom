<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\IpaymentsKycService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'type'          => ['required', 'string', 'in:customer,vendor'],
            'shop_name'     => ['required_if:type,vendor', 'nullable', 'string'],
            'website'       => ['nullable', 'string'],
            'mobile'        => ['required_if:type,vendor', 'nullable', 'string'],
            'pan_number'    => ['required_if:type,vendor', 'nullable', 'string'],
            'aadhar_number' => ['required_if:type,vendor', 'nullable', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'role'          => $data['type'],
            'password'      => Hash::make($data['password']),
            'shop_name'     => $data['shop_name'] ?? null,
            'website'       => $data['website'] ?? null,
            'mobile'        => $data['mobile'] ?? null,
            'pan_number'    => $data['pan_number'] ?? null,
            'aadhar_number' => $data['aadhar_number'] ?? null,
            'status'        => $data['type'] === 'vendor' ? 'pending' : 'active',
            'is_approved'   => $data['type'] === 'vendor' ? false : true,
        ]);
    }

    /**
     * Handle the registration result.
     */
    protected function registered(Request $request, $user)
    {
        if ($user->role === 'vendor') {
            $kycService = new IpaymentsKycService();

            $kycResult = $kycService->initiateKyc(
                $user->name,
                $user->email,
                $user->mobile,
                $request->input('latitude', '28.6139'),
                $request->input('longitude', '77.2090')
            );

            if ($kycResult['success'] && !empty($kycResult['url'])) {
                $user->update([
                    'kyc_kid'    => $kycResult['kid'],
                    'kyc_url'    => $kycResult['url'],
                    'kyc_status' => 'pending',
                ]);
                return redirect($kycResult['url']);
            } else {
                Log::error('KYC Initiation Failed', ['user_id' => $user->id, 'error' => $kycResult['message']]);
                return redirect()->route('register')->with('error', 'KYC Error: ' . ($kycResult['message'] ?? 'Could not generate Digio link.'));
            }
        }

        return redirect($this->redirectTo);
    }
}
