<?php

namespace App\Http\Controllers\Api\Driver\V1;

use App\Domains\Driver\v1\Services\DriverAccessService;
use App\Domains\Driver\v1\Services\DriverService;
use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Driver\DriverPasswordRegisterRequest;
use App\Http\Requests\OtpLoginRequest;
use App\Http\Requests\Driver\UserPasswordRegisterRequest;
use App\Http\Requests\VerifyLoginOtpRequest;
use App\Http\Resources\Driver\AuthDriverData;
use Illuminate\Http\Request;


class PasswordController extends ApiController
{
    private DriverAccessService $accessService;
    private DriverService $driverService;
    private OtpServiceContract $otpService;

    public function __construct(
        DriverAccessService $accessService,
        DriverService       $driverService,
        OtpServiceContract  $otpService
    )
    {
        $this->accessService = $accessService;
        $this->driverService = $driverService;
        $this->otpService = $otpService;

    }

    public function resetPasswordOtp(OtpLoginRequest $request)
    {
        $phone = $this->driverService->getRequestPhone($request);
        $driver = $this->driverService->getDriverByPhone($phone);
        if (!$driver) {
            return $this->failResourceNotFoundMessage('Driver');
        }
        $opt_is_sent = $this->otpService->sendOtp($driver->phone);
        if ($opt_is_sent) {
            return $this->successGeneralMessage(__('auth.otp_sent_successfully'));
        } else {
            return $this->failGeneralMessage('auth.otp_sending_failed');
        }
    }

    public function verifyResetPasswordOtp(VerifyLoginOtpRequest $request)
    {
        $phone = $this->driverService->getRequestPhone($request);
        $driver = $this->driverService->getDriverByPhone($phone);
        if (!$driver) {
            return $this->failResourceNotFoundMessage('Driver');
        }
        $isVerified = $this->accessService->loginViaOtp($request, $driver);
        if ($isVerified) {
            $token = $driver->createToken('UserAPi')->plainTextToken;
            $data = (new AuthDriverData($driver))->token($token);
            return $this->successShowDataResponse($data, 'login');
        } else {
            $errors = ['otp' => __('auth.invalid_otp')];
            return $this->failValidationMessage($errors);
        }
    }

    public function passwordReset(Request $request)
    {
        $driver = $this->driverService->getAuthDriver('sanctum-driver');
        $updated_user = $this->driverService->passwordReset($driver,$request->password);
        if ($updated_user) {
            return $this->successUpdateNoContentResponse();
        } else {
            return $this->failGeneralMessage();
        }
    }


}
