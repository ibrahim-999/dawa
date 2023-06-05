<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Pharmacy\v1\Services\ChainService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pharmacy\ChainStoreRequest;
use App\Http\Requests\Pharmacy\ChainUpdateRequest;
use App\Models\Chain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ChainController extends Controller
{

    private ChainService $chainService;
    private VendorService $vendorService;


    public function __construct(
        ChainService       $chainService,
        VendorService       $vendorService,

    )
    {
        $this->chainService = $chainService;
        $this->vendorService = $vendorService;

        $this->middleware('permission:create_chains', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_chains', ['only' => ['show']]);
        $this->middleware('permission:update_chains', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_chains', ['only' => ['index']]);
        $this->middleware('permission:delete_chains', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $chains = $this->chainService->search($request)->paginate($itemsPerPage);
        return view('admin/v1/chain/index', compact('chains'));
    }

    public function create()
    {
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/chain/create',compact('vendors'));
    }

    public function store(ChainStoreRequest $request)
    {

        $chain = $this->chainService->add($request);
        if ($chain) {
            return Redirect::route('chains.index')->with('success', __('messages.chain_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Chain $chain)
    {
        $pharmacies = $chain->pharmacies()->paginate(10);
        $accesses = $chain->accesses;
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/chain/show', compact('chain','pharmacies','accesses','vendors'));
    }

    public function destroy(Chain $chain)
    {
        $deleted = $this->chainService->delete($chain);
        if ($deleted) {
            return Redirect::route('chains.index')->with('success', __('messages.chain_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('chains.index')->with('success', __('messages.chain_deleted_successfully'));
    }

    public function edit(Chain $chain)
    {
        $vendors = $this->vendorService->list()->all();
        return view('admin/v1/chain/edit', compact('chain','vendors'));
    }

    public function update(Chain $chain, ChainUpdateRequest $request)
    {
        $updated = $this->chainService->setBuilder($chain)->update($request);
        if ($updated) {
            return Redirect::route('chains.index')->with('success', __('messages.chain_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
