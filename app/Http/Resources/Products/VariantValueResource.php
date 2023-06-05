<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantValueResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'attribute' => ProductAttributeResource::make($this->attribute),
            'value' => AttributeValueResource::make($this->value),
        ];
        return $data;
    }
}
