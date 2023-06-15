<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\CouponServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\User\v1\Enums\OfferProductTypeEnum;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class OfferService implements CouponServiceContract, CrudContract
{
    private Model|Builder $offerModel;

    public function __construct()
    {
        $this->offerModel = new Offer();
    }

    public function sort($key,$type)
    {
        try {
            $this->offerModel->orderBy($key, $type);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function select(array $columns): ?CouponServiceContract
    {
        try {
            $this->offerModel = $this->offerModel->select($columns);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function with(array $relations): ?CouponServiceContract
    {
        try {
            $this->offerModel = $this->offerModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();

            $offerData = $request->except('buyVariants', 'getVariants');

            $offer = $this->offerModel->create($offerData);

            if (isset($data['buyVariants'])) {
                $buyVariantsData = [];
                foreach ($data['buyVariants'] as $variantId) {
                    $buyVariantsData[]=['variant_id' => $variantId, 'type' => OfferProductTypeEnum::BUY->value];
                }
                $offer->offerVariants()->createMany($buyVariantsData);
            }

            if (isset($data['getVariants'])) {
                $getVariantsData = [];
                foreach ($data['getVariants'] as $variantId) {
                    $getVariantsData[]=['variant_id' => $variantId, 'type' => OfferProductTypeEnum::GET->value];
                }
                $offer->offerVariants()->createMany($getVariantsData);
            }

            if ($request->hasFile('image')) {
                $offer->addMediaFromRequest('image')->toMediaCollection('images');
            }

            return $offer;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            return $this->offerModel->where($key, $value)->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function setBuilder(Model|Builder $query):CrudContract
    {
        try {
            $this->offerModel = $query;
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function update(Request $request): bool
    {
        try {
            $data = $request->validated();

            if (isset($data['buyVariants'])) {
                $this->offerModel->offerVariants()->where('type',OfferProductTypeEnum::BUY->value)->whereNotIn('id', $data['buyVariants'])->delete();
                foreach ($data['buyVariants'] as $variantId) {
                    $this->offerModel->offerVariants()->updateOrCreate(['variant_id' => $variantId, 'type' => OfferProductTypeEnum::BUY->value]);
                }
            }

            if (isset($data['getVariants'])) {
                $this->offerModel->offerVariants()->where('type',OfferProductTypeEnum::GET->value)->whereNotIn('id', $data['getVariants'])->delete();
                foreach ($data['getVariants'] as $variantId) {
                    $this->offerModel->offerVariants()->updateOrCreate(['variant_id' => $variantId, 'type' => OfferProductTypeEnum::GET->value]);
                }
            }

            if ($request->hasFile('image')) {
                $this->offerModel->clearMediaCollection('images');
                $this->offerModel->addMediaFromRequest('image')->toMediaCollection('images');
            }
            return $this->offerModel->update($data);
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
            return $this->offerModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate(int $itemsPerPage): LengthAwarePaginator
    {
        try {
            return $this->offerModel->paginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            return $this->offerModel->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getValid(): ?CouponServiceContract
    {
        try {
            $this->offerModel = $this->offerModel->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now());
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
