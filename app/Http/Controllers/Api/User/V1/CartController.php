<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\User\v1\Services\CartService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\ReviewRequest;
use App\Http\Requests\Product\VariantWithValuesRequest;
use App\Http\Requests\User\CartSyncRequest;
use App\Http\Requests\User\UpdateCartItemRequest;
use App\Http\Resources\Products\CartResource;
use App\Http\Resources\Products\VariantsResource;
use Illuminate\Http\Request;


class CartController extends ApiController
{
    private CartService $cartService;

    public function __construct(
        CartService $cartService,
    )
    {
        $this->cartService = $cartService;
    }

    public function syncCart(CartSyncRequest $request)
    {
        $cart = $this->cartService->syncCart($request->variants)->load('variants');
        $data = CartResource::make($cart);
        return $this->successShowDataResponse($data, 'cart',__('messages.cart_sync_successfully'));
    }
    public function getCurrentCat(Request $request)
    {
        $cart = $this->cartService->getCurrentCart($request)->load('variants');
        $data = CartResource::make($cart);
        return $this->successShowDataResponse($data, 'cart');
    }
    public function createOrUpdateItem(UpdateCartItemRequest $request)
    {
        $items=[
            $request->all()
        ];
        $cart = $this->cartService->syncCart($items,false)->load('variants');
        $data = CartResource::make($cart);
        return $this->successShowDataResponse($data, 'cart',__('messages.cart_modified_successfully'));
    }


}
