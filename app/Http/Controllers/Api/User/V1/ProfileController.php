<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\Auth\OtpAccessService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\User\UserUpdateProfileImageRequest;
use App\Http\Requests\User\UserUpdateProfileRequest;
use App\Http\Resources\User\AuthUserData;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileController extends ApiController
{
    private OtpAccessService $otpAccessService;
    private UserService $userService;
    private OtpServiceContract $otpService;

    public function __construct(
        OtpAccessService  $otpAccessService,
        UserService        $userService,
        OtpServiceContract $otpService
    )
    {
        $this->otpAccessService = $otpAccessService;
        $this->userService = $userService;
        $this->otpService = $otpService;

    }

    /**
     * update profile.
     */
    public function update(UserUpdateProfileRequest  $request)
    {
        $user = $this->userService->getAuthUser('sanctum');
        $phone = $this->userService->getRequestPhone($request);

        if ($phone != $user->phone && !$request->otp) {
            $opt_is_sent = $this->otpService->sendOtp($phone);
            if ($opt_is_sent) {
                return $this->successًwithActionMessage(__('auth.otp_sent_successfully'));
            } else {
                return $this->failGeneralMessage('auth.otp_sending_failed');
            }
        }

        $this->checkOtp($request,$phone);

        $profile = $this->userService->updateProfile($user, $request);

        if ($profile) {
            $data = (new AuthUserData($user));
            return $this->successShowDataResponse($data, 'Show');
        } else {
            return $this->failGeneralMessage();
        }

    }

    //validate otp if exist
    public function checkOtp($request,$phone){
        if ($request->otp) {
            $isVerified = $this->otpAccessService->verifyOtpAttempt($phone, $request->otp, $request);
            if (!$isVerified) {
                throw ValidationException::withMessages([
                    'otp' => __('auth.wrong_otp')
                ]);
            }
        }
    }

    /**
     * update profile.
     */
    public function updateProfileImage(UserUpdateProfileImageRequest  $request)
    {
        $user = $this->userService->getAuthUser('sanctum');

        $updated = $this->userService->updateProfileImage($user, $request);

        if ($updated) {
            return $this->successUpdateNoContentResponse();
        } else {
            return $this->failGeneralMessage();
        }
    }

    /**
     * update profile.
     */
    public function deactivateAccount(Request  $request)
    {
        $user = $this->userService->getAuthUser('sanctum');

        $updated = $this->userService->deactivateAccount($user);

        if ($updated) {
            return $this->successUpdateNoContentResponse();
        } else {
            return $this->failGeneralMessage();
        }
    }

}
