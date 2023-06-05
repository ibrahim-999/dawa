<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Services\LocationService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Shared\StoreLocationRequest;

class LocationController extends ApiController
{
    private LocationService $locationService;

    public function __construct(
        LocationService $locationService,
    )
    {
        $this->locationService = $locationService;
    }

    /**
     * Store a newly created address in storage.
     */
    public function update(StoreLocationRequest $request)
    {
        $location = $this->locationService->add($request);
        
        if ($location) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }
}
