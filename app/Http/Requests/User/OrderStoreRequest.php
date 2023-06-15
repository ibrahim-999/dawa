<?php

namespace App\Http\Requests\User;

use App\Domains\User\v1\Enums\DeliveryTypeEnum;
use App\Domains\User\v1\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
        return [
            'type' => ['required',Rule::in([OrderTypeEnum::PRODUCTS->value, OrderTypeEnum::PRESCRIPTION->value, OrderTypeEnum::SEARCH->value, OrderTypeEnum::OFFER->value])],
            'address_id' => ['required','exists:addresses,id'],
            'delivery_type' => ['required', Rule::in([DeliveryTypeEnum::EXPRESS->value,DeliveryTypeEnum::SCHEDULE->value])],
            'schedule_date' => ['required_if:delivery_type,2','date','date_format:Y-m-d'],
            'schedule_time' => ['required_if:delivery_type,2','date_format:H:i:s'],
            // products vaildation
            'accept_alternatives' => ['required_if:type,'.OrderTypeEnum::PRODUCTS->value,'integer'],

            //prescription validation
            'prescription_file' => ['required_if:type,'.OrderTypeEnum::PRESCRIPTION->value, 'file', 'mimes:png,jpg,jpeg,pdf'],

            //search order
            'variants' => ['required_if:type,'. OrderTypeEnum::SEARCH->value,'array'],
            'variants.*.variant_id' => ['required','exists:variants,id'],
            'variants.*.quantity' => ['required','numeric','min:1'],

            //offer order
            'offer_id' => ['required_if:type,'.OrderTypeEnum::OFFER->value,'integer'],
        ];
    }
}
