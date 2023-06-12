<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\CartService;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartsController extends Controller
{

    private CartService $cartService;


    public function __construct(
        CartService $cartService,

    )
    {
        $this->cartService = $cartService;

        $this->middleware('permission:show_carts', ['only' => ['show']]);
        $this->middleware('permission:index_carts', ['only' => ['index']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $carts = $this->cartService;
        $carts = $carts->setBuilder(Cart::where('is_current','1'))
            ->sort('id', 'DESC')
            ->paginate($itemsPerPage);

         return view('admin/v1/cart/index', compact('carts'));
    }

    public function show(Cart $cart)
    {
        return view('admin/v1/cart/show', compact('cart'));
    }
}
