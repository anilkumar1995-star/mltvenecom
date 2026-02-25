<?php

namespace App\Services;

use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Log;

class IpaymentsKycService
{
    protected $baseUrl;
    protected $authKey;
    protected $authSecret;
    protected $header = [];

    public function __construct()
    {
        $getApiCred = ApiHelper::CheckServiceStatus('iydaaeps');

        if ($getApiCred['status']) {
            $this->authKey    = @$getApiCred['apidata']['username'];
            $this->authSecret = @$getApiCred['apidata']['password'];
            $this->baseUrl    = @$getApiCred['apidata']['url'];
            $this->header     = [
                "Content-Type: application/json",
                "Authorization: Basic " . base64_encode("$this->authKey:$this->authSecret")
            ];
        }
    }

    /**
     * Set full URL based on method name.
     */
    public function setFullUrl($method)
    {
        if ($method == 'initiateKyc')
            return $this->baseUrl . '/v1/service/aeps/kyc';
        else if ($method == 'checkKycStatus')
            return $this->baseUrl . '/v1/service/aeps/kyc/';

        return "";
    }

    /**
     * Initiate Digio Video KYC for a vendor.
     */
    public function initiateKyc($name, $email, $mobile, $latitude = '28.6139', $longitude = '77.2090')
    {
        $fullURL = $this->setFullUrl('initiateKyc');

        $parameters = [
            'mobile'    => $mobile,
            'name'      => $name,
            'email'     => $email,
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ];

        // Using ApiHelper::curl
        $result = ApiHelper::curl($fullURL, "POST", json_encode($parameters), $this->header, "yes", "IPay-KYC", $mobile);

        Log::info('iPayments KYC Initiate Response', ['response' => $result['response']]);

        $data = json_decode($result['response'], true);

        if (isset($data['status']) && $data['status'] === 'SUCCESS') {
            return [
                'success' => true,
                'url'     => @$data['data']['url'],
                'kid'     => @$data['data']['kid'],
                'message' => @$data['message'],
            ];
        }

        return [
            'success' => false,
            'message' => @$data['message'] ?? 'KYC initiation failed',
        ];
    }

    /**
     * Check KYC status for a given KID.
     */
    public function checkKycStatus($kid)
    {
        $fullURL = $this->setFullUrl('checkKycStatus') . $kid;

        $result = ApiHelper::curl($fullURL, "GET", json_encode([]), $this->header, "yes", "IPay-KYC-Status", $kid);

        $data = json_decode($result['response'], true);

        if (isset($data['status'])) {
            $kycStatus = 'failure';
            if ($data['status'] === 'SUCCESS') $kycStatus = 'success';
            if ($data['status'] === 'PENDING') $kycStatus = 'pending';

            return [
                'success'          => true,
                'status'           => $kycStatus,
                'kyc_data'         => @$data['data']['kyc'],
                'merchant_details' => @$data['data']['merchantDetails'],
                'message'          => @$data['message'],
            ];
        }

        return [
            'success' => false,
            'status'  => 'failure',
            'message' => @$data['message'] ?? 'Unknown response',
        ];
    }
}
