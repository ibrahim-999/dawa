<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\ResourceSplitter;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Benchmark;

class CouponProductResource extends ResourceSplitter
{

    protected function micro(): array
    {
        return [
            'id' => $this->product->id,
            'title' => $this->product->title,
            'description' => $this->product->description,
        ];
    }

    protected function medium(): array
    {
       return [
            'category' => TitleResource::make($this->whenLoaded('product.category')),
            'sub_category' => TitleResource::make($this->whenLoaded('product.sub_category')),
            'subset_category' => TitleResource::make($this->whenLoaded('product.subset_category')),
            'brand' => TitleResource::make($this->whenLoaded('product.brand')),
        ];
    }

    protected function mega(): array
    {
        return[
            'attributes' => ProductAttributeResource::collection($this->whenLoaded('product.attributes')),
            'variants' => VariantsResource::collection($this->whenLoaded('product.variants')),
        ];
    }
}
