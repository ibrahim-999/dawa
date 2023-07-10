<?php

namespace App\Http\Resources\Shared;

use App\Domains\Shared\v1\Enums\ModelEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class PointTransactionResource extends JsonResource
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
            'id' => $this->id ,
            'type' => $this->type ,
            'value' => $this->value ,
            'value_as_money' => $this->value ,
            'reason' => $this->reason ,
            'created_at' => $this->created_at,
            'transactional_type' => $this->getTransactionalType($this->transactionable_type),
            'transactional_id' => $this->transactionable_id,
            'transactional_title' => $this->getTransactionalType($this->transactionable_type),
            'radable_created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
        return $data;
    }

    public function getTransactionalType($type) : string {
        $type = match($type) {
                'App\Models\User' => ModelEnum::ORDER->value,
                'App\Models\Driver' => ModelEnum::DRIVER->value,
                'App\Models\Order' => ModelEnum::ORDER->value,
                default => ModelEnum::USER->value
            };
        return $type;
    }
}
