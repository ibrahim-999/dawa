<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Adds\v1\Services\SliderService;
use App\Domains\Shared\v1\Enums\SettingGroupEnum;
use App\Domains\Shared\v1\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adds\SliderStoreRequest;
use App\Http\Requests\Adds\SliderUpdateRequest;
use App\Http\Requests\Admin\AdminUpdateLoyaltyPointActionsRequest;
use App\Http\Requests\Admin\AdminUpdateLoyaltyPointSettingRequest;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{

    private SettingService $settingService;

    public function __construct(
        SettingService $settingService,
    )
    {
        $this->settingService = $settingService;
    }

    public function loyaltySettings(Request $request)
    {
        $loyaltyPointSettings = $this->settingService->getByGroup(SettingGroupEnum::LOYALTY_POINTS);
        $loyaltyPointActions = $this->settingService->getByGroup(SettingGroupEnum::LOYALTY_POINT_ACTIONS);
        return view('admin/v1/setting/loyalty_settings', compact('loyaltyPointSettings','loyaltyPointActions'));
    }


    public function updateLoyaltyPointSettings(AdminUpdateLoyaltyPointSettingRequest $request)
    {
        $updated = $this->settingService->updateLoyaltyPointSettings($request);

        if ($updated) {
            return Redirect::back()->with('success', __('messages.slider_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function updateLoyaltyPointActions(AdminUpdateLoyaltyPointActionsRequest $request)
    {
        $updated = $this->settingService->updateLoyaltyPointSettings($request);

        if ($updated) {
            return Redirect::back()->with('success', __('messages.slider_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

}
