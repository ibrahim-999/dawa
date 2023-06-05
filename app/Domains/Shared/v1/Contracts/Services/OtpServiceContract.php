<?php

namespace App\Domains\Shared\v1\Contracts\Services;

interface OtpServiceContract
{
    /**
     * check for a fake otp
     * @param string $phone
     * @param string $otp
     * @return bool
     */
    public static function verifyOtp(string $phone,string $otp):bool;


    /**
     * send fake otp response
     * @param string $phone
     * @return bool
     */
    public static function sendOtp(string $phone):bool;

}
