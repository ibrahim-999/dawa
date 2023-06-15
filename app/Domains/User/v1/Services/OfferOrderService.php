<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\OfferService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Shared\v1\Traits\UploadFilesTrait;
use App\Domains\User\v1\Enums\DeliveryTypeEnum;
use App\Domains\User\v1\Enums\OrderStatusEnum;
use App\Domains\User\v1\Enums\OrderTypeEnum;
use App\Domains\User\v1\Services\Contracts\CreateOrderInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OfferOrderService implements CreateOrderInterface
{
    use UploadFilesTrait;
    private Model|Builder $basModel;
    private UserService $userService;
    private VariantService $variantService;
    private AddressService $addressService;
    private OfferService $offerService;

    public function __construct(CartService $cartService, VariantService $variantService)
    {
        $this->basModel = new Order();
        $this->userService = new UserService();
        $this->variantService = $variantService;
        $this->addressService = new AddressService();
        $this->offerService = new OfferService();
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

            $offer = $this->offerService->find('id', $request->offer_id);
            $offer->load(['getVariants','buyVariants']);
            
            $variants = $this->PrepareCartItems($offer);

            $cart->variants()->sync($variants);

            $data = $request->validated();
            $data['user_id'] = $user->id;
            $data['cart_id'] = $cart->id;
            $data['status'] = OrderStatusEnum::PENDING->value;
            $data['type'] = OrderTypeEnum::OFFER->value;
            $data['offer_id'] = $offer->id;

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

    public function PrepareCartItems($offer): ?array
    {
        try {
            $buyVariant = $offer->buyVariants->first();
            $getVariant = $offer->getVariants->first();

            $variants = [];
            if ($buyVariant) {
                $quantity = $offer->buy_amount;
                $variants[$buyVariant->id] = [
                    'quantity' => $quantity,
                    'initial_price' => $buyVariant->net_price,
                ];
            }

            if ($getVariant) {
                $quantity = $offer->get_amount;
                $variants[$getVariant->id] = [
                    'quantity' => $quantity,
                    'initial_price' => $getVariant->net_price,
                ];
            }

            return $variants;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
