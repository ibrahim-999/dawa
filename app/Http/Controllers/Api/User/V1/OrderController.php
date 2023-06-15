<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\User\v1\Services\Contracts\CreateOrderInterface;
use App\Domains\User\v1\Services\CreateOrderContext;
use App\Domains\User\v1\Services\OfferOrderService;
use App\Domains\User\v1\Services\OrderService;
use App\Domains\User\v1\Services\OrderStatusValidationService;
use App\Domains\User\v1\Services\PrescriptionOrderService;
use App\Domains\User\v1\Services\ProductOrderService;
use App\Domains\User\v1\Services\SearchOrderService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\User\OrderStoreRequest;
use App\Http\Requests\User\UpdateOrderStatusRequest;
use App\Http\Resources\Products\OrderResource;
use Illuminate\Http\Request;


class OrderController extends ApiController
{
    private OrderService $orderService;

    public function __construct(
        OrderService $orderService,
    )
    {
        $this->orderService = $orderService;
    }

    public function store(OrderStoreRequest $request)
    {
        $service = $this->getService($request->type);

        $orderContext = new CreateOrderContext($service);

        $order = $orderContext->createOrder($request);

        $data = OrderResource::make($order);

        return $this->successShowDataResponse($data, 'order');
    }

    public function getService($type) : CreateOrderInterface{
        switch ($type) {
            case 1:
                return app()->make(ProductOrderService::class); 
            case 2:
                return app()->make(PrescriptionOrderService::class); 
            case 3:
                return app()->make(SearchOrderService::class); 
            case 4:
                return app()->make(OfferOrderService::class); 
            default:
                return null;
        }
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

    public function updateStatus(int $id, UpdateOrderStatusRequest $request)
    {
        $order = $this->orderService->find('id', $id);
        
        if (!$order) {
            return $this->failResourceNotFoundMessage('order');
        }

        $ValidationService = app()->make(OrderStatusValidationService::class);

        $isValid = $ValidationService->ValidateUserChangeStatusOfOrder($order, $request);

        if (!$isValid) {
            return $this->failGeneralMessage(__('messages.not_allowed_to_change_status'));
        }

        $updated = $this->orderService->updateStatus($order,$request);
        
        if ($updated) {
            return $this->successUpdateNoContentResponse();
        } else {
            return $this->failUpdateMessage();
        }
    }
}
