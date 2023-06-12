<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\Product\v1\Services\CategoryService;
use App\Domains\Product\v1\Services\CouponService;
use App\Domains\Product\v1\Services\ProductService;
use App\Domains\Product\v1\Services\VariantService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreCouponRequest;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminStoreUserRequest;
use App\Http\Requests\Admin\AdminUpdateCouponRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Requests\Admin\AdminUpdateUserRequest;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{

    private AdminAccessService $accessService;
    private CouponService $couponService;

    public function __construct(
        AdminAccessService $accessService,
        CouponService       $couponService,
        private ProductService $productService,
        private CategoryService $categoryService,
    )
    {
        $this->accessService = $accessService;
        $this->couponService = $couponService;

        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_users', ['only' => ['show']]);
        $this->middleware('permission:update_users', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_users', ['only' => ['index']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $coupons = $this->couponService->paginate($itemsPerPage);
        return view('admin/v1/coupon/index', compact('coupons'));
    }

    public function create()
    {
        $products = $this->productService->with(['translation'])->index();
        $categories = $this->categoryService->with(['childs','translation'])->index();
        return view('admin/v1/coupon/create',compact('products','categories'));
    }

    public function store(AdminStoreCouponRequest $request)
    {
        // dd($request->all());
        $coupon = $this->couponService->add($request);
        if ($coupon) {
            return Redirect::route('coupons.index')->with('success', __('messages.coupon_created_successfully'));
        } else {
            return Redirect::back();
        }
    }


    public function destroy(Coupon $coupon)
    {
        $deleted = $this->couponService->delete($coupon);
        if ($deleted) {
            return Redirect::route('coupons.index')->with('success', __('messages.coupon_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('coupons.index')->with('success', __('messages.coupon_deleted_successfully'));
    }

    public function edit(Coupon $coupon)
    {
        $products = $this->productService->with(['translation'])->index();
        $categories = $this->categoryService->with(['childs','translation'])->index();
        return view('admin/v1/coupon/edit', compact('coupon','products','categories'));
    }

    public function update(Coupon $coupon, AdminUpdateCouponRequest $request)
    {
        $updated = $this->couponService->setBuilder($coupon)->update($request);
        if ($updated) {
            return Redirect::route('coupons.index')->with('success', __('messages.coupon_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
