<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Shared\v1\Contracts\Services\RoleServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Enums\TransactionTypeEnum;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class TransactionService
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;

    public function __construct()
    {
        $this->baseModel = new Transaction();
    }

    public function search(Request $request): ?TransactionService
    {
        try {
            $this->baseModel = $this->baseModel->when($request->wallet_type,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('wallet', $request->wallet_type);
                });
            })->when($request->type,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('type', $request->type);
                });
            })->when($request->reason,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->where('reason', $request->reason);
                });
            });

            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function sort($key,$type)
    {
        try {
            $this->baseModel->orderBy($key, $type);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function add(array $data): ?Model
    {
        try {
            $role = $this->baseModel->create($data);
            return $role;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function deposit_points(): ?TransactionService
    {
        try {
            $this->baseModel = $this->baseModel->where('type',TransactionTypeEnum::Deposit->value);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function withdraw_points(): ?TransactionService
    {
        try {
            $this->baseModel = $this->baseModel->where('type',TransactionTypeEnum::Withdraw->value);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getUserPoints(): int
    {
        try {
            $user = getAuthUser();

            $points = $user->wallet_points;

            return (int) $points;

        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
