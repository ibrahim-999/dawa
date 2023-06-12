<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Product\v1\Services\CouponService;
use App\Domains\User\v1\Services\CartService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\CartCouponResource;
use App\Http\Resources\Products\CartResource;
use App\Http\Resources\Products\CouponResource;
use Illuminate\Http\Request;


class CouponController extends ApiController
{
    private CartService $cartService;

    public function __construct(
        CartService $cartService,
        private CouponService $couponService
    )
    {
        $this->cartService = $cartService;
    }

    public function show(string $code,Request $request)
    {
        $coupon = $this->couponService->find('code', $code);
        $coupon->load(['categories','products']);

        if (!$coupon) {
            return $this->failResourceNotFoundMessage('coupon');
        }

        $cart = $this->cartService->getCurrentCart($request)->load('variants');

        //check date , cart variants count and user Usages count 
        $validated = $this->couponService->validateCoupon($coupon,$cart);

        if (!$validated) {
            return $this->failResourceNotFoundMessage('coupon');
        }
        

        if ($cart->getTotalPriceAttribute() < $coupon->min_purchases) {
            return $this->failGeneralMessage('coupon min purchases');
        }

        $data = CouponResource::make($coupon);

        // $newCart = $this->cartService->addCouponToCart($coupon, $cart);
        
        // $cart = $this->cartService->getCurrentCart($request)->load('variants');
        // dd($newCart);
        // $data = CartResource::make($newCart);
        // $data = CartCouponResource::make($newCart);

        return $this->successShowDataResponse($data, 'coupon',__('messages.coupon_data'));
    }
}
