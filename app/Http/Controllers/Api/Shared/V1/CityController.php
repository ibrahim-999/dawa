<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Product\v1\Services\BrandService;
use App\Domains\Shared\v1\Services\CityService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\BrandResource;
use App\Http\Resources\Shared\CityResource;
use Illuminate\Http\Request;


class CityController extends ApiController
{
    private CityService $cityService;

    public function __construct(
        CityService $cityService,
    )
    {
        $this->cityService = $cityService;
    }

    public function index(Request $request)
    {
        $cities =CityResource::collection($this->cityService->index());
        return $this->successListMessage($cities);
    }
}
