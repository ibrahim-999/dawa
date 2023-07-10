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
        $data = [
            'id' => $this->id,
            'place_id' => $this->place_id,
            'total_price' => (double)$this->total_price,
            'total_quantity' => (int)$this->total_quantity,
            'variants_discount' => (double)$this->total_price-$this->total_net_price,
            'coupon_discount' => $this->Coupon_discount,
            'total_after_discount' => (double) ($this->total_net_price - $this->Coupon_discount) ,
            'variants' => CartVariantsResource::collection($this->whenLoaded('variants')),
        
        ];
        return $data;
    }
}
