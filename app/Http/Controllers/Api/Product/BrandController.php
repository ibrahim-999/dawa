<?php

namespace App\Http\Controllers\Api\Product;

use App\Domains\Product\v1\Services\BrandService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\BrandResource;
use App\Http\Resources\Products\TitleResource;
use App\Models\Brand;
use Illuminate\Http\Request;


class BrandController extends ApiController
{
    private BrandService $brandService;

    public function __construct(
        BrandService $brandService,
    )
    {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        $brands = $this->brandService->with(['translation'])->search($request);
        $page_size=$request->page_size ?? $brands->count() ;
        $brands=$brands->paginate_simple($page_size);
        $data= BrandResource::collection($brands)->resource->toArray();
        $data_array=['brands'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'brand_list');
    }

    public function show($brand_id)
    {
        $brand = $this->brandService->find('id', $brand_id);
        if (!$brand) {
            return $this->failResourceNotFoundMessage('brands_item');
        }
        $data = BrandResource::make($brand->load('translation'));
        return $this->successShowDataResponse($data, 'brands_item');
    }


}
