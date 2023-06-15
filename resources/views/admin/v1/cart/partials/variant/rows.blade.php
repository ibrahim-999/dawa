 @foreach($cart->variants as $variant)
      <tr>
         <td class="table-user">

             {{$variant->product->title??'-'}}
         </td>
         <td class="table-user">
             {{$variant->price ??'-'}}
         </td>
{{--         <td class="table-user">--}}
{{--             {{$variant->pivot->initial_price ??'-'}}--}}
{{--         </td>--}}
         <td class="table-user">
             {{$variant->pivot->quantity??'-'}}
         </td>
{{--         <td class="table-user">--}}
{{--             {{$variant->pivot->is_modified =='1'?'Yes':'No'}}--}}
{{--         </td>--}}
{{--         <td class="table-user">--}}
{{--             {{$variant->pivot->modification_type ??'-'}}--}}
{{--         </td>--}}
{{--         <td class="table-user">--}}
{{--             {{$variant->pivot->modification_value	 ??'-'}}--}}
{{--         </td>--}}
          <td class="table-user">
              {{round($variant->pivot->quantity * $variant->price)}}
          </td>

{{--         <td class="table-user">--}}
{{--             {{$variant->created_at??'-'}}--}}
{{--         </td>--}}
     </tr>
 @endforeach
