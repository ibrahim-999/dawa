<?php

namespace App\Http\Requests\Campaigns;

use App\Domains\Campaigns\v1\Enums\CampaignSentTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignTypeEnum;
use App\Domains\Campaigns\v1\Enums\CampaignUserTypeEnum;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CampaignNotificationRequest extends FormRequest
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
        $rules = RuleFactory::make([
            '%title' => 'required',
            '%description' => ['required', 'string'],
            '%subject' => 'required_if:type,email',
            'type' => ['required', Rule::in([CampaignTypeEnum::ALL->value, CampaignTypeEnum::EMAIL->value, CampaignTypeEnum::FCM->value, CampaignTypeEnum::SMS->value])],
            'sent_type' => ['required', Rule::in([CampaignSentTypeEnum::NOW->value, CampaignSentTypeEnum::SCHEDULE->value])],
            'user_type' => ['required', Rule::in([CampaignUserTypeEnum::ALL->value, CampaignUserTypeEnum::USERS->value, CampaignUserTypeEnum::VENDORS->value])],
            'user_id' => 'required_if:user_type,users',
            'start_date' => 'required_if:sent_type,2',
            'end_date' => 'required_if:sent_type,2',
            'schedule_type' => 'required_if:sent_type,2',
            'days_of_week' => 'required_if:schedule_type,2',
            'vendor_id' => 'required_if:user_type,vendors',
            'is_active' => ['nullable', 'boolean']
        ]);

        return $rules;
    }
}
