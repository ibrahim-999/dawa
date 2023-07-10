<?php

namespace App\Http\Requests\Admin;

use App\Domains\Shared\v1\Enums\SettingGroupEnum;
use App\Domains\Shared\v1\Services\SettingService;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateLoyaltyPointActionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $service = app()->make(SettingService::class);
        $rules = [];

        $loyaltyPointActions = $service->getByGroup(SettingGroupEnum::LOYALTY_POINT_ACTIONS);

        foreach ($loyaltyPointActions as $setting) {
            $rules[$setting->key] = ['required'];
        }

        return $rules;
    }
    
}
