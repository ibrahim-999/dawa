<?php

namespace App\Rules;


use App\Domains\Shared\v1\Exception\ApiValidationException;
use App\Domains\Shared\v1\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DuplicatePhoneCheck implements ValidationRule
{
    use ApiResponseTrait;
    private Model $model;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $phone = phone($value, request()->phone['code'])->formatE164();
            if ($this->model->where('phone',$phone)->exists()) {
                 $fail('The :attribute Already Exists');
            }
        }catch (\Throwable $exception ){
            if (request()->wantsJson()) {
                throw new ApiValidationException(['phone.code' => __('auth.wrong_iso_code')],__('auth.wrong_iso_code'));
            } else {
                // throw $exception;
                // $fail($exception->getMessage());
                $fail(__('auth.wrong_iso_code'));   
            }
        }

    }
}
