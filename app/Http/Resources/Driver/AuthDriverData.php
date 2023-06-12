<?php

namespace App\Http\Resources\Driver;

use App\Http\Resources\Shared\CityResource;
use App\Http\Resources\Shared\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthDriverData extends JsonResource
{
    protected $token;

    public function token($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'id_number' => $this->id_number,
            'nationality' => $this->nationality,
            'city' => CityResource::make($this->city),
            'vehicle_type' => $this->vehicle_type,
            'vehicle_brand' => $this->vehicle_brand,
            'vehicle_plate_number' => $this->vehicle_plate_number,
            'payment_service' => $this->payment_service,
            'account_holder_name' => $this->account_holder_name,
            'iban_number' => $this->iban_number,
            'stc_number' => $this->stc_number,
            'step' => $this->step,
            'id_number_image' => $this->id_number_image?->url,
            'profile_image' => $this->profile_image?->url,
            'driver_license' => $this->driver_license?->url,
            'is_profile_completed' => $this->is_profile_completed,
            'has_message' => $this->has_message,
            'status' => $this->status,
            'is_available' => (bool) $this->setting?->is_available,
            'is_active' => (bool) $this->is_active,
            'comment' => CommentResource::make($this->warningComment)
        ];
        if ($this->token) {
            $data['token'] = $this->token;
        }
        return $data;
    }
}
