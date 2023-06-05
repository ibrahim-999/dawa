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

class PrescriptionOrderService implements CreateOrderInterface
{
    use UploadFilesTrait;
    private Model|Builder $basModel;
    private UserService $userService;
    private CartService $cartService;
    private AddressService $addressService;

    public function __construct(CartService $cartService)
    {
        $this->basModel = new Order();
        $this->userService = new UserService();
        $this->cartService = $cartService;
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
            $data = $request->validated();
            $user = $this->userService->getAuthUser('sanctum');
            $data['user_id'] = $user->id;
            $data['cart_id'] = $cart->id;
            $data['status'] = OrderStatusEnum::PENDING->value;
            $data['type'] = OrderTypeEnum::PRESCRIPTION->value;
            if ($data['delivery_type'] == DeliveryTypeEnum::SCHEDULE->value) {
                $data['schedule_date'] = $request->schedule_date.' '. $request->schedule_time ;
            }
            $order = $this->basModel->create($data);
            $this->uploadFile($request->prescription_file, $order, 'order', 'order');
            $cart->update(['order_id' => $order->id,'is_current' => 0]);
            return $order;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
