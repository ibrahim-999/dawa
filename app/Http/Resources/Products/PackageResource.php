<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Shared\PharmacyResource;
use App\Http\Resources\User\AddressResource;
use App\Models\Pharmacy;
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
            'variant' => VariantsResource::make($this->variant),
            'order_id' => $this->order_id,
            'quantity' => $this->quantity,
            'pharmacy' => PharmacyResource::make($this->pharmacy),
            'status' => $this->status,
        ];
        return $data;
    }
}
