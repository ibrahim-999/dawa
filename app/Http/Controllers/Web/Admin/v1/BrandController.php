<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\BrandService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\BrandStoreRequest;
use App\Http\Requests\Product\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{

    private BrandService $brandService;


    public function __construct(
        BrandService       $brandService,

    )
    {
        $this->brandService = $brandService;

        $this->middleware('permission:create_brands', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_brands', ['only' => ['show']]);
        $this->middleware('permission:update_brands', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_brands', ['only' => ['index']]);
        $this->middleware('permission:delete_brands', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $brands = $this->brandService->with(['translation']);
        $brands = $brands->search($request)
            ->sort('id','DESC')
            ->paginate($itemsPerPage);
        return view('admin/v1/brand/index', compact('brands'));
    }

    public function create()
    {
        return view('admin/v1/brand/create');
    }

    public function store(BrandStoreRequest $request)
    {

        $brand = $this->brandService->add($request);
        if ($brand) {
            return Redirect::route('brands.index')->with('success', __('messages.brand_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Brand $brand)
    {
        $pharmacies = $brand->pharmacies()->paginate(10);
        $accesses = $brand->accesses;
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/brand/show', compact('brand','pharmacies','accesses','vendors'));
    }

    public function destroy(Brand $brand)
    {
        $deleted = $this->brandService->delete($brand);
        if ($deleted) {
            return Redirect::route('brands.index')->with('success', __('messages.brand_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('brands.index')->with('success', __('messages.brand_deleted_successfully'));
    }

    public function edit(Brand $brand)
    {
        return view('admin/v1/brand/edit', compact('brand'));
    }

    public function update(Brand $brand, BrandUpdateRequest $request)
    {
        $updated = $this->brandService->setBuilder($brand)->update($request);
        if ($updated) {
            return Redirect::route('brands.index')->with('success', __('messages.brand_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
