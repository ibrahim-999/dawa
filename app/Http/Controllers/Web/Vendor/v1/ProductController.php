<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\BrandService;
use App\Domains\Product\v1\Services\CategoryService;
use App\Domains\Product\v1\Services\ProductAttributeService;
use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    private ProductService $productService;
    private VariantService $variantService;
    private ProductAttributeService $productAttributeService;
    private CategoryService $categoryService;
    private BrandService $brandService;


    public function __construct(
        ProductService       $productService,
        VariantService $variantService,
        ProductAttributeService $productAttributeService,

    )
    {
        $this->productService = $productService;
        $this->variantService = $variantService;
        $this->productAttributeService = $productAttributeService;
        $this->categoryService = new CategoryService();
        $this->brandService = new BrandService();

        $this->middleware('permission:create_products', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_products', ['only' => ['show']]);
        $this->middleware('permission:update_products', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_products', ['only' => ['index']]);
        $this->middleware('permission:delete_products', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $products = $this->productService->with(['translation']);
        $products = $products->search($request)
            ->sort('id','DESC')
            ->paginate($itemsPerPage);

        return view('admin/v1/product/index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->with(['childs','translation']);
        $categories = $categories
            ->activeCategories()
            ->grandParents()
            ->sort('id','DESC')
            ->index();
        $brands=$this->brandService->activeBrands()->index()->pluck('title','id');
        return view('admin/v1/product/create',compact('categories','brands'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->add($request);
        if ($product) {
            return Redirect::route('products.index')->with('success', __('messages.product_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Product $product)
    {
        $variants = $this->variantService->with(['translation']);
        $variants = $variants->where('product_id','=',$product->id)
            ->sort('id','DESC')
            ->index();

        $attributes = $this->productAttributeService->with(['translation']);
        $attributes = $attributes->where('product_id','=',$product->id)
            ->sort('id','DESC')
            ->index();
        return view('admin/v1/product/show', compact('product','variants','attributes'));
    }

    public function destroy(Product $product)
    {
        $deleted = $this->productService->delete($product);
        if ($deleted) {
            return Redirect::route('products.index')->with('success', __('messages.product_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('products.index')->with('success', __('messages.product_deleted_successfully'));
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->with(['childs','translation']);
        $categories = $categories
            ->activeCategories()
            ->grandParents()
            ->sort('id','DESC')
            ->index();
        $brands=$this->brandService->activeBrands()->index()->pluck('title','id');
        return view('admin/v1/product/edit', compact('product','categories','brands'));
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {
        $updated = $this->productService->setBuilder($product)->update($request);
        if ($updated) {
            return Redirect::route('products.index')->with('success', __('messages.product_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
