<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SmsRequest;
use App\Http\Resources\BeneficiariesResource;
use App\Http\Services\SmsService;
use App\Models\Beneficiaries;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    private SmsService $smsService;

    public function __construct()
    {
        $this->smsService = new SmsService();
    }
    
    public function login(LoginRequest $loginRequest)
    {
        $beneficiaries = $this->fetchUserByPhone($loginRequest->input('phone'));
        $this->smsService->sendOTPMessage($beneficiaries);

        return $this->apiResponse(trans('api/auth.send_message_login'), false, Response::HTTP_OK);
    }
    

    public function validateOTP(SmsRequest $smsRequest)
    {
        $beneficiaries = $this->fetchUserByPhone($smsRequest->input('phone'));
        $sms = $beneficiaries->getLastSms();

        if ($this->validateExpireOTP($sms, $smsRequest->input('sms'))) {
            $this->revokeToken($beneficiaries);
            $this->createBalanceIfNotExists($beneficiaries);
            return $this->apiResponse(trans('api/auth.login_successfully'), false, Response::HTTP_OK, new BeneficiariesResource($beneficiaries));
        }

        return $this->apiResponse(trans('api/auth.un_successfully_login'), false, Response::HTTP_BAD_REQUEST);
    }


    private function validateExpireOTP(Sms $sms, $code)
    {
        if (!(\Hash::check($code, $sms->sms))) {
            return false;
        }


        if (!($sms->expires_at->gte(now()))) {
            return false;
        }

        if ($sms->validated_at) {
            return false;
        }

        $sms->update(['validated_at' => now()]);

        return true;
    }

    private function fetchUserByPhone($phone)
    {
        return Beneficiaries::query()->where('phone', $phone)->firstOrFail();
    }

    private function revokeToken(Beneficiaries $beneficiaries)
    {
        return $beneficiaries->tokens()->delete();
    }

    private function createBalanceIfNotExists(Beneficiaries $beneficiaries)
    {
        if(! $beneficiaries->balance) {
            return $beneficiaries->balance()->create([
                'amount' => 0,
            ]);
        }
    }

}
