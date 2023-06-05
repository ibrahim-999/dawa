<?php

namespace App\Domains\User\v1\Services;

use App\Domains\User\v1\Enums\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderStatusValidationService
{
    private Model|Builder $basModel;

    public function __construct(private UserService $userService)   
    {
        $this->basModel = new Order();
    }

    public function ValidateUserChangeStatusOfOrder($order, Request $request): bool
    {
        try {
            $user = $this->userService->getAuthUser('sanctum');

            if ($order->status != OrderStatusEnum::PENDING->value) {
                return false;
            }

            return true;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->basModel->where('user_id', request()->user()->id)->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

}