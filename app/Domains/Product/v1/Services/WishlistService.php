<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\VariantServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Http\Requests\Product\VariantWithValuesRequest;
use App\Models\Variant;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class WishlistService
{
    private Model|Builder $wishlistModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist();
    }

    public function with(array $relations): ?WishlistService
    {
        try {
            $this->wishlistModel = $this->wishlistModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->wishlistModel->where('user_id', request()->user()->id)->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $wishlist = $this->wishlistModel->updateOrCreate($data);
            return $wishlist;
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

    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->wishlistModel->where('user_id', request()->user()->id)->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
