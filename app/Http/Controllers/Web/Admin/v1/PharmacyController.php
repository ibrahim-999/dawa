<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Pharmacy\v1\Services\ChainService;
use App\Domains\Pharmacy\v1\Services\PharmacyService;
use App\Domains\Product\v1\Services\CategoryService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\PharmacyStoreRequest;
use App\Http\Requests\Pharmacy\PharmacyUpdateRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PharmacyController extends Controller
{
    /// review all function
    private PharmacyService $pharmacyService;
    private ChainService $chainService;
    private VendorService $vendorService;



    public function __construct(
        PharmacyService $pharmacyService,
        ChainService    $chainService,
        VendorService   $vendorService,

    )
    {
        $this->pharmacyService = $pharmacyService;
        $this->chainService = $chainService;
        $this->vendorService = $vendorService;

        $this->middleware('permission:create_pharmacies', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_pharmacies', ['only' => ['show']]);
        $this->middleware('permission:update_pharmacies', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_pharmacies', ['only' => ['index']]);
        $this->middleware('permission:delete_pharmacies', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $pharmacies = $this->pharmacyService->search($request)->paginate($itemsPerPage);
        return view('admin/v1/pharmacy/index', compact('pharmacies'));
    }

    public function create()
    {
        $chains = $this->chainService->list()->all();
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/pharmacy/create',compact('chains','vendors'));
    }

    public function store(PharmacyStoreRequest $request)
    {
        // dd($request->all());
        $pharmacy = $this->pharmacyService->add($request);
        if ($pharmacy) {
            return Redirect::route('pharmacies.index')->with('success', __('messages.pharmacy_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Pharmacy $pharmacy)
    {
        $accesses = $pharmacy->accesses;
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/pharmacy/show', compact('pharmacy','accesses','vendors'));
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $deleted = $this->pharmacyService->delete($pharmacy);
        if ($deleted) {
            return Redirect::route('pharmacies.index')->with('success', __('messages.pharmacy_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('pharmacies.index')->with('success', __('messages.pharmacy_deleted_successfully'));
    }

    public function edit(Pharmacy $pharmacy)
    {
        return view('admin/v1/pharmacy/edit', compact('pharmacy'));
    }

    public function update(Pharmacy $pharmacy, PharmacyUpdateRequest $request)
    {
        $updated = $this->pharmacyService->setBuilder($pharmacy)->update($request);
        if ($updated) {
            return Redirect::route('pharmacies.index')->with('success', __('messages.pharmacy_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
