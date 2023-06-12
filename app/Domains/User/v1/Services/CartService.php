<?php

namespace App\Domains\User\v1\Services;

use App\Domains\Product\v1\Services\CouponService;
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
    private CouponService $couponService;

    public function __construct()
    {
        $this->basModel = new Cart();
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
                if ($request->coupon_id && $coupon = $this->couponService->find('id', $request->coupon_id)) {
                    $coupon->load(['categories','products']);
                    $currentCart = $this->addCouponToCart($coupon, $currentCart);
                }
                $this->basModel = $currentCart;
            }
            return $this->basModel;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function addCouponToCart($coupon, $cart)
    {
        try {
            
            $user = $this->userService->getAuthUser('sanctum');
            $discountType = $coupon->discount_type;
            $discount = $coupon->discount;
            $maxDiscount = $coupon->max_discount;
            $couponIsApplied = 0 ;
            $discountedVariants = [];
            $totalPrice = 0;
            if ($cart->variants->count()) {
                foreach ($cart->variants as &$variant) {

                if (
                    in_array($variant->product_id,$coupon->products()->pluck('model_id')->toArray()) || 
                    in_array($variant->product?->category_id,$coupon->categories()->pluck('model_id')->toArray())||
                    in_array($variant->product?->sub_category_id,$coupon->categories()->pluck('model_id')->toArray())||
                    in_array($variant->product?->subset_category_id,$coupon->categories()->pluck('model_id')->toArray())
                ) {
                    $variant->net_price_after_coupon = $this->getPriceOfVariant($discountType, $discount, $variant->net_price);
                    $variant->discount_coupon_type = $discountType;
                    $variant->discount_coupon_value = $discount;
                    $discountedVariants[] = $variant;
                    $totalPrice += $variant->pivot->quantity * $variant->net_price;
                    $couponIsApplied = 1 ;
                    
                    //check tota discont // and check max discount
                }
            }
                // dd($cart->variants);
                if (count($discountedVariants)) {

                    $discount = $this->getTotalDiscount($discountType, $discount, $totalPrice, $maxDiscount );
                    $cart->discount =  $discount;
                    $cart->coupon =  $coupon;
                    $cart->coupon_id =  $coupon->id;
                    $cart->coupon_discount_type =  $coupon->discount_type;
                    $cart->coupon_discount_value =  $coupon->discount;
                    $cart->variantsData = $cart->variants;
                    // dd($cart->total_after_discount);
                    $cart->total_after_discount_coupon =  ($cart->total_price - $cart->discount) - $discount;
                    // dd($discount);
                    // $cart->update(['coupon_id' => $coupon->id,'discount' => $discount]);
                    // $coupon->usages()->updateOrCreate(['user_id'=> $user->id]);
                }
        }

            return $cart;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    // calculate total discount of cart
    public function getTotalDiscount($discountType, $discount, $totalPrice, $maxDiscount ){
        if ($discountType == 2) {
            $discount = $totalPrice *  $discount / 100;
            if ($discount  >= $maxDiscount) {
                $discount = $maxDiscount;    
            }
        }else {
            $discount = $totalPrice - $discount;
        }
        return $discount;
    }

    // calculate total discount of cart
    public function getPriceOfVariant($discountType, $discount, $price ){
        if ($discountType == 2) {
            $price = $price - ($price *  $discount / 100);
        }else {
            $price = $price - $discount;
        }
        return $price;
    }

}