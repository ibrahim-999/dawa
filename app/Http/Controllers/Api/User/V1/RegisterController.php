<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\FirebaseDeviceTokenService;
use App\Domains\Shared\v1\Services\PointService;
use App\Domains\User\v1\Services\UserAccessService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\User\OtpRegisterRequest;
use App\Http\Requests\User\UserOtpRegisterRequest;
use App\Http\Resources\User\AuthUserData;
use App\Notifications\WelcomeNotification;

class RegisterController extends ApiController
{
    private UserAccessService $accessService;
    private UserService $userService;
    private OtpServiceContract $otpService;
    private FirebaseDeviceTokenService $firebaseDeviceTokenService;
    private PointService $pointService;
    
    public function __construct(
        UserAccessService  $accessService,
        UserService        $userService,
        OtpServiceContract $otpService,
        FirebaseDeviceTokenService $firebaseDeviceTokenService,
        PointService $pointService
    )
    {
        $this->accessService = $accessService;
        $this->userService = $userService;
        $this->otpService = $otpService;
        $this->firebaseDeviceTokenService = $firebaseDeviceTokenService;
        $this->pointService = $pointService;

    }

    public function otpRegister(OtpRegisterRequest $request)
    {
        $phone = $this->userService->getRequestPhone($request);
        $opt_is_sent = $this->otpService->sendOtp($phone);
        if ($opt_is_sent) {
            return $this->successGeneralMessage(__('auth.otp_sent_successfully'));
        } else {
            return $this->failGeneralMessage('auth.otp_sending_failed');
        }
    }

    public function verifyRegisterOtp(UserOtpRegisterRequest $request)
    {
        $user = $this->accessService->registerViaOtp($request);
        if ($user) {
            $token = $user->createToken('UserAPi')->plainTextToken;
            $this->firebaseDeviceTokenService->assignDeviceTokenToUser($request,$user);
            $data = (new AuthUserData($user))->token($token);
            $user->notify((new WelcomeNotification)->delay([
                'mail' => now()->addMinutes(5)
            ]));
            $this->pointService->givePointToUserOnAction($user,'register');
            return $this->successShowDataResponse($data, 'login');
        } else {
            $errors = ['otp' => __('auth.invalid_otp')];
            return $this->failValidationMessage($errors);
        }
    }


}
