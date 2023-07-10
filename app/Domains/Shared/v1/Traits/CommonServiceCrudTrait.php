<?php

namespace App\Domains\Shared\v1\Traits;

use App\Domains\Product\v1\Contracts\Services\BrandServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait CommonServiceCrudTrait
{
    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function reset()
    {
        try {
            return new static();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function sort($key,$type) : ? CrudContract
    {
        try {
            $this->baseModel->orderBy($key, $type);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function with(array $relations): ?CrudContract
    {
        try {
            $this->baseModel = $this->baseModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function where(string $key, string $value, string $operator ='='): ?CrudContract
    {
        try {
            $this->baseModel = $this->baseModel->where($key,$operator,$value);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->baseModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function take(int $items): Collection
    {
        try {
            return $this->baseModel->take($items)->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function index(): Collection
    {
        try {
            return $this->baseModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage,string $page_name='page'): LengthAwarePaginator
    {
        try {
            return $this->baseModel->paginate($itemsPerPage,['*'],$page_name);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->baseModel->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function count():int
    {
        try {
            return $this->baseModel->count();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }


}
