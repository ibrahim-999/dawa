<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\User\AddressResource;
use App\Http\Resources\User\AuthUserData;
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
            'is_active' => $this->is_active,
            'type' => $this->type,
            'delivery_type' => $this->delivery_type,
            'schedule_date' => $this->schedule_date,
            'status' => $this->status,
            'address' => AddressResource::make($this->address),
            'user' => AuthUserData::make($this->user),
            'cart' => CartResource::make($this->cart()->with('variants')->first()),
            'packages' => PackageResource::collection($this->packages),
            'order_pharmacies' => $this->getPharmacies(),
        ];
        return $data;
    }

    public function getPharmacies(){
        $pharmacies = $this->packages()->pluck('pharmacy_id')->unique();
        $data = [];
        foreach ($pharmacies as $pharmacyId) {
            $data [] = OrderPharmaciesResource::make($this->packages()->where('pharmacy_id', $pharmacyId)->get());
        }
        return $data;
    }
}
