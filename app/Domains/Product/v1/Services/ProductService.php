<?php

namespace App\Domains\Product\v1\Services;

use App\Domains\Product\v1\Contracts\Services\ProductServiceContract;
use App\Domains\Shared\v1\Contracts\Services\CrudContract;
use App\Domains\Shared\v1\Traits\CommonServiceCrudTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class ProductService implements ProductServiceContract, CrudContract
{
    use CommonServiceCrudTrait;
    private Model|Builder $baseModel;

    public function __construct()
    {
        $this->baseModel = new Product();
    }

    public function search(Request $request): ?ProductServiceContract
    {
        try {
            $this->baseModel = $this->baseModel->when($request->title,function ($q) use ($request){
                $q->where(function ($q) use ($request) {
                    $q->whereTranslationLike('title', "%{$request->title}%");
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
            //TODO::code enhance
            $category=Category::findOrFail($request->category_id);
            if ($category->level == 3){
                $data['category_id']=$category->parent->parent->id;
                $data['sub_category_id']=$category->parent->id;
                $data['subset_category_id']=$category->id;
            }elseif($category->level == 2)
            {
                $data['category_id']=$category->parent->id;
                $data['sub_category_id']=$category->id;
            }else
            {
                $data['category_id']=$category->id;
            }
            $data['brand_id']=$request->brand_id;
            $product = $this->baseModel->create($data);
            if ($request->invite) {
                //TODO:Send Invitation mail
            }
            return $product;
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
            $data = $request->validated();
            $category=Category::findOrFail($request->category_id);
            $data['category_id']=null;
            $data['sub_category_id']=null;
            $data['subset_category_id']=null;

            if ($category->level == 3){
                $data['category_id']=$category->parent->parent->id;
                $data['sub_category_id']=$category->parent->id;
                $data['subset_category_id']=$category->id;
            }elseif($category->level == 2)
            {
                $data['category_id']=$category->parent->id;
                $data['sub_category_id']=$category->id;
            }else
            {
                $data['category_id']=$category->id;
            }
            $data['brand_id']=$request->brand_id;
            return $this->baseModel->update($data);
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }


}
