<?php

namespace App\Domains\Adds\v1\Services;

use App\Domains\Adds\v1\Contracts\Services\SliderServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SliderService implements CrudContract, SliderServiceContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;
    public function __construct()
    {
        $this->baseModel = new Slider();
    }
    public function search(Request $request): ?SliderServiceContract
    {
        try {

            $this->baseModel = $this->baseModel
                ->when($request->search, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        $q->whereTranslationLike('title', "%{$request->search}%");
                    });
                });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $slider = $this->baseModel->create($data);
            if ($request->invite) {
                //TODO:Send Invitation mail
            }
            return $slider;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function setBuilder(Model|Builder $query): CrudContract
    {
        try {
            $this->baseModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function update(Request $request): bool
    {
        try {
            $data = $request->validated();
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            return $this->baseModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
