<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Services\SettingService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Shared\SettingResource;
use Illuminate\Http\Request;


class SettingController extends ApiController
{
    private SettingService $settingService;

    public function __construct(
        SettingService $settingService,
    )
    {
        $this->settingService = $settingService;
    }

    // get about us
    public function aboutUs(Request $request)
    {
        $aboutUs = $this->settingService->with(['translation'])->find('key','about');

        if (!$aboutUs) {
            return $this->failResourceNotFoundMessage('about-us');
        }

        $data = SettingResource::make($aboutUs);
        return $this->successShowDataResponse($data, 'about-us');
    }

    // get privacy & policy
    public function privacy(Request $request)
    {
        $privacy = $this->settingService->with(['translation'])->find('key','privacy');

        if (!$privacy) {
            return $this->failResourceNotFoundMessage('privacy');
        }

        $data = SettingResource::make($privacy);
        return $this->successShowDataResponse($data, 'privacy');
    }

    // get terms
    public function terms(Request $request)
    {
        $terms = $this->settingService->with(['translation'])->find('key','terms');

        if (!$terms) {
            return $this->failResourceNotFoundMessage('terms');
        }

        $data = SettingResource::make($terms);
        return $this->successShowDataResponse($data, 'terms');
    }
}
