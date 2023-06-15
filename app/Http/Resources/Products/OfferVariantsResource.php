<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferVariantsResource extends JsonResource
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
            'description' => $this->description ?? '',
            'specifications' => $this->specifications ?? '',
            'price' => (double)round($this->price),
            'current_cart_quantity' => (int)$this->currentCart()?->pivot->quantity ?? 0,
            'currency' => $this->currency,
            'discount_percentage' => (double)$this->discount_percentage,
            'price_after_discount' => (double)$this->net_price,
            'rate' => (double)rand(1, 5),
            'is_active' => $this->is_active,
            'images' => [
                url(asset('product/' . rand(1, 6) . '.jpeg')),
                url(asset('product/' . rand(1, 6) . '.jpeg')),
                url(asset('product/' . rand(1, 6) . '.jpeg')),
            ],
            'main_image' => url(asset('product/' . rand(1, 6) . '.jpeg')),
            'values' => VariantValueResource::collection($this->whenLoaded('values')),
            'product' => ProductResource::customItem('mega', $this->product),
            'is_wishlisted' => $this->inWishlist(auth('sanctum')->user()?->id),
        ];
        return $data;
    }
}
