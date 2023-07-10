@foreach($variants as $variant)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="variantCheck{{$variant->id}}">
                <label class="custom-control-label" for="variantCheck{{$variant->id}}">{{$loop->iteration}}</label>
            </div>
        </td>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/companies/amazon.png')}}" alt="table-user"
                 class="mr-2 rounded-circle">
           <a href="{{route('variants.show',$variant->id)}}" class="text-body font-weight-semibold">
                {{$variant->title}}
           </a>
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
            @include('admin.v1.product.partials.variant.action-btns')
        </td>
    </tr>
@endforeach
