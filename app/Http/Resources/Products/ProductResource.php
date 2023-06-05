<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\ResourceSplitter;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Benchmark;

class ProductResource extends ResourceSplitter
{

    protected function micro(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    protected function medium(): array
    {
       return [
            'category' => TitleResource::make($this->whenLoaded('category')),
            'sub_category' => TitleResource::make($this->whenLoaded('sub_category')),
            'subset_category' => TitleResource::make($this->whenLoaded('subset_category')),
            'brand' => TitleResource::make($this->whenLoaded('brand')),
        ];
    }

    protected function mega(): array
    {
        return[
            'attributes' => ProductAttributeResource::collection($this->whenLoaded('attributes')),
            'variants' => VariantsResource::collection($this->whenLoaded('variants')),
        ];
    }
}
