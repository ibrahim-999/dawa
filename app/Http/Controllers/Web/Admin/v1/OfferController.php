<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Admin\v1\Services\AdminAccessService;
use App\Domains\Product\v1\Services\OfferService;
use App\Domains\Product\v1\Services\VariantService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreOfferRequest;
use App\Http\Requests\Admin\AdminUpdateOfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OfferController extends Controller
{

    public function __construct(
        private AdminAccessService $accessService,
        private VariantService $variantService,
        private OfferService $offerService,
    )
    {
        $this->accessService = $accessService;
        $this->offerService = $offerService;
        $this->variantService = $variantService;

        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_users', ['only' => ['show']]);
        $this->middleware('permission:update_users', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_users', ['only' => ['index']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $offers = $this->offerService->paginate($itemsPerPage);
        return view('admin/v1/offer/index', compact('offers'));
    }

    public function create()
    {
        $variants = $this->variantService->with(['translation'])->index();
        return view('admin/v1/offer/create',compact('variants'));
    }

    public function store(AdminStoreOfferRequest $request)
    {
        // dd($request->all());
        $coupon = $this->offerService->add($request);
        if ($coupon) {
            return Redirect::route('offers.index')->with('success', __('messages.offer_created_successfully'));
        } else {
            return Redirect::back();
        }
    }


    public function destroy(Offer $offer)
    {
        $deleted = $this->offerService->delete($offer);
        if ($deleted) {
            return Redirect::route('offers.index')->with('success', __('messages.offer_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('offers.index')->with('success', __('messages.offer_deleted_successfully'));
    }

    public function edit(Offer $offer)
    {
        $variants = $this->variantService->with(['translation'])->index();
        return view('admin/v1/offer/edit', compact('offer','variants'));
    }

    public function update(Offer $offer, AdminUpdateOfferRequest $request)
    {
        $updated = $this->offerService->setBuilder($offer)->update($request);
        if ($updated) {
            return Redirect::route('offers.index')->with('success', __('messages.offer_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

    public function show(Offer $offer)
    {
        return view('admin/v1/offer/show', compact('offer'));
    }

}
