<?php

namespace App\Domains\Shared\v1\Exception;

use App\Domains\Shared\v1\Traits\ApiResponseTrait;
use Exception;

class ApiValidationException extends Exception
{
    use ApiResponseTrait;

    public array $errors;

    public function __construct(array $errors ,$message)
    {
        $this->errors = $errors;
        $this->message = $message;
    }
    public function render(){
        return $this->failValidationMessage($this->errors,$this->message);
    }
}
