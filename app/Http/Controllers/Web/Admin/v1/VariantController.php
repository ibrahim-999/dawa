<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\ProductAttributeService;
use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AttributeStoreRequest;
use App\Http\Requests\Product\AttributeUpdateRequest;
use App\Http\Requests\Product\VariantStoreRequest;
use App\Http\Requests\Product\VariantUpdateRequest;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VariantController extends Controller
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



    public function store(Product $product, VariantStoreRequest $request)
    {
        $attribute = $this->variantService->setProduct($product)->add($request);

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


    public function destroy(Variant $variant)
    {
        $deleted = $this->variantService->delete($variant);
        if ($deleted) {
            return Redirect::back()->with('success', __('messages.variant_deleted_successfully'));
        } else {
            return Redirect::back();
        }
    }


    public function update(Variant $variant, VariantUpdateRequest $request)
    {
        $updated = $this->variantService->setBuilder($variant)->update($request);
        if ($updated) {
            return Redirect::route('products.index')->with('success', __('messages.product_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

    public function show(Variant $variant)
    {
        return view('admin/v1/product/partials/variant/show', compact('variant'));
    }
}
