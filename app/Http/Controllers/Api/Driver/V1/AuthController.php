<?php

namespace App\Http\Controllers\Api\Driver\V1;

use App\Domains\Driver\v1\Services\DriverAccessService;
use App\Domains\Driver\v1\Services\DriverService;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Driver\PasswordLoginRequest;
use App\Http\Resources\Driver\AuthDriverData;


class AuthController extends ApiController
{
    private DriverAccessService $accessService;
    private DriverService $driverService;


    public function __construct(
        DriverAccessService $accessService,
        DriverService       $driverService,
    )
    {
        $this->accessService = $accessService;
        $this->driverService = $driverService;

    }


    public function passwordLogin(PasswordLoginRequest $request)
    {
        $phone = $this->driverService->getRequestPhone($request);
        $driver = $this->driverService->getDriverByPhone($phone);
        if (!$driver) {
            return $this->failResourceNotFoundMessage('Driver',__('messages.driver_not_found'));
        }
        $is_correct = $this->accessService->verifyPassword($driver, $request->password);
        if ($is_correct) {
            $token = $driver->createToken('UserAPi')->plainTextToken;
            $data = (new AuthDriverData($driver))->token($token);
            return $this->successShowDataResponse($data, 'login');

        } else {
            $errors = ['password' => __('auth.invalid_password')];
            return $this->failValidationMessage($errors);
        }
    }

    public function me()
    {
        $driver = $this->driverService->getAuthDriver('sanctum-driver');
        $data = (new AuthDriverData($driver));
        return $this->successShowDataResponse($data, 'Show');

    }

    public function logout()
    {
        $driver = $this->driverService->getAuthDriver('sanctum-driver');
        if ($this->accessService->logout($driver)) {
            return $this->successGeneralMessage(__('auth.logged_out_successfully'));
        } else {
            return $this->failGeneralMessage('auth.logged_out_failed');
        }
    }

}
