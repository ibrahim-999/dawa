@foreach($coupons as $coupon)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$coupon->code}}</a>
        </td>

        <td>
            {{$coupon->start_date}}
        </td>
        <td>
            {{$coupon->end_date}}
        </td>
        <td>
            @if($coupon->is_active)
                <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            {{$coupon->created_at}}
        </td>
        <td>
            {{$coupon->updated_at}}
        </td>
        <td>
            @include('admin.v1.coupon.partials.action-btns')
        </td>
    </tr>
@endforeach
