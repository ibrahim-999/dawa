<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Vendor\v1\Services\VendorAccessService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorStoreRequest;
use App\Http\Requests\Vendor\VendorUpdateRequest;
use App\Http\Resources\Driver\AuthDriverData;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{

    private VendorAccessService $accessService;
    private VendorService $vendorService;


    public function __construct(
        VendorAccessService $accessService,
        VendorService       $vendorService,
    )
    {
        $this->accessService = $accessService;
        $this->vendorService = $vendorService;

        $this->middleware('permission:create_vendors', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_vendors', ['only' => ['show']]);
        $this->middleware('permission:update_vendors', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_vendors', ['only' => ['index']]);
        $this->middleware('permission:delete_vendors', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $vendors = $this->vendorService->search($request)->paginate($itemsPerPage);
        return view('admin/v1/vendor/index', compact('vendors'));
    }

    public function create()
    {
        $roles = $this->vendorService->getVendorsRoles();
        return view('admin/v1/vendor/create',compact('roles'));
    }

    public function store(VendorStoreRequest $request)
    {

        $vendor = $this->vendorService->add($request);
        if ($vendor) {
            return Redirect::route('admin.vendors.index')->with('success', __('messages.vendor_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Vendor $vendor)
    {
        return Redirect::route('vendors.show', compact('vendor'));
    }

    public function destroy(Vendor $vendor)
    {
        $deleted = $this->vendorService->delete($vendor);
        if ($deleted) {
            return Redirect::route('admin.vendors.index')->with('success', __('messages.vendor_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('admin.vendors.index')->with('success', __('messages.vendor_deleted_successfully'));
    }

    public function edit(Vendor $vendor)
    {
        $roles = $this->vendorService->getVendorsRoles();
        return view('admin/v1/vendor/edit', compact('vendor','roles'));
    }

    public function update(Vendor $vendor, VendorUpdateRequest $request)
    {
        $updated = $this->vendorService->setBuilder($vendor)->update($request);
        if ($updated) {
            return Redirect::route('admin.vendors.index')->with('success', __('messages.vendor_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
