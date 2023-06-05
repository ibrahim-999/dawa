<?php

namespace App\Http\Controllers\Api\Product;

use App\Domains\Product\v1\Services\ProductService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends ApiController
{
    private ProductService $productService;

    public function __construct(
        ProductService $productService,
    )
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 10;
        $data_size = $request->data_size ?? 'medium';
        $products = $this->productService
            ->with(['category', 'sub_category', 'subset_category', 'brand', 'variants', 'attributes', 'translation','attributes.values'])
            ->sort('id','DESC')
            ->paginate_simple($page_size);
        $data= ProductResource::customCollection($data_size, $products)->resource->toArray();
        $data_array=['products'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'products_list');
    }

    public function show($product_id, Request $request)
    {
        $data_size = $request->data_size ?? 'medium';
        $product = $this->productService->find('id', $product_id);
        if (!$product) {
            return $this->failResourceNotFoundMessage('categories_item');
        }
        $product = $product
            ->load(['category', 'sub_category', 'subset_category', 'brand', 'variants', 'attributes', 'translation','attributes.values']);
        $data = ProductResource::customItem($data_size, $product);
        return $this->successShowDataResponse($data, 'products_show');
    }


}
