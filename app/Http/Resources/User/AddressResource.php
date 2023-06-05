<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->address,
            'title' => $this->title,
            'place_id' => $this->place_id,
            'lat' => $this->lat,
            'long' => $this->long,
        ];
        return $data;
    }
}
