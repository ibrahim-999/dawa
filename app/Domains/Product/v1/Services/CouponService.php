<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\CategoryServiceContract;
use App\Domains\Product\v1\Contracts\Services\CouponServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class CouponService implements CouponServiceContract, CrudContract
{
    private Model|Builder $couponModel;

    public function __construct()
    {
        $this->couponModel = new Coupon();
    }

    public function sort($key,$type)
    {
        try {
            $this->couponModel->orderBy($key, $type);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function select(array $columns): ?CouponServiceContract
    {
        try {
            $this->couponModel = $this->couponModel->select($columns);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function with(array $relations): ?CouponServiceContract
    {
        try {
            $this->couponModel = $this->couponModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            // dd($data);
            $couponData = $request->except('categories', 'products');
            // dd($couponData);
            $coupon = $this->couponModel->create($couponData);
            if (isset($data['categories'])) {
                $categoriesData = [];
                foreach ($data['categories'] as $categoryId) {
                    $categoriesData[]=['model_id' => $categoryId, 'model_type' => 'category'];
                }
                $coupon->categories()->createMany($categoriesData);
            }
            if (isset($data['products'])) {
                $productsData = [];
                foreach ($data['products'] as $productId) {
                    $productsData[]=['model_id' => $productId, 'model_type' => 'product'];
                }
                $coupon->products()->createMany($productsData);
            }
            return $coupon;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->couponModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query):CrudContract
    {
        try {
            $this->couponModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->validated();

            if (isset($data['categories'])) {
                $this->couponModel->categories()->whereNotIn('id', $data['categories'])->delete();
                foreach ($data['categories'] as $categoryId) {
                    $this->couponModel->categories()->updateOrCreate(['model_id' => $categoryId, 'model_type' => 'category']);
                }
            }

            if (isset($data['products'])) {
                $this->couponModel->products()->whereNotIn('id', $data['products'])->delete();
                foreach ($data['products'] as $productId) {
                    $this->couponModel->products()->updateOrCreate(['model_id' => $productId, 'model_type' => 'product']);
                }
            }

            return $this->couponModel->update($data);
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
            return $this->couponModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->couponModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->couponModel->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function count(): int
    {
        try {
            return $this->couponModel->count();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function reset()
    {
        return new CategoryService();
    }


    public function validateCoupon($coupon, $cart)
    {
        $dateNow = Carbon::now();

        $startDate = Carbon::createFromFormat('Y-m-d', $coupon->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $coupon->end_date);

        if (! (($startDate->gte($dateNow) || $startDate->lte($dateNow) ) && $endDate->gte($dateNow) )) {
            return false;
        }

        $couponPersonUsagesCount = CouponUsage::where('user_id',$cart->user_id)->where('coupon_id',$coupon->id)->where('status',1)->count();
        $couponAllUsagesCount = CouponUsage::where('coupon_id',$coupon->id)->where('status',1)->count();
        
        if (($couponPersonUsagesCount >= $coupon->num_uses_person ) || ($couponAllUsagesCount >=  $coupon->num_uses) || !$cart->variants->count()) {
            return false;
        }
        
        if ($cart->getTotalPriceAttribute() < $coupon->min_purchases) {
            return false;
        }

        return true;
    }

}
