<?php

namespace App\Helpers;

class AppHelper
{

    public function sendMessage($msg, $phone)
    {
        $requestParams = array(
            'route' => '1',
            'username' => '8870050001',
            'password' => 'welcome*85',
            'senderid' => 'MSUPLY',
            'number' => $phone,
            'message' => $msg
        );
        //merge API url and parameters
        $apiUrl = 'http://api.onhandsms.com/api/v2/sendsms?';
        foreach ($requestParams as $key => $val) {
            $apiUrl .= $key . '=' . urlencode($val) . '&';
        }
        $apiUrl = rtrim($apiUrl, "&");

        //API call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_exec($ch);
        curl_close($ch);

        return true;
    }
    public static function instance()
    {
        return new AppHelper();
    }
}
