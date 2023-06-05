<?php

namespace App\Http\Controllers\Api\Driver\V1;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Driver\v1\Services\DriverAccessService;
use App\Domains\Driver\v1\Services\DriverService;
use App\Domains\Shared\v1\Services\FirebaseDeviceTokenService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Driver\RegisterWithPassRequest;
use App\Http\Requests\Driver\DriverPasswordRegisterRequest;
use App\Http\Resources\Driver\AuthDriverData;
use App\Notifications\WelcomeNotification;

class RegisterController extends ApiController
{
    private DriverAccessService $accessService;
    private DriverService $driverService;
    private OtpServiceContract $otpService;
    private FirebaseDeviceTokenService $firebaseDeviceTokenService;

    public function __construct(
        DriverAccessService $accessService,
        DriverService       $driverService,
        OtpServiceContract  $otpService,
        FirebaseDeviceTokenService  $firebaseDeviceTokenService
    )
    {
        $this->accessService = $accessService;
        $this->driverService = $driverService;
        $this->otpService = $otpService;
        $this->firebaseDeviceTokenService = $firebaseDeviceTokenService;

    }

    public function sendRegisterOtp(RegisterWithPassRequest $request)
    {
        $phone = $this->driverService->getRequestPhone($request);
        $opt_is_sent = $this->otpService->sendOtp($phone);
        if ($opt_is_sent) {
            return $this->successGeneralMessage(__('auth.otp_sent_successfully'));
        } else {
            return $this->failGeneralMessage('auth.otp_sending_failed');
        }
    }

    public function verifyRegisterOtp(DriverPasswordRegisterRequest $request)
    {
        $driver = $this->accessService->registerViaPassword($request);
        if ($driver) {
            $token = $driver->createToken('UserAPi')->plainTextToken;
            $this->firebaseDeviceTokenService->assignDeviceTokenToUser($request,$driver);
            $data = (new AuthDriverData($driver))->token($token);
            $driver->notify((new WelcomeNotification)->delay([
                'mail' => now()->addMinutes(5)
            ]));
            return $this->successShowDataResponse($data, 'login');
        } else {
            $errors = ['otp' => __('auth.invalid_otp')];
            return $this->failValidationMessage($errors);
        }
    }


}
