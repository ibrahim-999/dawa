<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartCouponVariantsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'price' => round($this->price),
            'currency' => $this->currency,
            'quantity' => $this->pivot->quantity,
            'discount_percentage' => $this->discount_percentage,
            // 'price_after_discount' => $this->net_price,
            'price_after_discount' => $this->net_price_after_coupon,
            'discount_coupon_type' => $this->discount_coupon_type,
            'discount_coupon_value' => $this->discount_coupon_value,
            'price_after_discount_coupon' => $this->net_price_after_coupon,
            'rate'=> rand(1,5),
            'main_image' => url(asset('admin-panel-assets/v1/images/logo-dark.png')),
            'values' => VariantValueResource::collection($this->whenLoaded('values')),
            'product' => ProductResource::customItem('mega', $this->product),
            'is_wishlisted' => $this->inWishlist(auth('sanctum')->user()?->id),
        ];
        return $data;
    }
}
