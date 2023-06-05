<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\VariantService;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CartService
{
    private Model|Builder $basModel;
    private UserService $userService;
    private AddressService $addressService;
    private VariantService $variantService;

    public function __construct()
    {
        $this->basModel = new Cart();
        $this->userService = new UserService();
        $this->addressService = new AddressService();
        $this->variantService = new VariantService();
    }

    public function syncCart(array $items, $merge = true)
    {
        try {

            $user = $this->userService->getAuthUser('sanctum');
            $place_id = request()->header('X-Place');
            $address = $this->addressService->find('place_id', $place_id);
            $currentCart = $this->getCartByPlace($user, $place_id);
            if ($currentCart) {
                $this->basModel = $currentCart;
            } else {
                $this->basModel = $this->basModel->create(
                    [
                        'user_id' => $user->id,
                        'place_id' => $place_id,
                        'address_id' => $address?->id,
                    ]
                );
            }
            $variants = $this->mergeVariants($items, $merge);
            $this->basModel->variants()->sync($variants);
            $this->basModel->variants()->wherePivot('quantity', '=', 0)->detach();
            return $this->basModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getCartByPlace(User $user, string $place_id): ?Cart
    {
        try {

            return $user->carts()->where('order_id', null)->where('is_current', 1)->where('place_id', $place_id)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function mergeVariants(array $items, bool $merge): ?array
    {
        try {

            $variants = [];

            foreach ($items as $item) {
                $itemCartInfo = $this->getCartItem($this->basModel, $item['variant_id']);
                $variant = $this->variantService->find('id', $item['variant_id']);
                $quantity = $item['quantity'];
                if ($itemCartInfo) {
                    $quantity = ($merge) ? $quantity + $itemCartInfo->pivot->quantity : $quantity;
                }
                $variants[$item['variant_id']] = [
                    'quantity' => $quantity,
                    'initial_price' => $variant->net_price,
                ];
            }
            $rest_items = $this->basModel->variants()->whereNotIn('id', array_keys($variants))->get();
            foreach ($rest_items as $item) {
                $variants[$item->id] = [
                    'quantity' => $item->pivot->quantity,
                    'initial_price' => $variant->net_price,
                ];
            }
            return $variants;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }


    public function getCartItem(Cart $cart, $variant_id): ?Model
    {
        try {

            return $cart->variants()->where('id', $variant_id)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getCurrentCart($request)
    {
        try {

            $user = $this->userService->getAuthUser('sanctum');
            $place_id = request()->header('X-Place');
            $currentCart = $this->getCartByPlace($user, $place_id);
            if ($currentCart) {
                $this->basModel = $currentCart;
            }
            return $this->basModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
