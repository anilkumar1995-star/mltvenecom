<?php

namespace App\Services;

use App\Helpers\AndroidCommonHelper;
use App\Helpers\Permission;
use App\Models\Agents;
use App\Models\Api;
use Illuminate\Support\Facades\Log;
use Exception;

class EcommercePaymentService
{
    public function __construct()
    {
        // Constructor left empty or can be used for general initialization
    }

    /**
     * Initialize payment gateway collect request
     */
    public function initiatePayment($user, $amount, $clientRefId)
    {
        $getApiCred = AndroidCommonHelper::CheckServiceStatus('rrpayment');

        if (!$getApiCred['status']) {
            return ['response' => '', 'error' => 'PG service is down or inactive', 'code' => 500];
        }

        $api = $getApiCred['apidata'];

        $url = rtrim($api->url, '/') . "/v1/service/pgcollect/order";
        $header = [
            "Content-Type: application/json",
            "Authorization: Basic " . base64_encode($api->username . ":" . $api->password)
        ];

        $reqData = [
            "email" => $user->email,
            "name" => $user->name,
            "merchantCode" => "MID73323213401",
            "clientRefId" => $clientRefId,
            "mobile" => $user->phone ?? $user->mobile ?? '',
            "redirectUrl" => route('frontend.checkout.payment.callback'),
            "successUrl" => route('frontend.checkout.payment.callback'),
            "failedUrl" => route('frontend.checkout.index'),
            "amount" => $amount
        ];

        $curl = Permission::curl($url, "POST", json_encode($reqData), $header, "yes", "pg_collect", $clientRefId);
        return $curl;
    }

    /**
     * Check transaction status from payment gateway
     */
    public function checkPaymentStatus($clientRefId)
    {
        $getApiCred = AndroidCommonHelper::CheckServiceStatus('orpayment');
        if (!$getApiCred['status']) {
            return ['response' => '', 'error' => 'API source not found', 'code' => 404];
        }

        $api = $getApiCred['apidata'];
        $url = rtrim($api->url, '/') . '/v1/service/paycc/order/' . $clientRefId;
        $auth = base64_encode(trim($api->username) . ":" . trim($api->password));

        $header = [
            "Content-Type: application/json",
            "Authorization: Basic " . $auth
        ];

        return Permission::curl($url, "GET", "", $header, "yes", "payment_status_check", $clientRefId);
    }
}
