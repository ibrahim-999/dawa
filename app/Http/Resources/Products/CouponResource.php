<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->categories);
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'max_discount' => $this->max_discount,
            'num_uses_person' => $this->num_uses_person,
            'num_uses' => $this->num_uses,

            'categories' => CouponCategoryResource::collection($this->categories),
            'products' => CouponProductResource::collection($this->products),

        ];

        return $data;
    }
}