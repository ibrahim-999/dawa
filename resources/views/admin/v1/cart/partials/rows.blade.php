@foreach($carts as $cart)
    <tr>

        <td class="table-user">
            <a href="{{route('admin.cart.show',['cart'=>$cart->id])}}">
                {{$cart->user->name??'-'}}
            </a>
        </td>
        <td>
            {{$cart->user->email??'-'}}
        </td>
        <td>
            {{$cart->user->phone??'-'}}
        </td>
        <td>
            {{$cart->address->address??'-'}}
        </td>
        <td>
            {{$cart->total_quantity}}
        </td>
        <td>
            {{$cart->total_price}}
        </td>
        <td>
            {{$cart->created_at??'-'}}
        </td>
        <td>
            @include('admin.v1.cart.partials.action-btns')
        </td>
    </tr>
@endforeach
