<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\Product\v1\Services\OfferService;
use App\Domains\User\v1\Services\AddressService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\User\AddressStoreRequest;
use App\Http\Requests\User\AddressUpdateRequest;
use App\Http\Resources\Products\OfferResource;
use App\Http\Resources\User\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class OfferController extends ApiController
{

    public function __construct(
        private OfferService $offerService,
    )
    {
        // $this->offerService = $offerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($this->offerService);
        $page_size=$request->page_size ?? 10 ;
        $data = OfferResource::collection($this->offerService->with(['getVariants','buyVariants'])->getValid()->paginate_simple($page_size))->resource->toArray();
        $data_array=['offers'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array, $data, 'offers');
    }


    /**
     * Display the specified address by id.
     */
    public function show(int $id)
    {
        $offer = $this->offerService->find('id', $id);
        if (!$offer) {
            return $this->failResourceNotFoundMessage('address');
        }
        $offer->load(['getVariants','buyVariants']);
        $data = OfferResource::make($offer);
        return $this->successShowDataResponse($data, 'offer');
    }
}
