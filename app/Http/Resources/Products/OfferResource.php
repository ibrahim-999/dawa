<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'start' => $this->start_date,
            'end' => $this->end_date,
            'title' => $this->title,
            'description' => $this->description,
            'discount_type' => $this->discount_type,
            'discount' => $this->discount,
            'buy_amount' => $this->buy_amount,
            'get_amount' => $this->get_amount,
            'image' => $this->getFirstMediaUrl('images'),
            'buy_variant' => OfferVariantsResource::make($this->buyVariants->first()),
            'get_variant' => OfferVariantsResource::make($this->getVariants->first()),
            // 'buy_variants' => OfferVariantsResource::collection($this->whenLoaded('buyVariants')),
            // 'get_variants' => OfferVariantsResource::collection($this->whenLoaded('getVariants')),
        ];
        
        return $data;
    }
}
