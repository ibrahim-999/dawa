<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->variants);
        $data = [
            'id' => $this->id,
            'place_id' => $this->place_id,
            'total_price' => (double)$this->total_price,
            'total_quantity' => (int)$this->total_quantity,
            'discount' => $this->discount,
            'total_after_discount' => (double) ($this->total_price-$this->discount) ,
            // 'variants' => $this->when($this->coupon, CartCouponVariantsResource::collection($this->variants), CartVariantsResource::collection($this->whenLoaded('variants'))),
            'variants' => $this->getVariantsData($this->coupon),

        ];
        return $data;
    }

    public function getVariantsData($coupon){
        if ($coupon) {
            // dd($this->variants);
            return CartCouponVariantsResource::collection($this->variantsData);
        }
        return CartVariantsResource::collection($this->whenLoaded('variants'));
    }
}
