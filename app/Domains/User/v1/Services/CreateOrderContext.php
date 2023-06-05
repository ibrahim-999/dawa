<?php

namespace App\Domains\User\v1\Services;

use App\Domains\User\v1\Services\Contracts\CreateOrderInterface;
use App\Models\Order;
use Illuminate\Http\Request;

class CreateOrderContext
{
    private $orderService;


    public function __construct(CreateOrderInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * create order
     */
    public function createOrder(Request $request): ?Order
    {
        $order = $this->orderService->create($request);
        return $order;
    }
}