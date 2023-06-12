<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartCouponResource extends JsonResource
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
            'place_id' => $this->place_id,
            'total_price' => (double)$this->total_price,
            'total_quantity' => (int)$this->total_quantity,
            'discount' => $this->discount,
            'total_after_discount' => (double) ($this->total_price-$this->discount) ,
            'total_after_discount_coupon' => (double) ($this->total_after_discount_coupon) ,
            'coupon_id' => $this->coupon_id,
            'coupon_discount_type' => $this->coupon_discount_type,
            'coupon_discount_value' => $this->coupon_discount_value,
            'variants' => CartCouponVariantsResource::collection($this->variants),
        ];
        return $data;
    }
}
