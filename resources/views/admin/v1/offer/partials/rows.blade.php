@foreach($offers as $offer)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            <img src="{{$offer->getFirstMediaUrl('images')}}" alt="no image"
                 class="mr-2 rounded-circle">
            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$offer->title}}</a>
        </td>

        <td>
            {{$offer->start_date}}
        </td>
        <td>
            {{$offer->end_date}}
        </td>
        <td>
            @if($offer->is_active)
                <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            {{$offer->created_at}}
        </td>
        <td>
            {{$offer->updated_at}}
        </td>
        <td>
            @include('admin.v1.offer.partials.action-btns')
        </td>
    </tr>
@endforeach
