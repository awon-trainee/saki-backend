<?php

namespace App\Http\Services;

use App\Models\Beneficiaries;
use App\Models\Sms;
use App\Models\User;

class SmsService
{
    private $apiUrl = 'https://el.cloud.unifonic.com/rest/SMS/messages';

    private $appSid;


    /*
     * Initialize the connection with SMS
     * */
    public function __construct()
    {
        $this->appSid = config('app.unifonic.AppSid');
    }

    public function sendOTPMessage(Beneficiaries $beneficiaries)
    {
        $number = rand(1000 , 9999);
        // $number = 1111;
        $url = "$this->apiUrl?AppSid=$this->appSid&Body=Code is : $number&Recipient=$beneficiaries->phone";
        $response = \Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($url);

        $beneficiaries->sms()->create([
            'sms' => bcrypt($number),
            'type' => Sms::OTP,
            'expires_at' => now()->addMinutes(5),
        ]);
    }
}
