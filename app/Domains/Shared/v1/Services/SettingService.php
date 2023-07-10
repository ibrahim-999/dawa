<?php

namespace App\Domains\Shared\v1\Services;

use App\Domains\Shared\v1\Enums\SettingGroupEnum;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    
    public function getByGroup($group = SettingGroupEnum::GENERAL): ?Collection
    {
        try {
            return $this->settingModel->where('group', $group)->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function updateLoyaltyPointSettings(Request $request): bool
    {
        try {
            $data = $request->except(['_token','_method']);

            foreach ($data as $key => $value) {
                $model = $this->find('key', $key);

                if ($key) {
                    $model->update(['fixed_value' => $value]);
                }
            }

            return true;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
