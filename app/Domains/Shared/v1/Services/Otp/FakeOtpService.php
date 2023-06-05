<?php

namespace App\Domains\Shared\v1\Services\Otp;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;

class FakeOtpService implements OtpServiceContract
{
    /**
     * check for a fake otp
     * @param string $phone
     * @param string $otp
     * @return bool
     */
    public static function verifyOtp(string $phone,string $otp):bool
    {
        //TODO:Take fake otp from config file
        if ($otp == '3690')
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * send fake otp response
     * @param string $phone
     * @return bool
     */
    public static function sendOtp(string $phone):bool
    {
        return true;
    }

}
