<?php

namespace App\Domains\Driver\v1\Services;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\Auth\OtpAccessService;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DriverAccessService
{
    private Model $driverModel;
    private DriverService $driverService;
    private OtpServiceContract $otpService;
    private OtpAccessService $otpAccessService;

    public function __construct(
        Driver             $driverModel,
        DriverService      $driverService,
        OtpServiceContract $otpService,
        OtpAccessService   $otpAccessService
    )
    {
        $this->driverModel = $driverModel;
        $this->driverService = $driverService;
        $this->otpService = $otpService;
        $this->otpAccessService = $otpAccessService;
    }


    public function registerViaPassword(Request $request): ?Model
    {
        try {
            $phone = $this->driverService->getRequestPhone($request);
            $isVerified = $this->otpAccessService->verifyOtpAttempt($phone, $request->otp, $request);
            if (!$isVerified) {
                throw ValidationException::withMessages([
                    'otp' => __('auth.wrong_otp')
                ]);
            }
            return $this->driverService->registerDriver($request);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function loginViaOtp(Request $request): ?bool
    {
        try {
            $phone = $this->driverService->getRequestPhone($request);
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


    public function verifyPassword(Model $driver,$password): ?bool
    {
        try {
            return Hash::check($password, $driver->password);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function logout(Driver $driver): ?bool
    {
        try {
            $driver->currentAccessToken()->delete();
            return true;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function verifyProfilePhone(Request $request): ?bool
    {
        try {
            $phone = $this->driverService->getRequestPhone($request);
            $isVerified = $this->otpAccessService->verifyOtpAttempt($phone, $request->otp, $request);
            if (!$isVerified) {
                throw ValidationException::withMessages([
                    'otp' => __('auth.wrong_otp')
                ]);
            }
            return $isVerified;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
