<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\User\v1\Services\UserAccessService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\OtpLoginRequest;
use App\Http\Requests\VerifyLoginOtpRequest;
use App\Http\Resources\Driver\AuthDriverData;
use App\Http\Resources\User\AuthUserData;

class AuthController extends ApiController
{
    private UserAccessService $accessService;
    private UserService $userService;
    private OtpServiceContract $otpService;

    public function __construct(
        UserAccessService  $accessService,
        UserService        $userService,
        OtpServiceContract $otpService
    ) {
        $this->accessService = $accessService;
        $this->userService = $userService;
        $this->otpService = $otpService;
    }

    public function otpLogin(OtpLoginRequest $request)
    {
        $phone = $this->userService->getRequestPhone($request);
        $user = $this->userService->getUserByPhone($phone);
        if (!$user) {
            return $this->failResourceNotFoundMessage('User',__('messages.user_not_found'));
        }
        $opt_is_sent = $this->otpService->sendOtp($user->phone);
        if ($opt_is_sent) {
            return $this->successGeneralMessage(__('auth.otp_sent_successfully'));
        } else {
            return $this->failGeneralMessage('auth.otp_sending_failed');
        }
    }

    public function verifyLoginOtp(VerifyLoginOtpRequest $request)
    {
        $phone = $this->userService->getRequestPhone($request);
        $user = $this->userService->getUserByPhone($phone);
        if (!$user) {
            return $this->failResourceNotFoundMessage('User',__('messages.user_not_found'));
        }
        $isVerified = $this->accessService->loginViaOtp($request, $user);
        if ($isVerified) {
            $token = $user->createToken('UserAPi')->plainTextToken;
            $data = (new AuthUserData($user))->token($token);
            return $this->successShowDataResponse($data, 'login');
        } else {
            $errors = ['otp' => __('auth.invalid_otp')];
            return $this->failValidationMessage($errors);
        }
    }

    public function me()
    {
        $user = $this->userService->getAuthUser('sanctum');
        $data = (new AuthUserData($user));
        return $this->successShowDataResponse($data, 'Show');
    }

    public function logout()
    {
        $user = $this->userService->getAuthUser('sanctum');
        if ($this->accessService->logout($user)) {
            return $this->successGeneralMessage(__('auth.logged_out_successfully'));
        } else {
            return $this->failGeneralMessage('auth.logged_out_failed');
        }
    }
}
