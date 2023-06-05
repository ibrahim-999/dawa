<?php

namespace App\Http\Controllers\Api\User\V1;

use App\Domains\User\v1\Services\AddressService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\User\AddressStoreRequest;
use App\Http\Requests\User\AddressUpdateRequest;
use App\Http\Resources\User\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends ApiController
{
    private AddressService $addressService;

    public function __construct(
        AddressService $addressService,
    )
    {
        $this->addressService = $addressService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_size=$request->page_size ?? 10 ;
        $data =AddressResource::collection($this->addressService->paginate_simple($page_size))->resource->toArray();
        $data_array=['addresses'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array, $data, 'addresses');
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(AddressStoreRequest $request)
    {
        $address = $this->addressService->add($request);
        if ($address) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }

    /**
     * Display the specified address by id.
     */
    public function show(int $id)
    {
        $address = $this->addressService->find('id', $id);
        if (!$address) {
            return $this->failResourceNotFoundMessage('address');
        }
        $data = AddressResource::make($address);
        return $this->successShowDataResponse($data, 'address');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressUpdateRequest $request, int $id)
    {

        $hasActiveCart = $this->addressService->hasActiveCart($id);

        if ($hasActiveCart) {
            return $this->failGeneralMessage(__('messages.has_active_cart'));
        }

        $updated = $this->addressService->update($request, $id);

        if ($updated) {
            $address = $this->addressService->find('id', $id);
            return $this->successUpdateWithContentResponse(AddressResource::make($address));
        } else {
            return $this->failUpdateMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $address = $this->addressService->find('id', $id);

        if (!$address) {
            return $this->failResourceNotFoundMessage('address');
        }

        $deleted = $this->addressService->delete($address);

        if (!$deleted) {
            return $this->failDeleteMessage();
        }

        return $this->successDeleteMessage();
    }

    /**
     * Display the specified address by id.
     */
    public function getByPlaceId(Request $request)
    {
        $address = $this->addressService->find('place_id', $request->place_id ?? $request->header('X-Place'));
        if (!$address) {
            return $this->failResourceNotFoundMessage('address');
        }
        $data = AddressResource::make($address);
        return $this->successShowDataResponse($data, 'address');
    }
}
