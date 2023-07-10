<?php

namespace App\Http\Controllers\Api\Driver\V1;

use App\Domains\User\v1\Services\DriverOrderService;
use App\Domains\User\v1\Services\OrderStatusValidationService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Driver\UpdateOrderStatusRequest;
use App\Http\Resources\Products\OrderResource;
use Illuminate\Http\Request;


class OrderController extends ApiController
{
    private DriverOrderService $orderService;

    public function __construct(
        DriverOrderService $orderService,
    )
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;
        $data =OrderResource::collection($this->orderService->paginate_simple($request, $page_size))->resource->toArray();
        $data_array=['orders'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array, $data, 'orders');
    }

    /**
     * Display the specified address by id.
     */
    public function show(int $id, Request $request)
    {
        $order = $this->orderService->find('id', $id);

        if (!$order) {
            return $this->failResourceNotFoundMessage('order');
        }
        $data = OrderResource::make($order);
        return $this->successShowDataResponse($data, 'order');
    }

    /**
     * accept order.
     */
    public function updateStatus(int $id, UpdateOrderStatusRequest $request)
    {
        $order = $this->orderService->find('id', $id);

        if (!$order) {
            return $this->failResourceNotFoundMessage('order');
        }

        $ValidationService = app()->make(OrderStatusValidationService::class);

        $isValid = $ValidationService->ValidateDriverAcceptOrder($order, $request);

        if (!$isValid) {
            // return $this->failGeneralMessage(__('messages.not_allowed_to_change_status'));
        }

        $updated = $this->orderService->updateStatus($order,$request);

        if ($updated) {
            $data = OrderResource::make($order);
            $database=app('firebase.database');
            $database->getReference('new_orders')
                ->update([$order->id=>$data]);
            return $this->successUpdateNoContentResponse();
        } else {
            return $this->failUpdateMessage();
        }
    }
}
