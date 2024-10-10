<?php

namespace App\Services;

class Smsc
{

    public static function sendSms($phone, $message)
    {
        $login = env('REDSMS_LOGIN');
        $apiKey = env('REDSMS_APIKEY');
        $ts = 'Cartel Project';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cp.redsms.ru/api/message');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'login: ' . $login,
            'ts: ' . $ts,
            'secret: ' . md5($ts . $apiKey),
            'Content-type: application/json'
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'route' => 'sms',
            'from' => 'Cartel',
            'to' => '+7 926 944 2435',
            'text' => 'Привет, мир!'
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

//        $response_data = json_decode($response, true);
        return $response;
    }

}
