<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\ProductAttributeService;
use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AttributeStoreRequest;
use App\Http\Requests\Product\AttributeUpdateRequest;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductAttributeController extends Controller
{

    private ProductService $productService;
    private VariantService $variantService;
    private ProductAttributeService $productAttributeService;


    public function __construct(
        ProductService       $productService,
        VariantService $variantService,
        ProductAttributeService $productAttributeService,

    )
    {
        $this->productService = $productService;
        $this->variantService = $variantService;
        $this->productAttributeService = $productAttributeService;

        $this->middleware('permission:create_products', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_products', ['only' => ['show']]);
        $this->middleware('permission:update_products', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_products', ['only' => ['index']]);
        $this->middleware('permission:delete_products', ['only' => ['destroy']]);

    }



    public function store(Product $product,AttributeStoreRequest $request)
    {
        $attribute = $this->productAttributeService->setProduct($product)->add($request,$product);

        if ($attribute) {
            if ($request->ajax()) {
                return $this->successGeneralMessage(__('messages.created_successfully'));
            } else {
                return Redirect::back()->with('success', __('messages.created_successfully'));
            }
        } else {
            if ($request->ajax()) {
                return $this->failGeneralMessage(__('messages.creation_failed'));
            } else {
                return Redirect::back()->with('success', __('messages.creation_failed'));
            }
        }

    }


    public function destroy(Attribute $attribute)
    {
        $deleted = $this->productAttributeService->delete($attribute);
        if ($deleted) {
            return Redirect::back()->with('success', __('messages.product_deleted_successfully'));
        } else {
            return Redirect::back();
        }
    }


    public function update(Attribute $attribute, AttributeUpdateRequest $request)
    {
        $updated = $this->productAttributeService->setBuilder($attribute)->update($request);
        if ($updated) {
            if ($request->ajax()) {
                return $this->successGeneralMessage(__('messages.updated_successfully'));
            } else {
                return Redirect::back()->with('success', __('messages.updated_successfully'));
            }
        } else {
            if ($request->ajax()) {
                return $this->failGeneralMessage(__('messages.update_failed'));
            } else {
                return Redirect::back()->with('success', __('messages.update_failed'));
            }
        }
    }

}
