<?php

namespace App\Http\Resources\Shared;

use App\Domains\Shared\v1\Enums\ModelEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class NotificationResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = app()->getLocale();
        $data = [
            'id' => $this->id,
            'notification_type' => $this->getNotifiableType($this->notifiable_type),
//            'notifiable_type' => $this->notifiable_type,
//            'notifiable_id' => $this->notifiable_id,
            'title' => isset($this->data[$lang]) ? $this->data[$lang]['title']: null,
            'body' => isset($this->data[$lang]) ? $this->data[$lang]['body']: null,
            'model_type' => isset($this->data['model_type']) ? $this->data['model_type']: null,
            'model_id' => isset($this->data['model_id']) ? $this->data['model_id']: null,
            'is_seen' => (bool) $this->read_at,
            'data' => $this->data,
            'created_at' => $this->created_at,
            'radable_created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
        return $data;
    }

    public function getNotifiableType($type) : string {
        $type = match($type) {
                'App\Models\User' => ModelEnum::USER->value,
                'App\Models\Driver' => ModelEnum::DRIVER->value,
                default => ModelEnum::USER->value
            };
        return $type;    
    }
}
