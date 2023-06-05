<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\ProductAttributeServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductAttributeService implements ProductAttributeServiceContract, CrudContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;
    private Model|Builder $product;

    public function __construct()
    {
        $this->baseModel = new Attribute();
    }

    public function add(Request $request): ?Model
    {
        try {
            $data = [
                'en'=>['name'=>$request->en['attribute_title']],
                'ar'=>['name'=>$request->ar['attribute_title']],
                'product_id'=>$this->product->id,
                'type'=>1
            ];
            $attribute = $this->baseModel->create($data);
            return $attribute;
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
    public function setBuilder(Model|Builder $query):CrudContract
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
            $data = [
                'en'=>['name'=>$request->en['attribute_title']],
                'ar'=>['name'=>$request->ar['attribute_title']],
            ];
            return $this->baseModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
