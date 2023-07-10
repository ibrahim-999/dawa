<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\CouponService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Domains\User\v1\Services\Contracts\CartServiceContract;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CartService implements CartServiceContract, CrudContract
{
    use CommonServiceCrudTrait;

    private Model|Builder $baseModel;
    private UserService $userService;
    private AddressService $addressService;
    private VariantService $variantService;
    private CouponService $couponService;

    public function __construct()
    {
        $this->baseModel = new Cart();
        $this->userService = new UserService();
        $this->addressService = new AddressService();
        $this->variantService = new VariantService();
        $this->couponService = new CouponService();
    }

    public function syncCart(array $items, $merge = true)
    {
        try {

            $user = $this->userService->getAuthUser('sanctum');
            $place_id = request()->header('X-Place');
            $address = $this->addressService->find('place_id', $place_id);
            $currentCart = $this->getCartByPlace($user, $place_id);
            if ($currentCart) {
                $this->baseModel = $currentCart;
            } else {
                $this->baseModel = $this->baseModel->create(
                    [
                        'user_id' => $user->id,
                        'place_id' => $place_id,
                        'address_id' => $address?->id,
                    ]
                );
            }
            $variants = $this->mergeVariants($items, $merge);
            $this->baseModel->variants()->sync($variants);
            $this->baseModel->variants()->wherePivot('quantity', '=', 0)->detach();
            return $this->baseModel;
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
                $itemCartInfo = $this->getCartItem($this->baseModel, $item['variant_id']);
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
            $rest_items = $this->baseModel->variants()->whereNotIn('id', array_keys($variants))->get();
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
                $this->baseModel = $currentCart;
            }
            return $this->baseModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getCouponDiscount($coupon, $cart)
    {
        try {
            $user = $this->userService->getAuthUser('sanctum');
            $discountType = $coupon->discount_type;
            $discount = $coupon->discount;
            $maxDiscount = $coupon->max_discount;
            $discountedVariants = [];
            $totalPrice = 0;
            $totalDiscount = 0;
            if ($cart->variants->count()) {
                foreach ($cart->variants as &$variant) {

                    if (
                        in_array($variant->product_id, $coupon->products()->pluck('model_id')->toArray()) ||
                        in_array($variant->product?->category_id, $coupon->categories()->pluck('model_id')->toArray()) ||
                        in_array($variant->product?->sub_category_id, $coupon->categories()->pluck('model_id')->toArray()) ||
                        in_array($variant->product?->subset_category_id, $coupon->categories()->pluck('model_id')->toArray())
                    ) {
                        $variant->net_price_after_coupon = $this->getPriceOfVariant($discountType, $discount, $variant->net_price);
                        $variant->discount_coupon_type = $discountType;
                        $variant->discount_coupon_value = $discount;
                        $discountedVariants[] = $variant;
                        $totalPrice += $variant->pivot->quantity * $variant->net_price;
                    }
                }

                if (count($discountedVariants)) {
                    $discount = $this->getTotalDiscount($discountType, $discount, $totalPrice, $maxDiscount);
                    $totalDiscount = $discount;
                }
            }
            return $totalDiscount;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    // calculate total discount of cart
    public function getTotalDiscount($discountType, $discount, $totalPrice, $maxDiscount)
    {
        if ($discountType == 2) {
            $discount = $totalPrice * $discount / 100;
            if ($discount >= $maxDiscount) {
                $discount = $maxDiscount;
            }
        } else {
            $discount = $totalPrice - $discount;
        }
        return $discount;
    }

    // calculate total discount of cart
    public function getPriceOfVariant($discountType, $discount, $price)
    {
        if ($discountType == 2) {
            $price = $price - ($price * $discount / 100);
        } else {
            $price = $price - $discount;
        }
        return $price;
    }

    public function search(Request $request): ?CartServiceContract
    {
        try {
            $this->cartModel = $this->cartModel->when($request->search, function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereTranslationLike('title', "%{$request->search}%");
                });
            });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function select(array $columns): ?CartServiceContract
    {
        try {
            $this->cartModel = $this->cartModel->select($columns);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $category = $this->cartModel->create($data);
            if ($request->invite) {
                //TODO:Send Invitation mail
            }
            return $category;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function setBuilder(Model|Builder $query): CrudContract
    {
        try {
            $this->cartModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->validated();
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            return $this->cartModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function reset()
    {
        return new \App\Domains\Product\v1\Services\CartService();
    }

    public function notPurchasedCarts()
    {
        try {
            $this->baseModel = $this->baseModel
                ->where('order_id', null)
                ->whereHas('variants');
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
