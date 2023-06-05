<?php

namespace App\Http\Controllers\Api\Product;

use App\Domains\Product\v1\Services\CategoryService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;


class CategoryController extends ApiController
{
    private CategoryService $categoryService;

    public function __construct(
        CategoryService $categoryService,
    )
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = ($request->without_childs)
            ? $this->categoryService->with(['translation'])
            : $this->categoryService->with(['childs','translation']);
        $categories = $categories->search($request)
            ->activeCategories()
            ->grandParents();
        $page_size=$request->page_size ?? $categories->count() ;
        $categories = $categories->paginate_simple($page_size);
        $data=CategoryResource::collection($categories)->resource->toArray();
        $data_array=['categories'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'categories_list');
    }

    public function show($category_id)
    {
        $category = $this->categoryService->find('id', $category_id);
        if (!$category) {
            return $this->failResourceNotFoundMessage('categories_item');
        }
        $data = CategoryResource::make($category->load('childs','translation'));
        return $this->successShowDataResponse($data, 'categories_item');
    }


}
