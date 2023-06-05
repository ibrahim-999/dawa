@foreach($products as $product)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/companies/amazon.png')}}" alt="table-user"
                 class="mr-2 rounded-circle">
            <a href="{{route('products.show',$product->id)}}" class="text-body font-weight-semibold">{{$product->title}}</a>
        </td>
        <td>
            {{$product->brand?->title}}
        </td>
        <td>
            <div class="badge bg-primary text-white ">{{$product->category?->title}}</div>
            <div class="badge bg-secondary text-white">{{$product->sub_category?->title}}</div>
            <div class="badge bg-success text-white">{{$product->subset_category?->title}}</div>

        </td>
        <td>
            @if($product->is_active)
                <span class="badge bg-success text-white">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-danger text-white">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            @include('admin.v1.product.partials.action-btns')
        </td>
    </tr>
@endforeach
