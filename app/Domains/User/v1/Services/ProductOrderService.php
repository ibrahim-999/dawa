<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\VariantService;
use App\Domains\User\v1\Enums\DeliveryTypeEnum;
use App\Domains\User\v1\Enums\OrderStatusEnum;
use App\Domains\User\v1\Enums\OrderTypeEnum;
use App\Domains\User\v1\Services\Contracts\CreateOrderInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductOrderService implements CreateOrderInterface
{
    private Model|Builder $basModel;
    private UserService $userService;
    private CartService $cartService;
    private VariantService $variantService;

    public function __construct(CartService $cartService)   
    {
        $this->basModel = new Order();
        $this->userService = new UserService();
        $this->cartService = $cartService;
    }

    public function create(Request $request): ?Model
    {
        try {
            $cart = $this->cartService->getCurrentCart($request)->load('variants');

            if (is_null($cart->id)) {
                throw ValidationException::withMessages([
                    'cart' => __('messages.cart_not_found')
                ]);
            }
            
            $data = $request->validated();
            $user = $this->userService->getAuthUser('sanctum');
            $data['user_id'] = $user->id;
            $data['cart_id'] = $cart->id;
            $data['status'] = OrderStatusEnum::PENDING->value;
            $data['type'] = OrderTypeEnum::PRODUCTS->value;
            if ($data['delivery_type'] == DeliveryTypeEnum::SCHEDULE->value) {
                $data['schedule_date'] = $request->schedule_date.' '. $request->schedule_time ;
            }
            $order = $this->basModel->create($data);
            foreach ($cart->variants as $variant) {
                $order->packages()->create([
                    'variant_id' => $variant->id,
                    'quantity' => $variant->pivot->quantity,
                    'order_id' => $order->id,
                ]);
            }
            $cart->update(['order_id' => $order->id,'is_current' => 0]);

            return $order;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}