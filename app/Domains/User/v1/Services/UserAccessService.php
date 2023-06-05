<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\Auth\OtpAccessService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class UserAccessService
{
    private Model $userModel;
    private UserService $userService;
    private OtpServiceContract $otpService;
    private OtpAccessService $otpAccessService;

    public function __construct(
        User               $userModel,
        UserService      $userService,
        OtpServiceContract $otpService,
        OtpAccessService   $otpAccessService
    )
    {
        $this->userModel = $userModel;
        $this->userService = $userService;
        $this->otpService = $otpService;
        $this->otpAccessService = $otpAccessService;
    }

    public function registerViaOtp(Request $request): ?Model
    {
        try {
            $phone = $this->userService->getRequestPhone($request);
            $isVerified = $this->otpAccessService->verifyOtpAttempt($phone, $request->otp, $request);
            if (!$isVerified) {
                throw ValidationException::withMessages([
                    'otp' => __('auth.wrong_otp')
                ]);
            }
            return $this->userService->addUser($request);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function loginViaOtp(Request $request): ?bool
    {
        try {
            $phone = $this->userService->getRequestPhone($request);
            $isVerified = $this->otpAccessService->verifyOtpAttempt($phone, $request->otp, $request);
            if (!$isVerified) {
                throw ValidationException::withMessages([
                    'otp' => __('auth.wrong_otp')
                ]);
            }
            return true;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function logout(User $user, $type = 'api'): ?bool
    {
        try {
            if ($type == 'api') {
                $user->currentAccessToken()->delete();
            } else {
                //TODO:auth in web
            }
            return true;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
