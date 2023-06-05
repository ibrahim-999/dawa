<?php

namespace App\Domains\Shared\v1\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SettingService
{
    private Model|Builder $settingModel;

    public function __construct()
    {
        $this->settingModel = new Setting();

    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->settingModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function with(array $relations): ?SettingService
    {
        try {
            $this->settingModel = $this->settingModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
