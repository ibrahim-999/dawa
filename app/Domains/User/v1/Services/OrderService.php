<?php

namespace App\Domains\User\v1\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderService
{
    private Model|Builder $basModel;

    public function __construct(private UserService $userService)   
    {
        $this->basModel = new Order();
    }

    public function paginate_simple(Request $request,int $itemsPerPage): Paginator
    {
        try {
            $orders =$this->basModel->where('user_id', request()->user()->id);

            if (isset($request->status) && is_array($request->status)) {
                $orders = $orders->whereIn('status', $request->status);
            }

            return $orders->simplePaginate($itemsPerPage);
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

    public function updateStatus($order, Request $request): bool
    {
        try {
            $user = $this->userService->getAuthUser('sanctum');

            $status = DB::transaction(function () use ($order,$request,$user){
                $order->history()->create([
                    'reason' => $request->reason,
                    'status' => $request->status,
                    'moderatable_type' => get_class($user),
                    'moderatable_id' => $user->id,
                ]);

                return $order->update([
                    'status' => $request->status
                ]); 
            });

            return $status;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}