<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\AttributeValueServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AttributeValueService implements AttributeValueServiceContract, CrudContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;
    private Attribute|Builder $attribute;

    public function __construct()
    {
        $this->baseModel = new AttributeValue();
    }

    public function add(Request $request): ?Model
    {
        try {
            $data = [
                'en'=>['name'=>$request->en['value_title']],
                'ar'=>['name'=>$request->ar['value_title']],
                'attribute_id'=>$this->attribute->id,
                'code'=>$request->code,
            ];
            $attributeValue = $this->baseModel->create($data);
            return $attributeValue;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
    public function setAttribute(Model|Builder $query):CrudContract
    {
        try {
            $this->attribute = $query;
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
                'en'=>['name'=>$request->en['value_title']],
                'ar'=>['name'=>$request->ar['value_title']],
                'code'=>$request->code,
            ];
            return $this->baseModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
