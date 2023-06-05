<?php

namespace App\Http\Resources\Products;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Benchmark;

class AttributeValueResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id ?? null,
            'name' => $this->name ?? '',
            'code' => $this->code ?? '',
        ];
        return $data;
    }
}
