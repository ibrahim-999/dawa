<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartVariantsResource extends JsonResource
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
            'price_after_discount' => round($this->price - (($this->discount_percentage * $this->price)/100)),
            'rate'=> rand(1,5),
            'main_image' => url(asset('admin-panel-assets/v1/images/logo-dark.png')),
            'values' => VariantValueResource::collection($this->whenLoaded('values')),
            'product' => ProductResource::customItem('mega', $this->product),
            'is_wishlisted' => $this->inWishlist(auth('sanctum')->user()?->id),
        ];
        return $data;
    }
}
