<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->variant?->id,
            'title' => $this->variant?->title,
            'price' => round($this->variant?->price),
            'currency' => $this->variant?->currency,
            'discount_percentage' => $this->variant?->discount_percentage,
            'price_after_discount' => round($this->variant?->price - (($this->variant?->discount_percentage * $this->variant?->price)/100)),
            'rate'=> rand(1,5),
            'is_active' => $this->variant?->is_active,
            'images' => [
                    url(asset('admin-panel-assets/v1/images/logo-dark.png')),
                    url(asset('admin-panel-assets/v1/images/logo-dark.png')),
                    url(asset('admin-panel-assets/v1/images/logo-dark.png')),
                ],
            'main_image' => url(asset('admin-panel-assets/v1/images/logo-dark.png')),
            'values' => $this->when($this->relationLoaded('variant') && $this->variant->relationLoaded('values'),
                function () {
                    return VariantValueResource::collection($this->variant->values);
                }
            ),
            'product' => ProductResource::customItem('mega', $this->variant?->product),
        ];
        return $data;
    }
}
