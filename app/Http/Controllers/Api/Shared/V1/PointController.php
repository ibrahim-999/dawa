<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Services\NotificationService;
use App\Domains\Shared\v1\Services\PointService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Shared\NotificationResource;
use Illuminate\Http\Request;


class PointController extends ApiController
{
    private PointService $pointService;

    public function __construct(
        PointService $pointService,
    )
    {
        $this->pointService = $pointService;
    }

    public function getUserPoint()
    {
        $points = $this->pointService->getUserPoints();
        return $points;
        // return $this->successShowDataResponse($data, 'categories_item');
    }

    public function redeem(Request $request)
    {
        $redeemed = $this->pointService->redeem($request->points);
        dd($redeemed);
        // return $this->successShowDataResponse($data, 'categories_item');
    }


    public function givePoints(Request $request)
    {
        $user = getAuthUser();

        $redeemed = $this->pointService->givePointToUserOnAction($user,'register');
        dd($redeemed);
        // return $this->successShowDataResponse($data, 'categories_item');
    }
}
