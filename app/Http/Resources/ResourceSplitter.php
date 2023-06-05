<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ResourceSplitter extends JsonResource
{
    private static $data_size;

    /**
     *  get data size facility to manage big size data resources
     * @param $data_size
     * @return $this
     */

    public static function customCollection($data_size,$data)
    {
        self::$data_size = $data_size;
        return self::collection($data);
    }
    public static function customItem($data_size,$data)
    {
        self::$data_size = $data_size;
        return self::make($data);
    }

    /**
     * minimal and basic data amount
     * @return array
     */
    abstract protected function micro(): array;

    abstract protected function medium(): array;

    abstract protected function mega(): array;


    /**
     * Transform the resource into an combined array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data=$this->micro();
        $data_size=self::$data_size ?? 'medium';
        if ($data_size== 'medium')
        {
            $data=array_merge($data,$this->medium());
        }
        if ($data_size == 'mega')
        {
            $data=array_merge($data,$this->medium());
            $data=array_merge($data,$this->mega());
        }
        return $data;
    }

}
