<?php

namespace App\Domains\User\v1\Services;

use App\Domains\User\v1\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Notifications\DriverAcceptOrderNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class DriverOrderService
{
    private Model|Builder $basModel;

    public function __construct(private UserService $userService)   
    {
        $this->basModel = new Order();
    }

    public function paginate_simple(Request $request,int $itemsPerPage): Paginator
    {
        try {
            $orders =$this->basModel->where('driver_id', request()->user()->id);

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
            return $this->basModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function updateStatus($order, Request $request): bool
    {
        try {
            $driver = $this->userService->getAuthUser('sanctum-driver');

            $status = DB::transaction(function () use ($order, $request, $driver){
                $order->history()->create([
                    'reason' => 'driver accepted',
                    'status' => $request->status,
                    'moderatable_type' => get_class($driver),
                    'moderatable_id' => $driver->id,
                ]);

                return $order->update([
                    'status' => $request->status,
                    'driver_id' => $driver->id,
                ]); 
            });

            if ($request->status == OrderStatusEnum::DRIVER_ACCEPTED->value) {
                $driver->notify(new DriverAcceptOrderNotification($order));
            }

            return $status;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}