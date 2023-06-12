 @foreach($cart->variants as $variant)
     <tr>
        <td class="table-user">

            {{$variant->product->title??'-'}}
        </td>
        <td class="table-user">
            {{$variant->price ??'-'}}
        </td>

        <td class="table-user">
            {{$variant->pivot->quantity??'-'}}
        </td>
        <td class="table-user">
            {{$variant->created_at??'-'}}
        </td>
    </tr>
@endforeach
