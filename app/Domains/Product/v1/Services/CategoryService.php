<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\CategoryServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class CategoryService implements CategoryServiceContract, CrudContract
{
    private Model|Builder $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function search(Request $request): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->when($request->search,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->whereTranslationLike('title', "%{$request->search}%");
                });
            });
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function sort($key,$type)
    {
        try {
            $this->categoryModel->orderBy($key, $type);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function select(array $columns): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->select($columns);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function with(array $relations): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function activeCategories(): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->active();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function parentableCategories(): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->parentable();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function grandParents(): ?CategoryServiceContract
    {
        try {
            $this->categoryModel = $this->categoryModel->grandParents();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $category = $this->categoryModel->create($data);
            if ($request->invite) {
                //TODO:Send Invitation mail
            }
            return $category;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->categoryModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query):CrudContract
    {
        try {
            $this->categoryModel = $query;
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
            return $this->categoryModel->update($data);
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

    public function index(): Collection
    {
        try {
            return $this->categoryModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->categoryModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->categoryModel->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function count(): int
    {
        try {
            return $this->categoryModel->count();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function reset()
    {
        return new CategoryService();
    }

}
