@foreach($chains as $chain)
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
            <a href="{{route('chains.show',$chain->id)}}" class="text-body font-weight-semibold">{{$chain->name}}</a>
        </td>
        <td>
            @if($chain->is_active)
                <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            @include('admin.v1.chain.partials.action-btns')
        </td>
    </tr>
@endforeach
