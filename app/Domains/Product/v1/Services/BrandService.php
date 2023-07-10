<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\BrandServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class BrandService implements BrandServiceContract, CrudContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;

    public function __construct()
    {
        $this->baseModel = new Brand();
    }

    public function search(Request $request): ?BrandServiceContract
    {
        try {

            $this->baseModel = $this->baseModel
                ->when($request->search, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        $q->whereTranslationLike('title', "%{$request->search}%");
                    });
                })
                ->when($request->categories, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        $q->whereHas('products', function ($q) use ($request) {
                            $q->whereIn('category_id', $request->categories)
                                ->orWhereIn('sub_category_id', $request->categories)
                                ->orWhereIn('subset_category_id', $request->categories);
                        });
                    });
                });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function activeBrands(): ?BrandServiceContract
    {
        try {
            $this->baseModel = $this->baseModel->active();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function grandParents(): ?BrandServiceContract
    {
        try {
            $this->baseModel = $this->baseModel->grandParents();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->except(['image','_token']);
            $brand = $this->baseModel->create($data);
            $brand->addMediaFromRequest('image')->toMediaCollection('images');
            return $brand;
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
            $data = $request->except(['image','_token','_method']);
            if ($request->hasFile('image')) {
                $this->baseModel->clearMediaCollection('images');
                $this->baseModel->addMediaFromRequest('image')->toMediaCollection('images');
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
