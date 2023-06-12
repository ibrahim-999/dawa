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
            {{$cart->place->name??'-'}}
        </td>
        <td>
            {{$cart->place->is_current==1?'Yes':'No'}}
        </td>
        <td>
            {{$cart->variants()->sum('quantity')}}
        </td>
        <td>
            {{$cart->created_at??'-'}}
        </td>
        <td>
            @include('admin.v1.cart.partials.action-btns')
        </td>
    </tr>
@endforeach
