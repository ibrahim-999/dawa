<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Shared\v1\Services\FirebaseDeviceTokenService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Shared\StoreFirebaseDeviceTokenRequest;
use App\Http\Requests\Shared\StoreFirebaseDeviceTokenWithoutDeviceIdRequest;

class AdminFirebaseDeviceTokenController extends ApiController
{
    private firebaseDeviceTokenService $firebaseDeviceTokenService;

    public function __construct(
        FirebaseDeviceTokenService $firebaseDeviceTokenService,
    )
    {
        $this->firebaseDeviceTokenService = $firebaseDeviceTokenService;
    }

    /**
     * Store a newly created address in storage.
     */
    public function storeAdminTokenWithoutDeviceId(StoreFirebaseDeviceTokenWithoutDeviceIdRequest $request)
    {
        $token = $this->firebaseDeviceTokenService->addAdminTokenWithoutDeviceId($request);
        
        if ($token) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }

}