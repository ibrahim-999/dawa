<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Shared\v1\Traits\UploadFilesTrait;
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

class SearchOrderService implements CreateOrderInterface
{
    use UploadFilesTrait;
    private Model|Builder $basModel;
    private UserService $userService;
    private VariantService $variantService;
    private AddressService $addressService;

    public function __construct(CartService $cartService, VariantService $variantService)
    {
        $this->basModel = new Order();
        $this->userService = new UserService();
        $this->variantService = $variantService;
        $this->addressService = new AddressService();
    }

    public function create(Request $request): ?Model
    {
        try {
            $user = $this->userService->getAuthUser('sanctum');
            $place_id = request()->header('X-Place');
            $address = $this->addressService->find('place_id', $place_id);
            $cart = $user->carts()->create(
                [
                    'user_id' => $user->id,
                    'place_id' => $place_id,
                    'address_id' => $address?->id,
                ]
            );

            $variants = $this->PrepareCartItems($request->variants);
            $cart->variants()->sync($variants);

            $data = $request->validated();
            $data['user_id'] = $user->id;
            $data['cart_id'] = $cart->id;
            $data['status'] = OrderStatusEnum::PENDING->value;
            $data['type'] = OrderTypeEnum::SEARCH->value;

            if ($data['delivery_type'] == DeliveryTypeEnum::SCHEDULE->value) {
                $data['schedule_date'] = $request->schedule_date.' '. $request->schedule_time ;
            }

            $order = $this->basModel->create($data);
            $cart->update(['order_id' => $order->id,'is_current' => 0]);
            return $order;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function PrepareCartItems(array $items): ?array
    {
        try {
            $variants = [];
            foreach ($items as $item) {
                $variant = $this->variantService->find('id', $item['variant_id']);
                $quantity = $item['quantity'];
                $variants[$item['variant_id']] = [
                    'quantity' => $quantity,
                    'initial_price' => $variant->net_price,
                ];
            }
            return $variants;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
