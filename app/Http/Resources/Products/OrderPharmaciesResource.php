<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Shared\PharmacyResource;
use App\Http\Resources\User\AddressResource;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPharmaciesResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'pharmacy' => PharmacyResource::make($this->first()?->pharmacy),
            'packages' => OrderPharmacyPackageResource::collection($this),
        ];
        return $data;
    }
}
