<?php

namespace App\Domains\User\v1\Services\Contracts;

use App\Models\Cart;
use Illuminate\Http\Request;

interface CreateOrderInterface
{
    public function create(Request $request);
}
