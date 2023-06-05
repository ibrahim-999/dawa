<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\User\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_code' => $this->order_code,
            'type' => $this->type,
            'delivery_type' => $this->delivery_type,
            'schedule_date' => $this->schedule_date,
            'status' => $this->status,
            'address' => AddressResource::make($this->address),
            'cart' => CartResource::make($this->cart()->with('variants')->first()),
            // 'packages' => PackageResource::collection($this->packages),
        ];
        return $data;
    }
}
