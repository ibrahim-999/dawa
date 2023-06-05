<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\VariantServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Http\Requests\Product\VariantWithValuesRequest;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class VariantService implements VariantServiceContract, CrudContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;
    private Model|Builder $product;

    public function __construct()
    {
        $this->baseModel = new Variant();
    }

    public function search(Request $request): ?VariantServiceContract
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
                        $q->whereHas('product', function ($q) use ($request) {
                            $q->whereIn('category_id', $request->categories)
                                ->orWhereIn('sub_category_id', $request->categories)
                                ->orWhereIn('subset_category_id', $request->categories);
                        });
                    });
                })
                ->when($request->brands, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        $q->whereHas('product', function ($q) use ($request) {
                            $q->whereIn('brand_id', $request->brands);
                        });
                    });
                })
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->sort_key, function ($q) use ($request) {
                    if ($request->sort_key == 'price') {
                        $q->orderBy('price', $request->sort_type ?? 'asc');
                    }
                });

            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


    public function activeCategories(): ?VariantServiceContract
    {
        try {
            $this->baseModel = $this->baseModel->active();
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function grandParents(): ?VariantServiceContract
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
            $data = [
                'en'=>[
                    'title'=>$request->en['title'],
                    'description'=>$request->en['description'],
                    'specifications'=>$request->en['specifications']
                ],
                'ar'=>[
                    'title'=>$request->ar['title'],
                    'description'=>$request->ar['description'],
                    'specifications'=>$request->ar['specifications']
                ],
                'price'=>$request->price,
                'discount_percentage'=>$request->discount ?? 0,
                'is_active'=>(bool)$request->is_active,
                'product_id'=>$this->product->id,
            ];

            $variant = $this->baseModel->create($data);
            if ($variant) {
                foreach ($request->values as $attribute=>$value)
                {
                    $variant->values()->create(
                        [
                            'product_id'=>$this->product->id,
                            'variant_id'=>$variant->id,
                            'attribute_id'=>$attribute,
                            'attribute_value_id'=>$value,
                        ]
                    );
                }
            }
            return $variant;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function setProduct(Model|Builder $query):CrudContract
    {
        try {
            $this->product = $query;
            return $this;
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


    public function minPrice()
    {
        try {
            return $this->baseModel->min('price');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function maxPrice()
    {
        try {
            return $this->baseModel->max('price');
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function getInfo() :array
    {
        try {
            return [
                'max_price' => $this->maxPrice(),
                'min_price' => $this->minPrice(),
                'count' => $this->count(),
                ];
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function withAttributes(VariantWithValuesRequest $request) :?Model
    {
        try {
            return $this->baseModel
                ->where('product_id',$request->product_id)
                ->whereHas('values',function ($q) use($request){
                    foreach ($request->values as $value)
                    {
                        $q->where('attribute_id',$value['attribute_id'])->where('attribute_value_id',$value['value']) ;
                    }
                })->first();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    //review
    public function review(Variant $variant,Request $request): bool
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            return (bool) $variant->reviews()->updateOrCreate(['user_id' => $data['user_id']],$data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

}
