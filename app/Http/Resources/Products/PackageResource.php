<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\User\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'variant_id' => $this->variant_id,
            'order_id' => $this->order_id,
            'quantity' => $this->quantity,
            'vendor_id' => $this->vendor_id,
            'status' => $this->status,
        ];
        return $data;
    }
}
