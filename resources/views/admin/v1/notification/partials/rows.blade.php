@foreach($notifications as $notification)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck13">
                <label class="custom-control-label" for="customCheck13">&nbsp;</label>
            </div>
        </td>
        <td class="table-user">
            <img src="{{asset('admin-panel-assets/v1/images/users/user-2.jpg')}}" alt="table-user"
                 class="mr-2 rounded-circle">
            <a href="javascript:void(0);" class="text-body font-weight-semibold">{{$notification->name}}</a>
        </td>

        <td>
            {{$notification->email}}
        </td>
        <td>
            {{$notification->phone}}
        </td>
        <td>
            @if($notification->is_active)
                <span class="badge bg-soft-success text-success">{{__('labels.active')}}</span>

            @else
                <span class="badge bg-soft-danger text-danger">{{__('labels.inactive')}}</span>

            @endif
        </td>
        <td>
            {{$notification->created_at}}
        </td>
        <td>
            {{$notification->updated_at}}
        </td>
        <td>
            @include('admin.v1.notification.partials.action-btns')
        </td>
    </tr>
@endforeach
