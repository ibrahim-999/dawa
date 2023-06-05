<?php

namespace App\Domains\Shared\v1\Services\Otp;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;

class OtpService implements OtpServiceContract
{

    public static function verifyOtp(string $phone, string $otp): bool
    {
        // TODO: Implement verifyOtp() method.
    }

    public static function sendOtp(string $phone): bool
    {
        // TODO: Implement sendOtp() method.
    }
}
