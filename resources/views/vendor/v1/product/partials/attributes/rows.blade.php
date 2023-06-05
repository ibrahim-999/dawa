@foreach($attributes as $attribute)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="attributeCheck{{$attribute->id}}">
                <label class="custom-control-label" for="attributeCheck{{$attribute->id}}">{{$loop->iteration}}</label>
            </div>
        </td>
        <td class="table-user">
            {{$attribute->name}}
        </td>
        <td>
            @if($product->is_active)
                <span class="badge bg-success text-white">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-danger text-white">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            @include('admin.v1.product.partials.attributes.values.table')

        </td>
        <td>
            @include('admin.v1.product.partials.attributes.action-btns')
        </td>
    </tr>
@endforeach
