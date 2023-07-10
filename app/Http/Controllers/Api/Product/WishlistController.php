<?php

namespace App\Http\Controllers\Api\Product;

use App\Domains\Product\v1\Services\VariantService;
use App\Domains\Product\v1\Services\WishlistService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\WishlistRequest;
use App\Http\Resources\Products\VariantsResource;
use App\Http\Resources\Products\WishlistResource;
use Illuminate\Http\Request;

class WishlistController extends ApiController
{
    private WishlistService $wishlistService;
    private VariantService $variantService;
    private UserService $userService;

    public function __construct(
        WishlistService $wishlistService,
        UserService $userService,
        VariantService $variantService,
    )
    {
        $this->wishlistService = $wishlistService;
        $this->userService = $userService;
        $this->variantService = $variantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page_size=$request->page_size ?? 10 ;
        $variants =$this->variantService
            ->wishList()
            ->with(['translation'])
            ->search($request)
            ->sort('id','DESC')
            ->paginate_simple($page_size);
        $data= VariantsResource::collection($variants)->resource->toArray();
        $data_array=['wishlist'=>$data];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'wish_list');
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(WishlistRequest $request)
    {
        $wishlist = $this->wishlistService->add($request);
        if ($wishlist) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishlistRequest $request)
    {
        $wishlist = $this->wishlistService->find('variant_id', $request->variant_id);

        if (!$wishlist) {
            return $this->failResourceNotFoundMessage('wishlist');
        }

        $deleted = $this->wishlistService->delete($wishlist);

        if (!$deleted) {
            return $this->failDeleteMessage();
        }

        return $this->successDeleteMessage();
    }
}
