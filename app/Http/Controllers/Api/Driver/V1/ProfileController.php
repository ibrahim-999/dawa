<?php

namespace App\Http\Controllers\Api\Driver\V1;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Driver\v1\Services\DriverAccessService;
use App\Domains\Driver\v1\Services\DriverService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Driver\CompleteProfileStepOneRequest;
use App\Http\Requests\Driver\CompleteProfileStepThreeRequest;
use App\Http\Requests\Driver\CompleteProfileStepTwoRequest;
use App\Http\Requests\Driver\DriverProfileVerificationRequest;
use App\Http\Requests\Driver\UpdateDriverAvailablityRequest;
use App\Http\Resources\Driver\AuthDriverData;

use function PHPUnit\Framework\isNull;

class ProfileController extends ApiController
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

    /**
     * complete profile step one.
     */
    public function CompleteProfileStepOne(CompleteProfileStepOneRequest  $request)
    {
        $driver = $this->driverService->getAuthUser('sanctum-driver');
        $phone = $this->driverService->getRequestPhone($request);
        // dd($request->all());
        if ($phone != $driver->phone && !$request->otp) {
            $opt_is_sent = $this->otpService->sendOtp($phone);
            if ($opt_is_sent) {
                return $this->successًwithActionMessage(__('auth.otp_sent_successfully'));
            } else {
                return $this->failGeneralMessage('auth.otp_sending_failed');
            }
        }

        $profile = $this->driverService->CompleteProfileStepOne($driver, $request);

        if ($profile) {
            $data = (new AuthDriverData($driver));
            return $this->successShowDataResponse($data, 'Show');
        } else {
            return $this->failGeneralMessage();
        }

    }

    /**
     * complete profile step two.
     */
    public function CompleteProfileStepTwo(CompleteProfileStepTwoRequest  $request)
    {
        $driver = $this->driverService->getAuthUser('sanctum-driver');
        $profile = $this->driverService->CompleteProfileStepTwo($driver, $request);
        if ($profile) {
            $data = (new AuthDriverData($driver));
            return $this->successShowDataResponse($data, 'Show');
        } else {
            return $this->failGeneralMessage();
        }
    }

    /**
     * complete profile step two.
     */
    public function CompleteProfileStepThree(CompleteProfileStepThreeRequest  $request)
    {
        $driver = $this->driverService->getAuthUser('sanctum-driver');
        $profile = $this->driverService->CompleteProfileStepThree($driver, $request);
        if ($profile) {
            $data = (new AuthDriverData($driver));
            return $this->successShowDataResponse($data, 'Show');
        } else {
            return $this->failGeneralMessage();
        }
    }

    /**
     * verify phone number.
     */    
    public function verifyProfileOtp(DriverProfileVerificationRequest $request)
    {
        $verified = $this->accessService->verifyProfilePhone($request);
        if ($verified) {
            return $this->successUpdateNoContentResponse();
        } else {
            $errors = ['otp' => __('auth.invalid_otp')];
            return $this->failValidationMessage($errors);
        }
    }

    /**
     * complete profile step two.
     */
    public function updateDriverAvailability(UpdateDriverAvailablityRequest  $request)
    {
        $driver = $this->driverService->getAuthUser('sanctum-driver');

        $profileSetting = $this->driverService->updateDriverAvailability($driver, $request);
        
        if ($profileSetting) {
            $data = (new AuthDriverData($driver));
            return $this->successShowDataResponse($data, 'Show');
        } else {
            return $this->failGeneralMessage();
        }
    }
    
}
