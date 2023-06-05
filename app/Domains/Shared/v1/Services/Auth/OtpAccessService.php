<?php

namespace App\Domains\Shared\v1\Services\Auth;

use App\Domains\Shared\v1\Contracts\Services\AccessSecurityServiceContract;
use App\Domains\Shared\v1\Contracts\Services\AccessServiceContract;
use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OtpAccessService implements AccessServiceContract
{
    private $securityService;
    private $otpService;

    public function __construct(AccessSecurityServiceContract $securityService, OtpServiceContract $otpService)
    {
        $this->securityService = $securityService;
        $this->otpService = $otpService;
    }

    public function verifyOtpAttempt(string $phone, string $otp, Request $request): ?bool
    {
        if ($this->securityService->ThrottlesCheck($request)) {
            throw ValidationException::withMessages([
                'phone' => __('auth.many_attempts_locked')
            ]);
        }
        $isVerified = $this->otpService->verifyOtp($phone, $otp);
        if (!$isVerified) {
            $this->securityService->IncrementAttempts($request);
            return false;
        }
        return true;
    }

}
