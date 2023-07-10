<?php

namespace App\Http\Controllers\Api\Product;

use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\ReviewRequest;
use App\Http\Requests\Product\VariantWithValuesRequest;
use App\Http\Resources\Products\VariantsResource;
use Illuminate\Http\Request;


class VariantController extends ApiController
{
    private VariantService $variantService;
    private ProductService $productService;

    public function __construct(
        VariantService $variantService,
        ProductService $productService,
    )
    {
        $this->variantService = $variantService;
    }

    public function index(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;
        $variants = $this->variantService
            ->with(['product','translation'])
            ->search($request)
            ->sort('id','DESC')
            ->paginate_simple($page_size);
        $data= VariantsResource::collection($variants)->resource->toArray();
        $data_array=['variants'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'variant_list');
    }
    public function VariantsInfo(Request $request)
    {
        $data = $this->variantService
            ->with(['product','translation'])
            ->search($request)
            ->getInfo();
        return $this->successShowDataResponse($data, 'variants_statistics');
    }

    public function show($variant_id)
    {
        $variant = $this->variantService->find('id', $variant_id);
        if (!$variant) {
            return $this->failResourceNotFoundMessage('variants_item');
        }
        $variant = $variant
            ->load(['product','translation','values','product'])
            ->load(['product.category', 'product.sub_category', 'product.subset_category', 'product.brand', 'product.variants', 'product.attributes', 'product.translation']);
        $data = VariantsResource::make($variant);
        return $this->successShowDataResponse($data, 'variants_item');
    }
    public function variantWithAttributes(VariantWithValuesRequest $request)
    {
        $variant = $this->variantService->withAttributes($request);
        if (!$variant) {
            return $this->failResourceNotFoundMessage('variants_item');
        }
        $variant = $variant
            ->load(['product','translation','values','product'])
            ->load(['product.category', 'product.sub_category', 'product.subset_category', 'product.brand', 'product.variants', 'product.attributes', 'product.translation']);
        $data = VariantsResource::make($variant);
        return $this->successShowDataResponse($data, 'variants_item');
    }

    // review product
    public function review($variant_id, ReviewRequest $request)
    {
        //TODO: check if user order variant before.
        $variant = $this->variantService->find('id', $variant_id);

        if (!$variant) {
            return $this->failResourceNotFoundMessage('variants_item');
        }

        $review = $this->variantService->review($variant, $request);

        if ($variant) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }
}
