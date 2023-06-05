<?php

namespace App\Http\Requests\User;

use App\Domains\User\v1\Enums\DeliveryTypeEnum;
use App\Domains\User\v1\Enums\OrderStatusEnum;
use App\Domains\User\v1\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOrderStatusRequest extends FormRequest
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
            'status' => ['required', Rule::in([OrderStatusEnum::CANCELED->value])],
            'reason' => ['required_if:status,'.OrderStatusEnum::CANCELED->value],
        ];
    }
}
