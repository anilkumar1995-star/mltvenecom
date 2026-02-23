<?php

namespace App\Helpers;

use App\Models\Api;
use App\Models\ApiLog;
use Illuminate\Support\Facades\Log;

class ApiHelper
{
    /**
     * Check service status and get API credentials by code.
     *
     * @param string $code - The API code from apis table
     * @return array ['status' => bool, 'apidata' => [...]]
     */
    public static function CheckServiceStatus($code)
    {
        try {
            $api = Api::where('code', $code)->where('status', 1)->first();

            if (!$api) {
                return [
                    'status'  => false,
                    'message' => "API service '{$code}' not found or disabled.",
                    'apidata' => [],
                ];
            }

            return [
                'status'  => true,
                'message' => 'Service active',
                'apidata' => $api->toArray(),
            ];
        } catch (\Exception $e) {
            Log::error('CheckServiceStatus failed', ['code' => $code, 'error' => $e->getMessage()]);
            return [
                'status'  => false,
                'message' => $e->getMessage(),
                'apidata' => [],
            ];
        }
    }

    /**
     * Standard cURL method with apilog logging.
     */
    public static function curl($url, $method, $parameters, $header, $log = 'no', $modal = 'none', $txnid = 'none')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_TIMEOUT, 180);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        if ($parameters != '') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
        }

        if (is_array($header) && count($header) > 0) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Log to apilogs table
        if ($log != 'no') {
            ApiLog::create([
                'url'      => $url,
                'modal'    => $modal,
                'txnid'    => $txnid,
                'header'   => json_encode($header),
                'request'  => is_array($parameters) ? json_encode($parameters) : $parameters,
                'response' => $response,
            ]);
        }

        return ['response' => $response, 'error' => $err, 'code' => $code];
    }
}
