<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AuthUserData extends JsonResource
{
    protected $token;

    public function token($token){
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
            'phone_number' => $this->national_phone_number,
            'phone_country_code' => $this->phone_country_code,
            'profile_image' => ($this->profile_image) ? url(Storage::url($this->profile_image?->url)) : null,
            'is_active' => (bool) $this->is_active,
        ];
        if ($this->token) {
            $data['token'] = $this->token;
        }
        return $data;
    }
}
