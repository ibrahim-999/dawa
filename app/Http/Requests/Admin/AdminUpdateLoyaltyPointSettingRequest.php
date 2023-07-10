<?php

namespace App\Http\Requests\Admin;

use App\Domains\Shared\v1\Enums\SettingGroupEnum;
use App\Domains\Shared\v1\Services\SettingService;
use App\Models\User;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateLoyaltyPointSettingRequest extends FormRequest
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

        $loyaltyPointSettings = $service->getByGroup(SettingGroupEnum::LOYALTY_POINTS);

        foreach ($loyaltyPointSettings as $setting) {
            $rules[$setting->key] = ['required'];
        }

        return $rules;
    }
    
}
