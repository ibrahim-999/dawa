
    <tr>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/companies/amazon.png')}}" alt="table-user"
                 class="mr-2 rounded-circle">
{{--            <a href="{{route('products.show',$variant->id)}}" class="text-body font-weight-semibold">--}}
                {{$variant->title}}
{{--            </a>--}}
        </td>
        <td>
            <div class="badge bg-danger text-white "><del>{{$variant->price}}</del></div>
            <div class="badge bg-success text-white">{{$variant->net_price}}</div>

        </td>
        <td>
            @if($variant->is_active)
                <span class="badge bg-success text-white">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-danger text-white">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            <div class="badge bg-success text-white">{{$qty}}</div>

        </td>
    </tr>
